<?php

namespace App\Http\Controllers;

use Cpeconfig\UtilCpe;
use Cpe\Cpe;
use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Report\XmlUtils;
use Greenter\Ws\Services\SunatEndpoints;
use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;

class FacturadorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //public $see;
    private $cpe;
    public function __construct()
    {
        $this->cpe= Cpe::getInstance();
        //$this->see= require __DIR__.'/../../../cpeconfig/config.php';
    }

    public function index(){

    }

    public function uploadcertificado(){

    }
    public function generarpem(){
        $certificado=$this->cpe->getUrlData('certificado');
        $password=$this->cpe->getStringData('passcert');
        $pfx = file_get_contents($certificado);
        $certificate= new X509Certificate($pfx,$password);
        $pem=$certificate->export(X509ContentType::PEM);
        file_put_contents($this->cpe->setUrlFileData('certificate.pem'), $pem);
        return 'Certificado PEM Generado';
    }
    public function generarcer(){
        $certificado=$this->cpe->getUrlData('certificado');
        $password=$this->cpe->getStringData('passcert');
        $pfx = file_get_contents($certificado);
        $certificate= new X509Certificate($pfx,$password);
        $cer=$certificate->export(X509ContentType::CER);
        file_put_contents($this->cpe->setUrlFileData('certificate.cer'), $cer);
        return 'Certificado CER Generado';
    }
    public function demo(){
        $client= new Client();
        $client->setTipoDoc('6')
            ->setNumDoc('20000000001')
            ->setRznSocial('EMPRESA 1');
        $address= new Address();
        $address->setUbigueo('150101')
            ->setDepartamento('LIMA')
            ->setProvincia('LIMA')
            ->setDistrito('LIMA')
            ->setUrbanizacion('NONE')
            ->setDireccion('AV LS');
        $company = new Company();
        $company->setRuc('20000000001')
            ->setRazonSocial('EMPRESA SAC')
            ->setNombreComercial('EMPRESA')
            ->setAddress($address);
        // Venta
        $invoice = (new Invoice())
            ->setUblVersion('2.1')
            ->setTipoOperacion('0101') // Catalog. 51
            ->setTipoDoc('01')
            ->setSerie('F001')
            ->setCorrelativo('000001')
            ->setFechaEmision(new \DateTime())
            ->setTipoMoneda('PEN')
            ->setClient($client)
            ->setMtoOperGravadas(100.00)
            ->setMtoIGV(18.00)
            ->setTotalImpuestos(18.00)
            ->setValorVenta(100.00)
            ->setMtoImpVenta(118.00)
            ->setCompany($company);

        $item = (new SaleDetail())
            ->setCodProducto('P001')
            ->setUnidad('NIU')
            ->setCantidad(2)
            ->setDescripcion('PRODUCTO 1')
            ->setMtoBaseIgv(100)
            ->setPorcentajeIgv(18.00) // 18%
            ->setIgv(18.00)
            ->setTipAfeIgv('10')
            ->setTotalImpuestos(18.00)
            ->setMtoValorVenta(100.00)
            ->setMtoValorUnitario(50.00)
            ->setMtoPrecioUnitario(56.00);

        $legend = (new Legend())
            ->setCode('1000')
            ->setValue('SON DOSCIENTOS TREINTA Y SEIS CON 00/100 SOLES');

        $invoice->setDetails([$item])
            ->setLegends([$legend]);
        $util=UtilCpe::getInstance();
        $see= $util->getSee(SunatEndpoints::FE_BETA);
        $result = $see->send($invoice);

        $file=__DIR__.'/../../../repositorio/xml/'.$invoice->getName().'.xml';
        if(!file_exists($file)){
            file_put_contents($file,$see->getFactory()->getLastXml());
        }

        if ($result->isSuccess()) {
            //$xml=$see->getXmlSigned($invoice);
            $hash=(new XmlUtils())->getHashSignFromFile($file);
            return $hash;
        } else {
            var_dump($result->getError());
        }

    }


    //
}
