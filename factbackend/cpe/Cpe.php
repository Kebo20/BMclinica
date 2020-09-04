<?php
namespace Cpe;

use App\ComunicacionBaja;
use App\ComunicacionBajaItem;
use App\DocElectronico;
use App\ResumenElectronico;
use App\ResumenItem;
use Greenter\Model\Client\Client;
use Greenter\Model\Sale\Document;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\Note;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Summary\Summary;
use Greenter\Model\Summary\SummaryDetail;
use Greenter\Model\Voided\Voided;
use Greenter\Model\Voided\VoidedDetail;
use Greenter\Report\HtmlReport;
use Greenter\Report\PdfReport;
use Greenter\See;
use Greenter\Model\DocumentInterface;
use Greenter\Report\XmlUtils;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Ws\Services\SunatEndpoints;
use Illuminate\Support\Facades\DB;

class Cpe
{
    private static $current;
    private $urlrepositorio;
    private $documento;
    private function __construct()
    {
        $this->urlrepositorio=__DIR__.env('URL_DOC_ELECT');
        $this->documento=false;
    }

    public static function getInstance()
    {
        if (!self::$current instanceof self) {
            self::$current = new self();
        }
        return self::$current;
    }
    public function getSee(){
        $see= new See();
        $data = file_get_contents(__DIR__.'/config/params.json');
        $params=json_decode($data,true);
        if($params['modo']=='dev'){
            $endpoint=SunatEndpoints::FE_BETA;
        }else{
             $endpoint=SunatEndpoints::FE_PRODUCCION;
         }
            $see->setService($endpoint);
            $see->setCertificate(file_get_contents($this->getUrlData('pem')));
            $see->setCredentials($params['empresa']['ruc'].$params['usersunat'],$params['passunat']);
            $see->setCachePath(__DIR__ . '/../cache');
            return $see;
    }

    public function setDocElectronicoID($id){
        $this->documento= DocElectronico::find($id);
    }
    public function setDocElectronicoVal($tipo,$serie,$correlativo){
        $this->documento=DocElectronico::where(['tipo_documento'=>$tipo,
            'serie'=>$serie,'correlativo'=>$correlativo])->first();
    }

    public function getDocumento(){
        return $this->documento;
    }

    public function obtenerInvoice(){
        if($this->documento){
            switch($this->documento->tipo_documento){
                case '01':
                case '03':
                    $invoice=$this->generarDocumentoVenta();
                    break;
                case '07':
                case '08':
                    $invoice=$this->generarNota();
                    break;
                default:
                    $invoice=false;
                    break;
            }
            return $invoice;
        }else{
            return false;
        }
    }
    private function generarDocumentoVenta()
    {
        $documento= $this->documento;
        $documento->items;
        $cliente= new Client();
        $cliente->setTipoDoc($documento->tipodoc_cli)
            ->setNumDoc($documento->doc_cliente)
            ->setRznSocial($documento->nomcli)
            ->setAddress((new Address())
                ->setDireccion($documento->dircliente));
        $invoice= new Invoice();
        $invoice ->setUblVersion('2.1')
            ->setTipoOperacion($documento->cod_operacion) // Catalog. 51
            ->setTipoDoc($documento->tipo_documento)
            ->setSerie($documento->serie)
            ->setCorrelativo($documento->correlativo)
            ->setFechaEmision(new \DateTime($documento->fecha_emision.' '.$documento->hora_emision))
            ->setTipoMoneda($documento->moneda)
            ->setClient($cliente)
            ->setMtoOperGravadas($documento->op_gravadas)
            ->setMtoIGV($documento->total_igv)
            ->setTotalImpuestos($documento->total_igv)
            ->setValorVenta($documento->valor_venta)
            ->setMtoImpVenta($documento->importe_total)
            ->setCompany($this->getCompany());
        $items=[];
        foreach ($documento->items as $item){
            $saledet=new SaleDetail();
            $saledet->setCodProducto($item->cod_interno)
                ->setUnidad($item->unidad_medida)
                ->setCantidad($item->cantidad)
                ->setDescripcion($item->descripcion_item)
                ->setMtoBaseIgv($item->valven)
                ->setPorcentajeIgv(18.00) // 18%
                ->setIgv($item->valigv)
                ->setTipAfeIgv('10')
                ->setTotalImpuestos($item->valigv)
                ->setMtoValorVenta($item->valven)
                ->setMtoValorUnitario($item->valuni)
                ->setMtoPrecioUnitario($item->preuni);
            $items[]=$saledet;
        }
        $importe=number_format($documento->importe_total,2,'.','');
        $valor_entero=intval($importe);
        $valor_decimal=round(($importe-$valor_entero)*100,2);
        if($valor_decimal<10){
            $valor_decimal_letras= ' CON 0'.$valor_decimal.'/100 SOLES';
        }else{
            $valor_decimal_letras= ' CON '.$valor_decimal.'/100 SOLES';
        }
        $valor_entero_letras=strtoupper(CifrasEnLetras::convertirNumeroEnLetras($valor_entero));
        $importe_en_letras='SON '.$valor_entero_letras.$valor_decimal_letras;
        $legend = (new Legend())
            ->setCode('1000')
            ->setValue($importe_en_letras);

        $invoice->setDetails($items)
            ->setLegends([$legend]);
        return $invoice;

    }

