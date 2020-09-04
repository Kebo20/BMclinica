<?php

namespace App\Http\Controllers;

use App\ComunicacionBaja;
use App\DocElectronico;
use App\ResumenElectronico;
use Cpe\Cpe;
use Cpe\SunatRuc;
use Greenter\Model\Summary\Summary;
use Greenter\Model\Summary\SummaryDetail;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;

class CpeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $cpe;
    public function __construct()
    {
        $this->cpe= Cpe::getInstance();
    }

    public function index(){
        return 'Sistema de Facturacion Electronica';
    }
    public function config(){
        if($this->cpe->validconfig()){
            $errors=$this->cpe->getErrorConfig();
            return [
                'validacion'=>false,
                'errors'=>$errors
            ];
        }else{
            return [
                'validacion'=>true,
            ];
        }
    }

    public function sunat($ruc){
        $cls_ruc= new SunatRuc(false,false);
        $search1 = $cls_ruc->search( $ruc );
        return $search1->json();
    }

    public function firmar($iddoc){
        $this->cpe->setDocElectronicoID($iddoc);
        $documento = $this->cpe->getDocumento();
        if($documento){
            $invoice= $this->cpe->obtenerInvoice();
            $see=$this->cpe->getSee();
            //Generar Xml Firmado
            $response = $see->getXmlSigned($invoice);
            $this->cpe->generarXML($invoice,$response);
            $documento->firma_digital=$this->cpe->getHashFile($invoice);
            if($documento->firma_digital!=''){
                $documento->xml_generado=1;
                $documento->save();
                return [
                    'result'=>true,
                    'mensaje'=>'Documento Firmado correctamente',
                    'hash'=>$documento->firma_digital
                ];
            }
        }else{
            return [
               'result'=>false,
               'mensaje'=>'No existe documento electronico',
            ];
        }

    }
    public function enviarFactura($iddoc){
        $this->cpe->setDocElectronicoID($iddoc);
        $documento = $this->cpe->getDocumento();
        if($documento->tipo_documento=="01"){
            $invoice= $this->cpe->obtenerInvoice();
            $see=$this->cpe->getSee();
            $rutaxml=$this->cpe->getUrlXml($invoice);
            if($documento->envio_sunat==0){
                $res = $see->sendXml(get_class($invoice),$invoice->getName(),file_get_contents($rutaxml));
                if ($res->isSuccess()) {
                    $documento->envio_sunat=1;
                    $documento->cod_res_sunat=$res->getCdrResponse()->getCode();
                    $documento->descripcion_cdr=$res->getCdrResponse()->getDescription();
                    $this->cpe->descargarCdr($invoice, $res->getCdrZip());
                    $documento->save();
                    return [
                        'codigo'=>$res->getCdrResponse()->getCode(),
                        'mensaje'=>$res->getCdrResponse()->getDescription()
                    ];
                } else {
                    $result=$res->getError();
                    $documento->cod_res_sunat=$result->getCode();
                    $documento->save();
                    return [
                        'codigo'=>$res->getError()->getCode(),
                        'mensaje'=>$res->getError()->getMessage()
                    ];
                }
            }else{
                return [
                    'codigo'=>'-1',
                    'mensaje'=>'El documento ya fue enviado a Sunat'
                ];
            }
        }else{
            return [
                'codigo'=>'-1',
                'mensaje'=>'El documento no es una factura'
            ];
        }
    }

    public function verdocumentos(){
        $documentos=DocElectronico::limit(100)->orderByDesc('id')->get();
        return $documentos;
    }
    public function verdocumento($id){
        $documento=DocElectronico::find($id);
        if($documento){
            $documento->load('items');
            return [
                'empresa'=>[
                    'ruc'=>'20561370096',
                    'razon'=>'PRECISA DIAGNOSTICA S.A.C.',
                    'direccion'=>'CAL. FRANCISCO CABRERA 130',
                ],
                'documento'=>$documento
            ];
        }else{
            return null;
        }
    }
    public function eliminardoc($iddoc){
        $this->cpe->setDocElectronicoID($iddoc);
        $documento = $this->cpe->getDocumento();
        if($documento->envio_sunat==0){
            $invoice= $this->cpe->obtenerInvoice();
            $rutaxml=$this->cpe->getUrlXml($invoice);
            if(file_exists($rutaxml)){
                $documento->xml_generado=0;
                unlink($rutaxml);
            }
            $rutahtml=$this->cpe->getUrlHtml($invoice);
            if(file_exists($rutahtml)){
                unlink($rutahtml);
            }
            $rutapdf=$this->cpe->getUrlPdf($invoice);
            if(file_exists($rutapdf)){
                unlink($rutapdf);
                $documento->pdf_generado=0;
            }
            $documento->firma_digital='';
            $documento->save();
            return [
                'result'=>true,
                'message'=>'Archivos limpiados'
            ];
        }else{
            return [
                'result'=>false,
                'message'=>'Documento ya fue enviado a Sunat'
            ];
        }
    }

    public function enviarfacturas(){
        $documentos=DocElectronico::where([
            'tipo_documento'=>'01',
            'xml_generado'=>1,
            'envio_sunat'=>0,
            'estado'=>0
         ])->get();
        $ndocs=count($documentos);
        $exitos=0;
        $rechazos=0;
        $fallo=0;
        $errors=[];
        foreach ($documentos as $doc){
            $this->cpe->setDocElectronicoID($doc->id);
            $invoice= $this->cpe->obtenerInvoice();
            $see=$this->cpe->getSee();
            $rutaxml=$this->cpe->getUrlXml($invoice);
            $res = $see->sendXml(get_class($invoice),$invoice->getName(),file_get_contents($rutaxml));
            if ($res->isSuccess()) {
                $doc->envio_sunat=1;
                $doc->cod_res_sunat=$res->getCdrResponse()->getCode();
                $doc->descripcion_cdr=$res->getCdrResponse()->getDescription();
                $this->cpe->descargarCdr($invoice, $res->getCdrZip());
                $doc->save();
                if($doc->cod_res_sunat=='0'){
                    $exitos++;
                }else{
                    $rechazos++;
                }

            } else {
                $errors[]=[
                    'id'=>$doc->id,
                    'codigo'=>$res->getError()->getCode(),
                    'mensaje'=>$res->getError()->getMessage()
                ];
                $fallo++;
            }
        }
        return [
            'procesados'=>$ndocs,
            'exitos'=>$exitos,
            'rechazos'=>$rechazos,
            'fallos'=>$fallo,
            'errors'=>$errors
        ];
    }

    public function vercomprobante($iddoc){
        $this->cpe->setDocElectronicoID($iddoc);
        $invoice=$this->cpe->obtenerInvoice();
        try{
            $documento = $this->cpe->getDocumento();
            $pdf=$this->cpe->getPdf($invoice);
            //return $pdf;
            if($documento->pdf_generado==0){
                $this->cpe->generarPdf($pdf,$invoice->getName().'.pdf');
                $documento->pdf_generado=1;
                $documento->save();
            }
            //return $pdf;
            $this->cpe->showPdf($pdf,$invoice->getName().'.pdf');
        }catch (Exception $e) {
            var_dump($e);
        }

    }

    public function generarepgraf(){
        $consulta=DB::table('doc_electronicos')->select('fecha_emision')->where([
            'xml_generado'=>1,
            'envio_sunat'=>1,
            'pdf_generado'=>0
        ])->first();
        if($consulta){
            $fecha=$consulta->fecha_emision;
            $documentos=DocElectronico::where([
                'xml_generado'=>1,
                'envio_sunat'=>1,
                'pdf_generado'=>0,
                'fecha_emision'=>$fecha
            ])->limit(100)->get();
            $contador=0;
            foreach ($documentos as $doc){
                $this->cpe->setDocElectronicoID($doc->id);
                $invoice= $this->cpe->obtenerInvoice();
                $see=$this->cpe->getSee();
                $pdf=$this->cpe->getPdf($invoice);
                $this->cpe->generarPdf($pdf,$invoice->getName().'.pdf');
                $doc->pdf_generado=1;
                $doc->save();
                $contador++;
            }
            return ['mensaje'=>$contador.' representaciones creadas','fecha_emision'=>$fecha];
        }else{
            return ['mensaje'=>'Ninguna representacion creada'];
        }


    }

    public function enviarEmails(){
        $consulta=DB::table('doc_electronicos')->select('fecha_emision')->where([
            'xml_generado'=>1,
            'envio_sunat'=>1,
            'pdf_generado'=>1,
            'envio'=>0,
        ])->where('datosenvio','<>','')->where('datosenvio','<>','.')->limit(10)->first();

        if($consulta){
            $fecha=$consulta->fecha_emision;
            $documentos=DocElectronico::where([
                'xml_generado'=>1,
                'envio_sunat'=>1,
                'pdf_generado'=>1,
                'envio'=>0,
                'fecha_emision'=>$fecha
            ])->where('datosenvio','<>','')
                ->where('datosenvio','<>','.')->get();
            $exito=0;
            $detaerror=[];
            $usu_ema_nom='FACTURACION PRECISA DIAGNOSTICA';
            $usu_ema='ecomprobantes@precisadiagnostica.com.pe';
            $procesados=0;
            foreach ($documentos as $doc){
                if($this->is_valida_email($doc->datosenvio)){
                    $numdoc=$doc->serie.'-'.$doc->correlativo;
                    $procesados++;
                    $invoice= $this->cpe->generarComprobante($doc->tipo_documento,$doc->serie,$doc->correlativo);
                    $mail= new PHPMailer();
                    $mail->setLanguage('es');
                    $mail->CharSet = "UTF­8";
                    $mail->IsSMTP();
                    $mail->SMTPDebug = 0;//Enable SMTP debugging // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
                    $mail->Debugoutput = 'html';//Ask for HTML-friendly debug output
                    $mail->Host = 'mail.precisadiagnostica.com.pe';//Set the hostname of the mail server
                    $mail->Port = 465;//Set the SMTP port number - likely to be 25, 465 or 587
                    $mail->SMTPAuth = true;//Whether to use SMTP authentication
                    $mail->SMTPSecure = 'ssl';
                    $mail->Username = $usu_ema; //Username to use for SMTP authentication
                    $mail->Password = 'F@cturaprec123'; //Password to use for SMTP authentication

                    $mail->setFrom($usu_ema,$usu_ema_nom); //correo envío
                    $mail->addReplyTo($usu_ema,$usu_ema_nom); //Responder a correo
                    $mail->addAddress($doc->datosenvio,$doc->nomcli);
                    $mail->addBCC($usu_ema,$usu_ema_nom);
                    $mail->Subject="Documento Tributario Electronico: ".$numdoc;
                    $mail->AltBody = 'Su gestor de correo electrónico no soporta mensajes en HTML. Por lo tanto no podrá ver el contenido.';
                    $body = '<table borde="0" width="100%">';
                    $body .= '<tr><td colspan="2">Estimado Cliente.</td></tr>';
                    $body .= '<tr><td colspan="2">Sr(es). '.$doc->nomcli.'</td></tr>';
                    switch ($doc->tipodoc_cli){
                        case 0:
                            $doccliente='S/N';
                            break;
                        case 1:
                            $doccliente='DNI: '.$doc->doc_cliente;
                            break;
                        case 6:
                            $doccliente='RUC: '.$doc->doc_cliente;
                            break;
                    }
                    $body .= '<tr><td colspan="2">'.$doccliente.'</td></tr>';
                    $body .= '<tr><td colspan="2">&nbsp;</td></tr>';

                    $body .= '<tr><td colspan="2">Informamos a usted que el documento '.$numdoc.', ya se encuentra disponible.</td></tr>';
                    switch ($doc->tipo_documento){
                        case 1:
                            $tipodoc='FACTURA';
                            break;
                        case 1:
                            $tipodoc='BOLETA';
                            break;
                        case 7:
                            $tipodoc='NOTA DE CREDITO';
                            break;
                    }
                    $body .= '<tr><td align="left" width="8%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo</td><td>:&nbsp; '.$tipodoc.' ELECTRONICA</td></tr>';
                    $body .= '<tr><td align="left" width="8%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero</td><td>:&nbsp; '.$numdoc.'</td></tr>';
                    $body .= '<tr><td align="left" width="8%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto</td><td>:&nbsp; S/ '.number_format($doc->importe_total,2).' (SOLES)</td></tr>';
                    $body .= '<tr><td align="left" width="8%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Emision</td><td>:&nbsp; '.date('d-m-Y', strtotime($doc->fecha_emision)).'</td></tr>';
                    $body .= '<tr><td colspan="2">&nbsp;</td></tr>';
                    $body .= '<tr><td colspan="2">Saluda Atentamente,</td></tr>';
                    $body .= '</table>';
                    $mail->Body = $body;
                    $filexml=$this->cpe->getUrlXml($invoice);
                    $filepdf=$this->cpe->getUrlPdf($invoice);
                    $mail->addAttachment($filexml,$invoice->getName().'.xml');
                    $mail->addAttachment($filepdf,$invoice->getName().'.pdf');

                    if($mail->send()){
                        $exito++;
                        $doc->envio=1;
                        $doc->save();
                    }else{
                        $detaerror[]=[
                            'mensaje'=>'Documento :'.$doc->serie.'-'.$doc->correlativo,
                            'motivo'=>$mail->ErrorInfo
                        ];
                    }
                }else{
                    $doc->datosenvio='.';
                    $doc->save();
                }


            }
            return [
                'procesados'=>$procesados,
                'exitos'=>$exito,
                'errores'=>$detaerror
            ];
        }else{
            return ['mensaje'=>'Ningun email enviado'];
        }
    }
    public function enviarEmail($ndocumento){
        $usu_ema_nom='FACTURACION PRECISA DIAGNOSTICA';
        $usu_ema='ecomprobantes@precisadiagnostica.com.pe';
        $formadoc=explode('-',$ndocumento);
        $serie=$formadoc[0];
        $correlativo=$formadoc[1];
        $documento= DocElectronico::where(['serie'=>$serie,'correlativo'=>$correlativo])->first();
        if($documento->xml_generado==0){
            return [
                'envio'=>false,
                'mensaje'=>'Documento '.$ndocumento.' aun no pudo ser emitido'
            ];
        }
        if($documento->envio_sunat==0){
            return [
                'envio'=>false,
                'mensaje'=>'Documento '.$ndocumento.' no ha sido aun declarado en sunat'
            ];
        }
        if($documento->pdf_generado==0){
            return [
                'envio'=>false,
                'mensaje'=>'Documento '.$ndocumento.' no tiene representacion grafica'
            ];
        }
        if($this->is_valida_email($documento->datosenvio)){
            $invoice= $this->cpe->generarComprobante($documento->tipo_documento,$documento->serie,$documento->correlativo);
            $mail= new PHPMailer();
            $mail->setLanguage('es');
            $mail->CharSet = "UTF­8";
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;//Enable SMTP debugging // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
            $mail->Debugoutput = 'html';//Ask for HTML-friendly debug output
            $mail->Host = 'mail.precisadiagnostica.com.pe';//Set the hostname of the mail server
            $mail->Port = 465;//Set the SMTP port number - likely to be 25, 465 or 587
            $mail->SMTPAuth = true;//Whether to use SMTP authentication
            $mail->SMTPSecure = 'ssl';
            $mail->Username = $usu_ema; //Username to use for SMTP authentication
            $mail->Password = 'F@cturaprec123'; //Password to use for SMTP authentication

            $mail->setFrom($usu_ema,$usu_ema_nom); //correo envío
            $mail->addReplyTo($usu_ema,$usu_ema_nom); //Responder a correo
            $mail->addAddress($documento->datosenvio,$documento->nomcli);
            $mail->addBCC($usu_ema,$usu_ema_nom);
            $mail->Subject="Documento Tribuario Electronico: ".$ndocumento;
            $mail->AltBody = 'Su gestor de correo electrónico no soporta mensajes en HTML. Por lo tanto no podrá ver el contenido.';
            $body = '<table borde="0" width="100%">';
            $body .= '<tr><td colspan="2">Estimado Cliente.</td></tr>';
            $body .= '<tr><td colspan="2">Sr(es). '.$documento->nomcli.'</td></tr>';
            switch ($documento->tipodoc_cli){
                case 0:
                    $doccliente='S/N';
                    break;
                case 1:
                    $doccliente='DNI: '.$documento->doc_cliente;
                    break;
                case 6:
                    $doccliente='RUC: '.$documento->doc_cliente;
                    break;
            }
            $body .= '<tr><td colspan="2">'.$doccliente.'</td></tr>';
            $body .= '<tr><td colspan="2">&nbsp;</td></tr>';

            $body .= '<tr><td colspan="2">Informamos a usted que el documento '.$ndocumento.', ya se encuentra disponible.</td></tr>';
            switch ($documento->tipo_documento){
                case 1:
                    $tipodoc='FACTURA';
                    break;
                case 1:
                    $tipodoc='BOLETA';
                    break;
                case 7:
                    $tipodoc='NOTA DE CREDITO';
                    break;
            }
            $body .= '<tr><td align="left" width="8%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tipo</td><td>:&nbsp; '.$tipodoc.' ELECTRONICA</td></tr>';
            $body .= '<tr><td align="left" width="8%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numero</td><td>:&nbsp; '.$ndocumento.'</td></tr>';
            $body .= '<tr><td align="left" width="8%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto</td><td>:&nbsp; S/ '.number_format($documento->importe_total,2).' (SOLES)</td></tr>';
            $body .= '<tr><td align="left" width="8%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Emision</td><td>:&nbsp; '.date('d-m-Y', strtotime($documento->fecha_emision)).'</td></tr>';
            $body .= '<tr><td colspan="2">&nbsp;</td></tr>';
            $body .= '<tr><td colspan="2">Saluda Atentamente,</td></tr>';
            $body .= '</table>';
            $mail->Body = $body;
            $filexml=$this->cpe->getUrlXml($invoice);
            $filepdf=$this->cpe->getUrlPdf($invoice);
            $mail->addAttachment($filexml,$invoice->getName().'.xml');
            $mail->addAttachment($filepdf,$invoice->getName().'.pdf');

            if($mail->send()){
                if($documento->envio==0){
                    $documento->envio=1;
                    $documento->save();
                }
                return [
                    'envio'=>true,
                    'mensaje'=>'Documento '.$ndocumento.' enviado correctamente'
                ];
            }else{
                return [
                    'envio'=>false,
                    'mensaje'=>'Documento '.$ndocumento.' no pudo ser enviado correctamente'
                ];
            }
        }else{
            return [
                'envio'=>false,
                'mensaje'=>'Documento '.$ndocumento.' no contiene un correo de envio válido'
            ];
        }

    }

    public function generarResumen(){
        $consulta=DB::table('doc_electronicos')->select(DB::raw('DISTINCT fecha_emision'))
            ->where(['tipo_documento'=>'03','envio_sunat'=>0,'xml_generado'=>1,'estado'=>0])
            ->where('fecha_emision','<',date('Y-m-d'))->get();
       if(count($consulta)){
            $fecha=$consulta[0]->fecha_emision;
            $resumen=$this->cpe->generarResumen($fecha,'B');
            $response['result']=1;
            $response['mensaje']='Resumen Generado :'.$resumen->cod_resumen;
        }else{
           //Genera Resumen de Notas
           $consulta=DB::table('doc_electronicos')->select(DB::raw('DISTINCT fecha_emision'))
               ->where(['tipo_documento'=>'07','envio_sunat'=>0,'xml_generado'=>1,'estado'=>0])
               ->where('serie','like','B%')        
               ->where('fecha_emision','<',date('Y-m-d'))->get();
           if(count($consulta)){
               $fecha=$consulta[0]->fecha_emision;
               $resumen=$this->cpe->generarResumen($fecha,'N');
               $response['result']=1;
               $response['mensaje']='Resumen Generado de notas :'.$resumen->cod_resumen;

           }else{
               $response['result']=0;
               $response['mensaje']='Ningun resumen Generado';
           }

        }
        return $response;
    }

    public function generarComunicacionBaja(){
        $fecha_hoy=date('Y-m-d');
        $fecha_min=date('Y-m-d',strtotime($fecha_hoy.' - 7days'));
        $consulta=DB::table('doc_electronicos')->select(DB::raw('date(fecha_anulacion) anulacion'))
            ->where(['tipo_documento'=>'01','envio_sunat'=>1,'estado'=>1,'cod_res_sunat'=>0])
            ->where('fecha_emision','>=',$fecha_min)
            ->where(DB::raw('datediff(fecha_anulacion, fecha_emision)'),'<','8')
            ->whereNotIn('id',DB::table('doc_comunicacionbaja_item')->select('doc_electronico_id'))
            ->get();
        if(count($consulta)){
            $fecha=$consulta[0]->anulacion;
            $comunicacion_baja=$this->cpe->generarComunicacionBaja($fecha);
            $response['result']=1;
            $response['mensaje']='Comunicacion de Baja Generada :'.$comunicacion_baja->cod_comunicacion;
        }else{
            $response['result']=0;
            $response['mensaje']='Ninguna Comunicacion de Baja Generada';
        }
        return $response;
    }



    public function firmarPendientes(){

        $consulta=DB::table('doc_electronicos')->select(DB::raw('DISTINCT fecha_emision'))
            ->where(['xml_generado'=>0])->where('fecha_emision','<',date('Y-m-d'))
            ->whereNotIn('tipo_documento', ['TB','TF'])->get();

        if(count($consulta)){
            $fecha=$consulta[0]->fecha_emision;
            $documentos=DocElectronico::where(['fecha_emision'=>$fecha,'xml_generado'=>0])
                ->whereNotIn('tipo_documento', ['TB','TF'])->get();
            $cont=0;
            $see=$this->cpe->getSee();
            foreach ($documentos as $documento){
                // Genero el documento
                $this->cpe->setDocElectronicoID($documento->id);
                $invoice= $this->cpe->obtenerInvoice();
                //Generar Xml Firmado
                $response = $see->getXmlSigned($invoice);
                $this->cpe->generarXML($invoice,$response);
                //Grabar firma
                $documento->firma_digital=$this->cpe->getHashFile($invoice);
                if($documento->firma_digital!=''){
                    $documento->xml_generado=1;
                    $documento->save();
                    $cont++;
                }
            }
            return [
                'mensaje'=>'Documentos Firmado correctamente',
                'total'=>$cont,
                'fecha'=>$fecha
            ];

        }else{
            $response['result']=0;
            $response['mensaje']='Ningun Documento pendiente de firma';
        }
        return $response;
    }

    public function enviarResumen(){
        $resumenes= ResumenElectronico::whereNull('resp_cdr')->get();
        if(count($resumenes)){
            $results=[];
            $procesados=0;
            foreach ($resumenes as $resumen){
                $results[]= $this->cpe->enviarResumen($resumen->id);
                $procesados++;
            }
            return [
                'procesados'=>$procesados,
                'results'=>$results
            ];
        }else{
            return [
                'procesados'=>0,
                'result'=>'Ningun Resumen por enviar'
            ];
        }

    }

    public function enviarComunicacionBaja(){
        $comunicaciones=ComunicacionBaja::whereNull('resp_cdr')->get();
        if(count($comunicaciones)){
            $results=[];
            $procesados=0;
            foreach ($comunicaciones as $comunicacion){
                $results[]= $this->cpe->enviarComunicacion($comunicacion->id);
                $procesados++;
            }
            return [
                'procesados'=>$procesados,
                'results'=>$results
            ];
        }else{
            return [
                'procesados'=>0,
                'result'=>'Ningun Resumen por enviar'
            ];
        }
    }

    public function enviarUnResumen($id){
        $see=$this->cpe->getSee();
        $resumen= ResumenElectronico::find($id);
        $detalles=[];
        foreach ($resumen->items as $i => $boleta){
            $detalle=new SummaryDetail();
            $detalle->setTipoDoc('03')
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
            ->setCorrelativo(str_pad($resumen->resumen_num,3,'0',STR_PAD_LEFT))
            ->setCompany($this->cpe->getCompany())->setDetails($detalles);
        $rutaxml=$this->cpe->getUrlXml($sumary);
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
                var_dump($res);
            }
        }
    }
    public function regenerarResumen($id){
        $resumen=$this->cpe->regenerarResumen($id);
        return $resumen;
    }
    public function enviarNotas(){
        $documentos=DocElectronico::where([
            'tipo_documento'=>7,
            'xml_generado'=>1,
            'envio_sunat'=>0,
        ])->where('serie','like','F%')->get();
        $ndocs=count($documentos);
        $exitos=0;
        $fallo=0;
        $errors=[];
        foreach ($documentos as $doc){
            $this->cpe->setDocElectronicoID($doc->id);
            $invoice= $this->cpe->obtenerInvoice();
            $see=$this->cpe->getSee();
            $rutaxml=$this->cpe->getUrlXml($invoice);
            $res = $see->sendXml(get_class($invoice),$invoice->getName(),file_get_contents($rutaxml));
            if ($res->isSuccess()) {
                $doc->envio_sunat=1;
                $doc->cod_res_sunat=$res->getCdrResponse()->getCode();
                $doc->descripcion_cdr=$res->getCdrResponse()->getDescription();
                $this->cpe->descargarCdr($invoice, $res->getCdrZip());
                $doc->save();
                $exitos++;
            } else {
                $errors[]=[
                    'id'=>$doc->id,
                    'codigo'=>$res->getError()->getCode(),
                    'mensaje'=>$res->getError()->getMessage()
                ];
                $fallo++;
            }
        }
        return [
            'procesados'=>$ndocs,
            'exitos'=>$exitos,
            'fallos'=>$fallo,
            'errors'=>$errors
        ];
    }

    public function subirComprobantes(){
        $consulta=DB::table('doc_electronicos')->select('fecha_emision')->where([
            'xml_generado'=>1,
            'envio_sunat'=>1,
            'pdf_generado'=>1,
            'publicado'=>0,
        ])->first();
        if($consulta){
            $fecha=$consulta->fecha_emision;
            $documentos=DocElectronico::where([
                'xml_generado'=>1,
                'envio_sunat'=>1,
                'pdf_generado'=>1,
                'publicado'=>0,
                'fecha_emision'=>$fecha
            ])->limit(20)->get();
            $exito=0;
            $detaerror=[];
            $procesados=0;
            $servidor='ftp.precisadiagnostica.com.pe';
            $usuario='precisad';
            $passftp='h%fX6vx7xU6e57';
            foreach ($documentos as $doc){
                $invoice= $this->cpe->generarComprobante($doc->tipo_documento,$doc->serie,$doc->correlativo);
                $rutaxml=$this->cpe->getUrlXml($invoice);
                $rutapdf=$this->cpe->getUrlPdf($invoice);
                $ftp_id= ftp_connect($servidor,21);
                ftp_login($ftp_id,$usuario,$passftp); //Se loguea al Servidor FTP
                $procesados++;
                $subirxml=ftp_put($ftp_id, 'public_html/ecomprobantes/files/'.$invoice->getName().'.xml', $rutaxml, FTP_ASCII);
                $subirpdf=ftp_put($ftp_id, 'public_html/ecomprobantes/files/'.$invoice->getName().'.pdf', $rutapdf, FTP_ASCII);
                if($subirxml && $subirpdf){
                    $exito++;
                    $doc->publicado=1;
                    $doc->save();
                }else{
                    $detaerror[]=[
                        'mensaje'=>'Documento :'.$doc->serie.'-'.$doc->correlativo,
                        'motivo'=>'No se pudo subir el archivo',
                    ];
                }


            }
            return [
                'procesados'=>$procesados,
                'exitos'=>$exito,
                'errores'=>$detaerror
            ];
        }else{
            return [
                'procesados'=>0,
                'result'=>'Ningun documento publicado'
            ];
        }
    }

    private function is_valida_email($str){
        return (false !==filter_var($str,FILTER_VALIDATE_EMAIL));
    }
}
