<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* summary.xml.twig */
class __TwigTemplate_cadcdb06a30fc81f1e2f04f5abc80512012a10277d125810287b7059d3b180a0 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<SummaryDocuments
        xmlns=\"urn:sunat:names:specification:ubl:peru:schema:xsd:SummaryDocuments-1\"
        xmlns:cac=\"urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2\"
        xmlns:cbc=\"urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2\"
        xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\"
        xmlns:ext=\"urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2\"
        xmlns:sac=\"urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1\"
        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent/>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <cbc:UBLVersionID>2.0</cbc:UBLVersionID>
    <cbc:CustomizationID>1.1</cbc:CustomizationID>
    <cbc:ID>";
        // line 17
        echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "xmlId", []);
        echo "</cbc:ID>
    <cbc:ReferenceDate>";
        // line 18
        echo twig_date_format_filter($this->env, $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "fecGeneracion", []), "Y-m-d");
        echo "</cbc:ReferenceDate>
    <cbc:IssueDate>";
        // line 19
        echo twig_date_format_filter($this->env, $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "fecResumen", []), "Y-m-d");
        echo "</cbc:IssueDate>
    ";
        // line 20
        $context["emp"] = $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "company", []);
        // line 21
        echo "<cac:Signature>
        <cbc:ID>";
        // line 22
        echo $this->getAttribute((isset($context["emp"]) ? $context["emp"] : null), "ruc", []);
        echo "</cbc:ID>
        <cac:SignatoryParty>
            <cac:PartyIdentification>
                <cbc:ID>";
        // line 25
        echo $this->getAttribute((isset($context["emp"]) ? $context["emp"] : null), "ruc", []);
        echo "</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name><![CDATA[";
        // line 28
        echo $this->getAttribute((isset($context["emp"]) ? $context["emp"] : null), "nombreComercial", []);
        echo "]]></cbc:Name>
            </cac:PartyName>
        </cac:SignatoryParty>
        <cac:DigitalSignatureAttachment>
            <cac:ExternalReference>
                <cbc:URI>#SIGN-GREEN</cbc:URI>
            </cac:ExternalReference>
        </cac:DigitalSignatureAttachment>
    </cac:Signature>
    <cac:AccountingSupplierParty>
        <cbc:CustomerAssignedAccountID>";
        // line 38
        echo $this->getAttribute((isset($context["emp"]) ? $context["emp"] : null), "ruc", []);
        echo "</cbc:CustomerAssignedAccountID>
        <cbc:AdditionalAccountID>6</cbc:AdditionalAccountID>
        <cac:Party>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName><![CDATA[";
        // line 42
        echo $this->getAttribute((isset($context["emp"]) ? $context["emp"] : null), "razonSocial", []);
        echo "]]></cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingSupplierParty>
    ";
        // line 46
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "details", []));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["det"]) {
            // line 47
            echo "<sac:SummaryDocumentsLine>
        <cbc:LineID>";
            // line 48
            echo $this->getAttribute($context["loop"], "index", []);
            echo "</cbc:LineID>
        <cbc:DocumentTypeCode>";
            // line 49
            echo $this->getAttribute($context["det"], "tipoDoc", []);
            echo "</cbc:DocumentTypeCode>
        <cbc:ID>";
            // line 50
            echo $this->getAttribute($context["det"], "serieNro", []);
            echo "</cbc:ID>
        <cac:AccountingCustomerParty>
            <cbc:CustomerAssignedAccountID>";
            // line 52
            echo $this->getAttribute($context["det"], "clienteNro", []);
            echo "</cbc:CustomerAssignedAccountID>
            <cbc:AdditionalAccountID>";
            // line 53
            echo $this->getAttribute($context["det"], "clienteTipo", []);
            echo "</cbc:AdditionalAccountID>
        </cac:AccountingCustomerParty>
        ";
            // line 55
            if ($this->getAttribute($context["det"], "docReferencia", [])) {
                // line 56
                echo "<cac:BillingReference>
            <cac:InvoiceDocumentReference>
                <cbc:ID>";
                // line 58
                echo $this->getAttribute($this->getAttribute($context["det"], "docReferencia", []), "nroDoc", []);
                echo "</cbc:ID>
                <cbc:DocumentTypeCode>";
                // line 59
                echo $this->getAttribute($this->getAttribute($context["det"], "docReferencia", []), "tipoDoc", []);
                echo "</cbc:DocumentTypeCode>
            </cac:InvoiceDocumentReference>
        </cac:BillingReference>
        ";
            }
            // line 63
            if ($this->getAttribute($context["det"], "percepcion", [])) {
                // line 64
                $context["perc"] = $this->getAttribute($context["det"], "percepcion", []);
                // line 65
                echo "<sac:SUNATPerceptionSummaryDocumentReference>
            <sac:SUNATPerceptionSystemCode>";
                // line 66
                echo $this->getAttribute((isset($context["perc"]) ? $context["perc"] : null), "codReg", []);
                echo "</sac:SUNATPerceptionSystemCode>
            <sac:SUNATPerceptionPercent>";
                // line 67
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute((isset($context["perc"]) ? $context["perc"] : null), "tasa", [])]);
                echo "</sac:SUNATPerceptionPercent>
            <cbc:TotalInvoiceAmount currencyID=\"PEN\">";
                // line 68
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute((isset($context["perc"]) ? $context["perc"] : null), "mto", [])]);
                echo "</cbc:TotalInvoiceAmount>
            <sac:SUNATTotalCashed currencyID=\"PEN\">";
                // line 69
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute((isset($context["perc"]) ? $context["perc"] : null), "mtoTotal", [])]);
                echo "</sac:SUNATTotalCashed>
            <cbc:TaxableAmount currencyID=\"PEN\">";
                // line 70
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute((isset($context["perc"]) ? $context["perc"] : null), "mtoBase", [])]);
                echo "</cbc:TaxableAmount>
        </sac:SUNATPerceptionSummaryDocumentReference>
        ";
            }
            // line 73
            echo "<cac:Status>
            <cbc:ConditionCode>";
            // line 74
            echo $this->getAttribute($context["det"], "estado", []);
            echo "</cbc:ConditionCode>
        </cac:Status>
        <sac:TotalAmount currencyID=\"";
            // line 76
            echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
            echo "\">";
            echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute($context["det"], "total", [])]);
            echo "</sac:TotalAmount>
        ";
            // line 77
            if ($this->getAttribute($context["det"], "mtoOperGravadas", [])) {
                // line 78
                echo "<sac:BillingPayment>
            <cbc:PaidAmount currencyID=\"";
                // line 79
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute($context["det"], "mtoOperGravadas", [])]);
                echo "</cbc:PaidAmount>
            <cbc:InstructionID>01</cbc:InstructionID>
        </sac:BillingPayment>
        ";
            }
            // line 83
            if ($this->getAttribute($context["det"], "mtoOperExoneradas", [])) {
                // line 84
                echo "<sac:BillingPayment>
            <cbc:PaidAmount currencyID=\"";
                // line 85
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute($context["det"], "mtoOperExoneradas", [])]);
                echo "</cbc:PaidAmount>
            <cbc:InstructionID>02</cbc:InstructionID>
        </sac:BillingPayment>
        ";
            }
            // line 89
            if ($this->getAttribute($context["det"], "mtoOperInafectas", [])) {
                // line 90
                echo "<sac:BillingPayment>
            <cbc:PaidAmount currencyID=\"";
                // line 91
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute($context["det"], "mtoOperInafectas", [])]);
                echo "</cbc:PaidAmount>
            <cbc:InstructionID>03</cbc:InstructionID>
        </sac:BillingPayment>
        ";
            }
            // line 95
            if ($this->getAttribute($context["det"], "mtoOperExportacion", [])) {
                // line 96
                echo "<sac:BillingPayment>
            <cbc:PaidAmount currencyID=\"";
                // line 97
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute($context["det"], "mtoOperExportacion", [])]);
                echo "</cbc:PaidAmount>
            <cbc:InstructionID>04</cbc:InstructionID>
        </sac:BillingPayment>
        ";
            }
            // line 101
            if ($this->getAttribute($context["det"], "mtoOperGratuitas", [])) {
                // line 102
                echo "<sac:BillingPayment>
            <cbc:PaidAmount currencyID=\"";
                // line 103
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute($context["det"], "mtoOperGratuitas", [])]);
                echo "</cbc:PaidAmount>
            <cbc:InstructionID>05</cbc:InstructionID>
        </sac:BillingPayment>
        ";
            }
            // line 107
            if ($this->getAttribute($context["det"], "mtoOtrosCargos", [])) {
                // line 108
                echo "<cac:AllowanceCharge>
            <cbc:ChargeIndicator>true</cbc:ChargeIndicator>
            <cbc:Amount currencyID=\"";
                // line 110
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute($context["det"], "mtoOtrosCargos", [])]);
                echo "</cbc:Amount>
        </cac:AllowanceCharge>
        ";
            }
            // line 113
            if ($this->getAttribute($context["det"], "mtoIvap", [])) {
                // line 114
                $context["ivap"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute($context["det"], "mtoIvap", [])]);
                // line 115
                echo "<cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 116
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo (isset($context["ivap"]) ? $context["ivap"] : null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 118
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo (isset($context["ivap"]) ? $context["ivap"] : null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>1016</cbc:ID>
                        <cbc:Name>IVAP</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            } else {
                // line 129
                $context["igv"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute($context["det"], "mtoIGV", [])]);
                // line 130
                echo "<cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 131
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo (isset($context["igv"]) ? $context["igv"] : null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 133
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo (isset($context["igv"]) ? $context["igv"] : null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>1000</cbc:ID>
                        <cbc:Name>IGV</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            }
            // line 144
            if ($this->getAttribute($context["det"], "mtoISC", [])) {
                // line 145
                $context["isc"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute($context["det"], "mtoISC", [])]);
                // line 146
                echo "<cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 147
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo (isset($context["isc"]) ? $context["isc"] : null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 149
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo (isset($context["isc"]) ? $context["isc"] : null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>2000</cbc:ID>
                        <cbc:Name>ISC</cbc:Name>
                        <cbc:TaxTypeCode>EXC</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            }
            // line 160
            echo "        ";
            if ($this->getAttribute($context["det"], "mtoOtrosTributos", [])) {
                // line 161
                $context["oth"] = call_user_func_array($this->env->getFilter('n_format')->getCallable(), [$this->getAttribute($context["det"], "mtoOtrosTributos", [])]);
                // line 162
                echo "<cac:TaxTotal>
            <cbc:TaxAmount currencyID=\"";
                // line 163
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo (isset($context["oth"]) ? $context["oth"] : null);
                echo "</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxAmount currencyID=\"";
                // line 165
                echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "moneda", []);
                echo "\">";
                echo (isset($context["oth"]) ? $context["oth"] : null);
                echo "</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cac:TaxScheme>
                        <cbc:ID>9999</cbc:ID>
                        <cbc:Name>OTROS</cbc:Name>
                        <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        ";
            }
            // line 176
            echo "</sac:SummaryDocumentsLine>
    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['det'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 178
        echo "</SummaryDocuments>";
    }

    public function getTemplateName()
    {
        return "summary.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  424 => 178,  409 => 176,  393 => 165,  386 => 163,  383 => 162,  381 => 161,  378 => 160,  362 => 149,  355 => 147,  352 => 146,  350 => 145,  348 => 144,  332 => 133,  325 => 131,  322 => 130,  320 => 129,  304 => 118,  297 => 116,  294 => 115,  292 => 114,  290 => 113,  282 => 110,  278 => 108,  276 => 107,  267 => 103,  264 => 102,  262 => 101,  253 => 97,  250 => 96,  248 => 95,  239 => 91,  236 => 90,  234 => 89,  225 => 85,  222 => 84,  220 => 83,  211 => 79,  208 => 78,  206 => 77,  200 => 76,  195 => 74,  192 => 73,  186 => 70,  182 => 69,  178 => 68,  174 => 67,  170 => 66,  167 => 65,  165 => 64,  163 => 63,  156 => 59,  152 => 58,  148 => 56,  146 => 55,  141 => 53,  137 => 52,  132 => 50,  128 => 49,  124 => 48,  121 => 47,  104 => 46,  97 => 42,  90 => 38,  77 => 28,  71 => 25,  65 => 22,  62 => 21,  60 => 20,  56 => 19,  52 => 18,  48 => 17,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "summary.xml.twig", "C:\\AppServ\\www\\Lab\\factbackend\\vendor\\greenter\\xml\\src\\Xml\\Templates\\summary.xml.twig");
    }
}