    public function generarResumen($fecha,$tipo){
        // crear resumen de BD
        $resumen= new ResumenElectronico();
        $resumen->fecha_generacion=$fecha;
        $hoy=date('Y-m-d');
        $ultimoresumen=ResumenElectronico::where('fecha_resumen',$hoy)
            ->orderBy('resumen_num','DESC')->first();
        if($ultimoresumen){
            $resumen->resumen_num=$ultimoresumen->resumen_num+1;
        }else{
            $resumen->resumen_num=1;
        }
        $resumen->fecha_resumen=$hoy;
        $resumen->save();
        $detalles=[];
        //Obtener primer detalle
        if($tipo=='B'){
            $tipo_doc='03';
            $det_base=DocElectronico::where(['tipo_documento'=>'03','envio_sunat'=>0, 'fecha_emision'=>$fecha,
                'xml_generado'=>1, 'estado'=>0])->first();
        }else{
            $tipo_doc='07';
            $det_base=DocElectronico::where(['tipo_documento'=>'07','envio_sunat'=>0, 'fecha_emision'=>$fecha,
                'xml_generado'=>1, 'estado'=>0])
                ->where('serie','like','B%')->first();
        }
        if(is_null($det_base->fecha_anulacion)){
            if($tipo=='B'){
                $detalle_doc=DocElectronico::where(['tipo_documento'=>'03','envio_sunat'=>0,'fecha_emision'=>$fecha,'xml_generado'=>1])
                    ->whereNull('fecha_anulacion')->get();
            }else{
                $detalle_doc=DocElectronico::where(['tipo_documento'=>'07','envio_sunat'=>0,'fecha_emision'=>$fecha,'xml_generado'=>1])
                    ->where('serie','like','B%')->whereNull('fecha_anulacion')->get();
            }
        }else{
            if($tipo=='B'){
                $detalle_doc=DocElectronico::where(['tipo_documento'=>'03','envio_sunat'=>0,'fecha_emision'=>$fecha,'xml_generado'=>1])
                    ->whereNotNull('fecha_anulacion')->get();
            }else{
                $detalle_doc=DocElectronico::where(['tipo_documento'=>'07','envio_sunat'=>0,'fecha_emision'=>$fecha,'xml_generado'=>1])
                    ->where('serie','like','B%')->whereNotNull('fecha_anulacion')->get();
            }
        }
        //Agregar detalle
       foreach ($detalle_doc as $i => $boleta){
            if($i<500){
                $itBD= new ResumenItem();
                $itBD->resumen_electronico_id=$resumen->id;
                $itBD->documento_electronico_id=$boleta->id;
                $itBD->estado=1;
                $itBD->save();
                $detalle=new SummaryDetail();
                $detalle->setTipoDoc($tipo_doc)
                    ->setSerieNro($boleta->serie.'-'.$boleta->correlativo)
                    ->setTotal($boleta->importe_total)
                    ->setMtoOperGravadas($boleta->op_gravadas)
                    ->setMtoIGV($boleta->total_igv);
                if($boleta->tipodoc_cli==0){
                    $detalle->setClienteTipo(1)
                        ->setClienteNro('00000000');
                }else{
                    $detalle->setClienteTipo($boleta->tipodoc_cli)
                        ->setClienteNro($boleta->doc_cliente);
                }
                if($tipo_doc=='07'){
                    $detalle->setDocReferencia((new Document())
                        ->setTipoDoc('03')
                        ->setNroDoc($boleta->nrodoc_relacionado));
                }
                if(is_null($boleta->fecha_anulacion)){
                    $detalle->setEstado('1');
                }else{
                    $detalle->setEstado('3');
                }
                $detalles[]=$detalle;
                $boleta->envio_sunat=1;
                $boleta->save();
            }
        }
        // crear Modelo de Resumen
        $sumary= new Summary();
        $sumary->setFecGeneracion(new \DateTime($resumen->fecha_generacion))
            ->setFecResumen(new \DateTime($resumen->fecha_resumen))
            ->setCorrelativo(self::zerofill($resumen->resumen_num,3))
            ->setCompany(self::getCompany())->setDetails($detalles);
        //Firmar DOCUMENTO
        $see=$this->getSee();
        $response = $see->getXmlSigned($sumary);
        $this->generarXML($sumary,$response);
        $resumen->firma_digital=$this->getHashFile($sumary);
        $resumen->cod_resumen=$sumary->getName();
        $resumen->save();
        //obtener Items
        return $resumen;
    }
    public function regenerarResumen($id){
        $resumen= ResumenElectronico::where('id',$id)->first();
        $items=$resumen->items;
        $detalles=[];
        foreach($items as $boleta){
            $detalle=new SummaryDetail();
            $detalle->setTipoDoc($boleta->tipo_documento)
                ->setSerieNro($boleta->serie.'-'.$boleta->correlativo)
                ->setTotal($boleta->importe_total)
                ->setMtoOperGravadas($boleta->op_gravadas)
                ->setMtoIGV($boleta->total_igv);
            if($boleta->tipodoc_cli==0){
                $detalle->setClienteTipo(1)
                    ->setClienteNro('00000000');
            }else{
                $detalle->setClienteTipo($boleta->tipodoc_cli)
                    ->setClienteNro($boleta->doc_cliente);
            }
            if($boleta->tipo_documento=='07'){
                $detalle->setDocReferencia((new Document())
                    ->setTipoDoc('03')
                    ->setNroDoc($boleta->nrodoc_relacionado));
            }
            if(is_null($boleta->fecha_anulacion)){
                $detalle->setEstado('1');
            }else{
                $detalle->setEstado('3');
            }
            $detalles[]=$detalle;
        }
        $sumary= new Summary();
        $sumary->setFecGeneracion(new \DateTime($resumen->fecha_generacion))
            ->setFecResumen(new \DateTime($resumen->fecha_resumen))
            ->setCorrelativo(self::zerofill($resumen->resumen_num,3))
            ->setCompany(self::getCompany())->setDetails($detalles);
        //Firmar DOCUMENTO
        $see=$this->getSee();
        $response = $see->getXmlSigned($sumary);
        $this->generarXML($sumary,$response,1);
        $resumen->firma_digital=$this->getHashFile($sumary);
        $resumen->save();
        return $resumen;
    }


    public function enviarResumen($id){
        $resumen= ResumenElectronico::find($id);
        $detalles=[];
        foreach ($resumen->items as $i => $boleta){
                $detalle=new SummaryDetail();
                $detalle->setTipoDoc(str_pad($boleta->tipo_documento,2,'0',STR_PAD_LEFT))
                    ->setSerieNro($boleta->serie.'-'.$boleta->correlativo)
                    ->setClienteTipo($boleta->tipodoc_cli)
                    ->setClienteNro($boleta->doc_cliente)
                    ->setTotal($boleta->importe_total)
                    ->setMtoOperGravadas($boleta->op_gravadas)
                    ->setMtoIGV($boleta->total_igv);
                if(is_null($boleta->fecha_anulacion)){
                    $detalle->setEstado('1');
                }else{
                    $detalle->setEstado('3');
                }
                $detalles[]=$detalle;
        }
        $sumary= new Summary();
        $sumary->setFecGeneracion(new \DateTime($resumen->fecha_generacion))
            ->setFecResumen(new \DateTime($resumen->fecha_resumen))
            ->setCorrelativo(self::zerofill($resumen->resumen_num,3))
            ->setCompany(self::getCompany())->setDetails($detalles);
        $see=$this->getSee();
        $rutaxml=$this->getUrlXml($sumary);

        if($resumen->envio_sunat==0){
            $res = $see->sendXml(get_class($sumary),$sumary->getName(),file_get_contents($rutaxml));
            if ($res->isSuccess()) {
                $resumen->envio_sunat=1;
                $resumen->fec_envio_sunat=date('Y-m-d');
                $resumen->ticket=$res->getTicket();
                $resumen->save();
                return [
                    'estado'=>1,
                    'mensaje'=>'Resumen Enviado',
                ];
            } else {
                return [
                    'estado'=>0,
                    'mensaje'=>'Error de Envio',
                    'error'=>$res->getError()
                ];
            }
        }else{
            if(file_exists($this->getUrlCdr($sumary))){
                return [
                    'estado'=>3,
                    'mensaje'=>'Resumen Enviado y descargado'
                ];
            }else{
                $result = $see->getStatus($resumen->ticket);
                if ($result->isSuccess()) {
                    $cdr = $result->getCdrResponse();
                    $resumen->resp_cdr=$cdr->getCode();
                    $resumen->desc_cdr=$cdr->getDescription();
                    $resumen->save();
                    $this->descargarCdr($sumary, $result->getCdrZip());
                    return [
                        'estado'=>2,
                        'mensaje'=>'CDR Obtenido',
                        'cod_cdr'=>$resumen->resp_cdr,
                        'desc_cdr'=>$resumen->desc_cdr
                    ];
                } else {
                    return [
                        'estado'=>0,
                        'mensaje'=>'Error Al Obtener CDR',
                        'error'=>$result->getError()
                    ];
                }
            }

        }

    }

    public function generarComunicacionBaja($fecha){
        $baja= new ComunicacionBaja();
        $baja->fecha_generacion=$fecha;
        $ultimaBaja=ComunicacionBaja::whereMonth('fecha_comunicacion',date('m',strtotime($fecha)))
            ->orderBy('comunicacion_num','DESC')->first();
        if($ultimaBaja){
            $baja->comunicacion_num=$ultimaBaja->comunicacion_num+1;
        }else{
            $baja->comunicacion_num=1;
        }
        $baja->fecha_comunicacion=date('Y-m-d');
        $baja->save();
        $detalles=[];
        $documentos=DocElectronico::where([
            'tipo_documento'=>'01',
            'envio_sunat'=>1,
            'estado'=>1,
            'cod_res_sunat'=>0
        ])->whereDate('fecha_emision',$fecha)
            ->where(DB::raw('datediff(fecha_anulacion, fecha_emision)'),'<','8')
            ->whereNotIn('id',DB::table('doc_comunicacionbaja_item')->select('doc_electronico_id'))
            ->get();
        foreach ($documentos as $documento){
            $bajaDoc=new ComunicacionBajaItem();
            $bajaDoc->comunicacion_id=$baja->id;
            $bajaDoc->doc_electronico_id=$documento->id;
            $bajaDoc->motivo='Anulacion de la venta';
            $bajaDoc->save();
            $detalle=new VoidedDetail();
            $detalle->setTipoDoc($documento->tipo_documento)
                ->setSerie($documento->serie)->setCorrelativo($documento->correlativo)
                ->setDesMotivoBaja($bajaDoc->motivo);
            $detalles[]=$detalle;
        }
        // crear Modelo de Resumen
        $voided= new Voided();
        $voided->setFecGeneracion(new \DateTime($baja->fecha_generacion))
            ->setFecComunicacion(new \DateTime($baja->fecha_comunicacion))
            ->setCorrelativo(self::zerofill($baja->comunicacion_num,4))
            ->setCompany(self::getCompany())->setDetails($detalles);
        //Firmar DOCUMENTO
        $see=$this->getSee();
        $response = $see->getXmlSigned($voided);
        $this->generarXML($voided,$response);
        $baja->firma_digital=$this->getHashFile($voided);
        $baja->cod_comunicacion=$voided->getName();
        $baja->save();
        //obtener Items
        return $baja;
    }

    public function enviarComunicacion($id){
        $comunicacion= ComunicacionBaja::find($id);
        $detalles=[];
        foreach ($comunicacion->items as $documento){
            $detalle=new VoidedDetail();
            $detalle->setTipoDoc($documento->tipo_documento)
                ->setSerie($documento->serie)
                ->setCorrelativo($documento->correlativo)
                ->setDesMotivoBaja('Anulacion de la venta');
            $detalles[]=$detalle;
        }
        $voided= new Voided();
        $voided->setFecGeneracion(new \DateTime($comunicacion->fecha_generacion))
            ->setFecComunicacion(new \DateTime($comunicacion->fecha_comunicacion))
            ->setCorrelativo(self::zerofill($comunicacion->comunicacion_num,4))
            ->setCompany(self::getCompany())->setDetails($detalles);
        $see=$this->getSee();
        $rutaxml=$this->getUrlXml($voided);

        if($comunicacion->envio_sunat==0){
            $res = $see->sendXml(get_class($voided),$voided->getName(),file_get_contents($rutaxml));
            if ($res->isSuccess()) {
                $comunicacion->envio_sunat=1;
                $comunicacion->fec_envio_sunat=date('Y-m-d');
                $comunicacion->ticket=$res->getTicket();
                $comunicacion->save();
                return [
                    'estado'=>1,
                    'mensaje'=>'Comunicacion de Baja Enviada',
                ];
            } else {
                return [
                    'estado'=>0,
                    'mensaje'=>'Error de Envio',
                    'error'=>$res->getError()
                ];
            }
        }else{
            if(file_exists($this->getUrlCdr($voided))){
                return [
                    'estado'=>3,
                    'mensaje'=>'Comunicacion de baja Enviada y descargada'
                ];
            }else{
                $result = $see->getStatus($comunicacion->ticket);
                if ($result->isSuccess()) {
                    $cdr = $result->getCdrResponse();
                    $comunicacion->resp_cdr=$cdr->getCode();
                    $comunicacion->desc_cdr=$cdr->getDescription();
                    $comunicacion->save();
                    $this->descargarCdr($voided, $result->getCdrZip());
                    return [
                        'estado'=>2,
                        'mensaje'=>'CDR Obtenido',
                        'cod_cdr'=>$comunicacion->resp_cdr,
                        'desc_cdr'=>$comunicacion->desc_cdr
                    ];
                } else {
                    return [
                        'estado'=>0,
                        'mensaje'=>'Error Al Obtener CDR',
                        'error'=>$result->getError()
                    ];
                }
            }

        }

    }


    public function generarNota(){
        $documento= $this->documento;
        $documento->items;
        $cliente= new Client();
        $cliente->setTipoDoc($documento->tipodoc_cli)
            ->setNumDoc($documento->doc_cliente)
            ->setRznSocial($documento->nomcli)
            ->setAddress((new Address())
                ->setDireccion($documento->dircliente));
        $docRel=DocElectronico::find($documento->doc_relacionado_id);
        $nota= new Note();
        $nota->setUblVersion('2.1')
            ->setTipDocAfectado($docRel->tipo_documento)
            ->setNumDocfectado($documento->nrodoc_relacionado)
            ->setCodMotivo($documento->codmot_nota)
            ->setDesMotivo($documento->motivo_nota)
            ->setTipoDoc($this->documento->tipo_documento)
            ->setSerie($documento->serie)
            ->setCorrelativo($documento->correlativo)
            ->setFechaEmision(new \DateTime($documento->fecha_emision.' '.$documento->hora_emision))
            ->setTipoMoneda($documento->moneda)
            ->setClient($cliente)
            ->setMtoOperGravadas($documento->op_gravadas)
            ->setMtoIGV($documento->total_igv)
            ->setTotalImpuestos($documento->total_igv)
            ->setMtoImpVenta($documento->importe_total)
            ->setCompany($this->getCompany());
        $items=[];
        foreach ($documento->items as $item){
            $saledet=new SaleDetail();

            $saledet->setCodProducto($item->cod_interno)
                ->setUnidad($item->unidad_medida)
                ->setCantidad($item->cantidad)
                ->setDescripcion($item->descripcion_item)
                ->setMtoBaseIgv($item->valven)
                ->setPorcentajeIgv(18.00) // 18%
                ->setIgv($item->valigv)
                ->setTipAfeIgv('10')
                ->setTotalImpuestos($item->valigv)
                ->setMtoValorVenta($item->valven)
                ->setMtoValorUnitario($item->valuni)
                ->setMtoPrecioUnitario($item->preuni);
            $items[]=$saledet;
        }
        $importe=number_format($documento->importe_total,2,'.','');
        $valor_entero=intval($importe);
        $valor_decimal=round(($importe-$valor_entero)*100,2);
        if($valor_decimal<10){
            $valor_decimal_letras= ' CON 0'.$valor_decimal.'/100 SOLES';
        }else{
            $valor_decimal_letras= ' CON '.$valor_decimal.'/100 SOLES';
        }
        $valor_entero_letras=strtoupper(CifrasEnLetras::convertirNumeroEnLetras($valor_entero));
        $importe_en_letras='SON '.$valor_entero_letras.$valor_decimal_letras;
        $legend = (new Legend())
            ->setCode('1000')
            ->setValue($importe_en_letras);
        $nota->setDetails($items)
            ->setLegends([$legend]);
        return $nota;

    }

    public function getCompany(){
        $data = file_get_contents(__DIR__.'/config/params.json');
        $params=json_decode($data,true);
        $empresa=$params['empresa'];
        $address= new Address();
        $address->setUbigueo($empresa['ubigeo'])
            ->setDepartamento($empresa['departamento'])
            ->setProvincia($empresa['provincia'])
            ->setDistrito($empresa['distrito'])
            ->setUrbanizacion($empresa['urbanizacion'])
            ->setCodLocal('0000')
            ->setDireccion($empresa['direccion']);
        $company= new Company();
        $company->setRazonSocial($empresa['razonsocial'])
            ->setNombreComercial($empresa['razonsocial'])
        ->setRuc($empresa['ruc'])->setAddress($address);
        return $company;
    }

    public function setUrlFileData($file){
        $url=__DIR__.'/data/'.$file;
        return $url;
    }

    public function validconfig(){
        $error=false;
        if(!file_exists(__DIR__.'/config/params.json')){
            return true;
        }else{
            $data = file_get_contents(__DIR__.'/config/params.json');
            $params=json_decode($data,true);
            if(!isset($params['certificado']) || !file_exists(__DIR__.'/data/'.$params['certificado'])){
                return true;
            }
            if(!isset($params['passcert'])){
                return true;
            }
            if(!isset($params['pem']) || !file_exists(__DIR__.'/data/'.$params['pem'])){
                return true;
            }
        }
        return $error;
    }

    public function getUrlData($file){
        $url='';
        if(file_exists(__DIR__.'/config/params.json')){
            $data = file_get_contents(__DIR__.'/config/params.json');
            $params=json_decode($data,true);
            if(isset($params[$file]) || file_exists(__DIR__.'/data/'.$params[$file])){
                $url=__DIR__.'/data/'.$params[$file];
            }
        }
        return $url;
    }
    public function getStringData($string){
        $result='';
        if(file_exists(__DIR__.'/config/params.json')){
            $data = file_get_contents(__DIR__.'/config/params.json');
            $params=json_decode($data,true);
            if(isset($params[$string])){
                $result=$params[$string];
            }
        }
        return $result;
    }

    public function getErrorConfig(){
        $errors=[
            'params'=>false,
            'certificado'=>false,
            'passcert'=>false,
            'pem'=>false,
            'cer'=>false,
            'emisor'=>false,
        ];
        if(!file_exists(__DIR__.'/config/params.json')){
            $errors['params']=true;
            $errors['certificado']=true;
            $errors['passcert']=true;
            $errors['pem']=true;
            $errors['cer']=true;
            $errors['emisor']=false;
        }else{
            $data = file_get_contents(__DIR__.'/config/params.json');
            $params=json_decode($data,true);

            if(isset($params['certificado'])){
                if(!file_exists(__DIR__.'/data/'.$params['certificado'])){
                    $errors['certificado']=true;
                }
            }
            if(!isset($params['passcert'])){
                $errors['passcert']=true;
            }
            if(!isset($params['pem']) || !file_exists(__DIR__.'/data/'.$params['pem'])){
                $errors['pem']=true;
            }
        }
        return $errors;
    }

    public function generarXML(DocumentInterface $document,$xml, $regenera=0){
        $file=$this->urlrepositorio.'xml/'.$document->getName().'.xml';
        if(!file_exists($file) && $regenera==0){
            file_put_contents($file, $xml);
        }else{
            file_put_contents($file, $xml);
        }

    }

    public function getPdf(DocumentInterface $document)
    {
        $html = new HtmlReport(__DIR__.'/../resources/reports/Templates/', [
            'cache' => __DIR__ . '/../cache',
            'strict_variables' => true,
        ]);
        $template = $this->getTemplate($document);
        if ($template) {
            $html->setTemplate($template);
        }
        $hash = $this->getHashFile($document);
        $params = self::getParametersPdf();
        $params['system']['hash'] = $hash;
        $render= new PdfReport($html);
        $render->setOptions( [
            'no-outline',
            //'viewport-size' => '1280x1024',
            //'page-width' => '21cm',
            //'page-height' => '29.7cm',
            //'footer-html' => '',
        ]);
        $binPath = self::getPathBin();
        if (file_exists($binPath)) {
            $render->setBinPath($binPath);
        }
        $pdf=$render->render($document,$params);
        if ($pdf === false) {
            $error = $render->getExporter()->getError();
            echo 'Error: '.$error;
            exit();
        }
        $file=$this->urlrepositorio.'html/'.$document->getName().'.html';
        if(!file_exists($file)){
            file_put_contents($file, $render->getHtml());
        }
        return $pdf;
    }
    public function LimpiarDocumentos(){

    }

    public static function getPathBin()
    {
        $path = __DIR__.'/../vendor/bin/wkhtmltopdf';
        if (self::isWindows()) {
            $path .= '.exe';
        }

        return $path;
    }

    public static function isWindows()
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    private function getTemplate($document)
    {
        $className = get_class($document);
        switch ($className) {
            case \Greenter\Model\Retention\Retention::class:
                $name = 'retention';
                break;
            case \Greenter\Model\Perception\Perception::class:
                $name = 'perception';
                break;
            case \Greenter\Model\Despatch\Despatch::class:
                $name = 'despatch';
                break;
            case \Greenter\Model\Summary\Summary::class:
                $name = 'summary';
                break;
            case \Greenter\Model\Voided\Voided::class:
            case \Greenter\Model\Voided\Reversion::class:
                $name = 'voided';
                break;
            default:
                return '';
        }
        return $name.'.html.twig';
    }

    private static function getParametersPdf()
    {
        $logo = file_get_contents(__DIR__.'/../resources/reports/Templates/assets/img/logo.png');
        $data = file_get_contents(__DIR__.'/config/params.json');
        $params=json_decode($data,true);
        $empresa=$params['empresa'];
        return [
            'system' => [
                'logo' => $logo,
                'hash' => ''
            ],
            'user' => [
                'resolucion' => $empresa['resolucion'],
                'header' => '',
                'ubigeodir'=> $empresa['distrito'].' - '.$empresa['provincia'].' - '.$empresa['departamento'],
                'urbanizacion'=>$empresa['urbanizacion']
            ]
        ];
    }
    public function generarPdf($content,$filename){
        $file=$this->urlrepositorio.'pdf/'.$filename;
        if(!file_exists($file)){
            file_put_contents($file, $content);
        }
    }

    public function showPdf($content, $filename)
    {
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($content));
        echo $content;
    }

    public static function zerofill($entero, $largo)
    {
        // Limpiamos por si se encontraran errores de tipo en las variables
        $entero = (int)$entero;
        $largo = (int)$largo;
        $relleno = '';
        if (strlen($entero) < $largo) {
            $relleno = str_repeat('0', $largo - strlen($entero));
        }
        return $relleno . $entero;
    }

    public function descargarCdr(DocumentInterface $document, $zip)
    {
        $file=$this->urlrepositorio.'cdr/R-'.$document->getName().'.zip';
        if(!file_exists($file)){
            file_put_contents($file, $zip);
        }
    }

    public function getHashFile(DocumentInterface $document)
    {
        $file=$this->urlrepositorio.'xml/'.$document->getName().'.xml';
        $hash = (new XmlUtils())->getHashSignFromFile($file);
        return $hash;
    }
    public function getUrlXml(DocumentInterface $document){

        return $this->urlrepositorio.'xml/'.$document->getName().'.xml';
    }

    public function getUrlHtml(DocumentInterface $document){
        return $this->urlrepositorio.'html/'.$document->getName().'.html';
    }
    public function getUrlPdf(DocumentInterface $document){
        return $this->urlrepositorio.'pdf/'.$document->getName().'.pdf';
    }

    public function getUrlCdr(DocumentInterface $document){
        return $this->urlrepositorio.'cdr/R-'.$document->getName().'.zip';
    }


}