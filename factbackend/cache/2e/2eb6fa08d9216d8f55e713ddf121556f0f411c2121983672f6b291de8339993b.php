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

/* invoice.html.twig */
class __TwigTemplate_654f17438e6afe8727f0771d253c565472d6cc40d9260c8be84c0d627199b327 extends \Twig\Template
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
        echo "<html>
<head>
    <title>";
        // line 3
        echo $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "tipoDoc", []), "01");
        echo " ELECTRONICA</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    <style type=\"text/css\">
        ";
        // line 6
        $this->loadTemplate("assets/style.min.css", "invoice.html.twig", 6)->display($context);
        // line 7
        echo "    </style>
</head>
<body>
";
        // line 10
        $context["cp"] = $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "company", []);
        // line 11
        $context["isNota"] = twig_in_filter($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "tipoDoc", []), [0 => "07", 1 => "08"]);
        // line 12
        $context["isAnticipo"] = ($this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "totalAnticipos", [], "any", true, true) && ($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "totalAnticipos", []) > 0));
        // line 13
        $context["name"] = $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "tipoDoc", []), "01");
        // line 14
        echo "<table width=\"100%\">
    <tbody>
        <tr>
        <td style=\"padding:30px; !important\">
            <table width=\"100%\" height=\"40px\" style=\"margin-bottom: 20px\" border=\"0\" aling=\"center\">
                <tbody><tr>
                    <td width=\"30%\"  align=\"center\">
                        <span><img src=\"";
        // line 21
        echo $this->env->getRuntime('Greenter\Report\Filter\ImageFilter')->toBase64($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "system", []), "logo", []));
        echo "\" height=\"55\" style=\"text-align:center\" border=\"0\"></span>
                    </td>
                    <td width=\"40%\"  align=\"center\">
                        <strong class=\"text-red\" style=\"font-size: 15px\">
                            PRECISA
                        </strong>
                        <strong class=\"text-blue\" style=\"font-size: 15px\">
                            DIAGNOSTICA
                        </strong>
                        <strong style=\"font-size: 15px\">
                            S.A.C.
                        </strong>
                        <br>
                        <span style=\"font-size: 10px\">
                           ";
        // line 35
        echo $this->getAttribute($this->getAttribute((isset($context["cp"]) ? $context["cp"] : $this->getContext($context, "cp")), "address", []), "direccion", []);
        echo "<br>
                           ";
        // line 36
        echo $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "user", []), "urbanizacion", []);
        echo "<br>
                           ";
        // line 37
        echo $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "user", []), "ubigeodir", []);
        echo "<br>
                        </span>
                    </td>
                    <td width=\"35%\"  valign=\"bottom\" style=\"padding-left:0\">
                        <div class=\"tabla_borde\">
                            <table width=\"100%\" border=\"0\" height=\"40\" cellpadding=\"6\" cellspacing=\"0\">
                                <tbody>
                                    <tr>
                                        <td align=\"center\">
                                            <strong style=\"font-size:16px\" text-align=\"center\">RUC : ";
        // line 46
        echo $this->getAttribute((isset($context["cp"]) ? $context["cp"] : $this->getContext($context, "cp")), "ruc", []);
        echo "</strong><br>
                                            <strong style=\"font-size:15px\" class=\"text-red\" text-align=\"center\">";
        // line 47
        echo (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name"));
        echo "</strong>
                                            <br>
                                            <strong style=\"font-size:15px\" class=\"text-blue\" text-align=\"center\">
                                                ELECTRÓNICA
                                            </strong><br>
                                            <strong style=\"font-size:14px\" >";
        // line 52
        echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "serie", []);
        echo "-";
        echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "correlativo", []);
        echo "</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            ";
        // line 62
        $context["cl"] = $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "client", []);
        // line 63
        echo "            <table width=\"100%\" class=\"table\">
                <tbody>
                    <tr>
                        <th width=\"13%\" align=\"left\">
                            ";
        // line 67
        if (($this->getAttribute((isset($context["cl"]) ? $context["cl"] : $this->getContext($context, "cl")), "tipoDoc", []) == 6)) {
            echo "RAZON SOCIAL";
        } else {
            echo "NOMBRES ";
        }
        // line 68
        echo "                        </th>
                        <th width=\"1%\">:</th>
                        <td width=\"46%\">
                            ";
        // line 71
        echo $this->getAttribute((isset($context["cl"]) ? $context["cl"] : $this->getContext($context, "cl")), "rznSocial", []);
        echo "
                        </td>
                        <th width=\"13%\" align=\"left\">
                            ";
        // line 74
        echo $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog($this->getAttribute((isset($context["cl"]) ? $context["cl"] : $this->getContext($context, "cl")), "tipoDoc", []), "06");
        echo "
                        </th>
                        <th width=\"1%\">:</th>
                        <td width=\"26%\">";
        // line 77
        echo $this->getAttribute((isset($context["cl"]) ? $context["cl"] : $this->getContext($context, "cl")), "numDoc", []);
        echo "</td>
                    </tr>
                    <tr>
                        <th width=\"13%\" align=\"left\">
                            DIRECCION
                        </th>
                        <th width=\"1%\">:</th>
                        <td width=\"46%\">
                            ";
        // line 85
        if ($this->getAttribute((isset($context["cl"]) ? $context["cl"] : $this->getContext($context, "cl")), "address", [])) {
            echo $this->getAttribute($this->getAttribute((isset($context["cl"]) ? $context["cl"] : $this->getContext($context, "cl")), "address", []), "direccion", []);
        }
        // line 86
        echo "                        </td>
                        <th width=\"13%\" align=\"left\">
                            FECHA EMISION
                        </th>
                        <th width=\"1%\">:</th>
                        <td width=\"26%\">
                            ";
        // line 92
        echo twig_date_format_filter($this->env, $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "fechaEmision", []), "d/m/Y h:i:s A");
        echo "
                        </td>
                    </tr>
                    ";
        // line 95
        if ((isset($context["isNota"]) ? $context["isNota"] : $this->getContext($context, "isNota"))) {
            // line 96
            echo "                    <tr>
                        <th width=\"13%\" align=\"left\">
                            TIPO DOC. REF.
                        </th>
                        <th width=\"1%\">:</th>
                        <td width=\"46%\">";
            // line 101
            echo $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "tipDocAfectado", []), "01");
            echo "</td>
                        <th width=\"13%\" align=\"left\">
                            NRO. DOC. REF.
                        </th>
                        <th width=\"1%\">:</th>
                        <td width=\"26%\">";
            // line 106
            echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "numDocfectado", []);
            echo "</td>
                    </tr>
                    ";
        }
        // line 109
        echo "                    <tr>
                        <th width=\"13%\" align=\"left\">
                            MONEDA
                        </th>
                        <th width=\"1%\">:</th>
                        <td width=\"46%\">
                            ";
        // line 115
        echo $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "tipoMoneda", []), "021");
        echo "
                        </td>
                        ";
        // line 117
        if (($this->getAttribute((isset($context["doc"]) ? $context["doc"] : null), "compra", [], "any", true, true) && $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "compra", []))) {
            // line 118
            echo "                            <th width=\"13%\">O/C</th><th >:</th> <td>";
            echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "compra", []);
            echo "</td>
                        ";
        } else {
            // line 119
            echo "<th width=\"13%\"></th><th width=\"1%\"></th><td width=\"26%\"></td>";
        }
        // line 120
        echo "                    </tr>
                    ";
        // line 121
        if ($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "guias", [])) {
            // line 122
            echo "                    <tr>
                        <td width=\"60%\" align=\"left\"><strong>Guias: </strong>
                        ";
            // line 124
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "guias", []));
            foreach ($context['_seq'] as $context["_key"] => $context["guia"]) {
                // line 125
                echo "                            ";
                echo $this->getAttribute($context["guia"], "nroDoc", []);
                echo "&nbsp;&nbsp;
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['guia'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 126
            echo "</td>
                        <td width=\"40%\"></td>
                    </tr>
                    ";
        }
        // line 130
        echo "                </tbody>
            </table>
            ";
        // line 132
        $context["moneda"] = $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "tipoMoneda", []), "02");
        // line 133
        echo "            <table width=\"100%\" class=\"table details\">
                <caption>DETALLE DEL COMPROBANTE</caption>
                <thead>
                    <tr>
                        <th align=\"center\">CANT.</th>
                        <th align=\"center\">UND.</th>
                        <th align=\"center\">CODIGO</th>
                        <th align=\"center\">DESCRIPCION</th>
                        <th align=\"center\">VALOR UNIT.</th>
                        <th align=\"center\">VALOR TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    ";
        // line 146
        $context["rel"] = true;
        // line 147
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "details", []));
        foreach ($context['_seq'] as $context["_key"] => $context["det"]) {
            // line 148
            echo "                        <tr ";
            if ((isset($context["rel"]) ? $context["rel"] : $this->getContext($context, "rel"))) {
                echo "class=\"odd\"";
            } else {
                echo "class=\"even\"";
            }
            echo ">
                            <td align=\"right\">
                                ";
            // line 150
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute($context["det"], "cantidad", []));
            echo "
                            </td>
                            <td align=\"center\">
                                ";
            // line 153
            echo $this->getAttribute($context["det"], "unidad", []);
            echo "
                            </td>
                            <td align=\"center\">
                                ";
            // line 156
            echo $this->getAttribute($context["det"], "codProducto", []);
            echo "
                            </td>
                            <td width=\"300px\">
                                <span>";
            // line 159
            echo $this->getAttribute($context["det"], "descripcion", []);
            echo "</span><br>
                            </td>
                            <td align=\"right\">
                                ";
            // line 162
            echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
            echo "
                                ";
            // line 163
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute($context["det"], "mtoValorUnitario", []));
            echo "
                            </td>
                            <td align=\"right\">
                                ";
            // line 166
            echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
            echo "
                                ";
            // line 167
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute($context["det"], "mtoValorVenta", []));
            echo "
                            </td>
                        </tr>
                        ";
            // line 170
            if ((isset($context["rel"]) ? $context["rel"] : $this->getContext($context, "rel"))) {
                $context["rel"] = false;
                echo " ";
            } else {
                $context["rel"] = true;
            }
            // line 171
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['det'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 172
        echo "                </tbody>
                <tfoot>
                    <tr>
                        <th colspan=\"4\" align=\"right\"> TOTAL ITEMS : ";
        // line 175
        echo twig_length_filter($this->env, $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "details", []));
        echo "</th>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody>
                <tr>
                    <td width=\"60%\" valign=\"top\">
                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                            <tbody>
                            <tr>
                                <td colspan=\"4\">
                                    <br>
                                    <br>
                                    <span text-align=\"center\">
                                        <strong>";
        // line 192
        echo $this->env->getRuntime('Greenter\Report\Filter\ResolveFilter')->getValueLegend($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "legends", []), "1000");
        echo "</strong>
                                    </span>
                                    <br>
                                    <br>
                                    <strong>Información Adicional</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                            <tbody>
                            <tr class=\"border_top\">
                                <td width=\"30%\" style=\"font-size: 10px;\">
                                    LEYENDA:
                                </td>
                                <td width=\"70%\" style=\"font-size: 10px;\">
                                    <p>
                                        ";
        // line 209
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "legends", []));
        foreach ($context['_seq'] as $context["_key"] => $context["leg"]) {
            // line 210
            echo "                                        ";
            if (($this->getAttribute($context["leg"], "code", []) != "1000")) {
                // line 211
                echo "                                            ";
                echo $this->getAttribute($context["leg"], "value", []);
                echo "<br>
                                        ";
            }
            // line 213
            echo "                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['leg'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 214
        echo "                                    </p>
                                </td>
                            </tr>
                            ";
        // line 217
        if ((isset($context["isNota"]) ? $context["isNota"] : $this->getContext($context, "isNota"))) {
            // line 218
            echo "                            <tr class=\"border_top\">
                                <td width=\"30%\" style=\"font-size: 10px;\">
                                    MOTIVO DE EMISIÓN:
                                </td>
                                <td width=\"70%\" style=\"font-size: 10px;\">
                                    ";
            // line 223
            echo $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "desMotivo", []);
            echo "
                                </td>
                            </tr>
                            ";
        }
        // line 227
        echo "                            ";
        if ($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "user", [], "any", false, true), "extras", [], "any", true, true)) {
            // line 228
            echo "                                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "user", []), "extras", []));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 229
                echo "                                    <tr class=\"border_top\">
                                        <td width=\"30%\" style=\"font-size: 10px;\">
                                            ";
                // line 231
                echo twig_upper_filter($this->env, $this->getAttribute($context["item"], "name", []));
                echo ":
                                        </td>
                                        <td width=\"70%\" style=\"font-size: 10px;\">
                                            ";
                // line 234
                echo $this->getAttribute($context["item"], "value", []);
                echo "
                                        </td>
                                    </tr>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 238
            echo "                            ";
        }
        // line 239
        echo "                            </tbody>
                        </table>
                        ";
        // line 241
        if ((isset($context["isAnticipo"]) ? $context["isAnticipo"] : $this->getContext($context, "isAnticipo"))) {
            // line 242
            echo "                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
                            <tbody>
                            <tr>
                                <td>
                                    <br>
                                    <strong>Anticipo</strong>
                                    <br>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\" style=\"font-size: 10px;\">
                            <tbody>
                            <tr>
                                <td width=\"30%\"><b>Nro. Doc.</b></td>
                                <td width=\"70%\"><b>Total</b></td>
                            </tr>
                            ";
            // line 259
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "anticipos", []));
            foreach ($context['_seq'] as $context["_key"] => $context["atp"]) {
                // line 260
                echo "                            <tr class=\"border_top\">
                                <td width=\"30%\">";
                // line 261
                echo $this->getAttribute($context["atp"], "nroDocRel", []);
                echo "</td>
                                <td width=\"70%\">";
                // line 262
                echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
                echo " ";
                echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute($context["atp"], "total", []));
                echo "</td>
                            </tr>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['atp'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 265
            echo "                            </tbody>
                        </table>
                        ";
        }
        // line 268
        echo "                    </td>
                    <td width=\"40%\" valign=\"top\">
                        <br>
                        <table width=\"100%\" class=\"table resumen\">
                            <tbody>
                            ";
        // line 273
        if ((isset($context["isAnticipo"]) ? $context["isAnticipo"] : $this->getContext($context, "isAnticipo"))) {
            // line 274
            echo "                                <tr class=\"border_bottom\">
                                    <td align=\"right\"><strong>TOTAL ANTICIPO :</strong></td>
                                    <td width=\"120\" align=\"right\">
                                        <span>";
            // line 277
            echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "totalAnticipos", []));
            echo "</span>
                                    </td>
                                </tr>
                            ";
        }
        // line 281
        echo "                            ";
        if ($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoOperGravadas", [])) {
            // line 282
            echo "                            <tr class=\"border_bottom\">
                                <td align=\"right\"><strong>OP. GRAVADAS :</strong></td>
                                <td width=\"120\" align=\"right\">
                                    <span>";
            // line 285
            echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoOperGravadas", []));
            echo "</span>
                                </td>
                            </tr>
                            ";
        }
        // line 289
        echo "                            ";
        if ($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoOperInafectas", [])) {
            // line 290
            echo "                            <tr class=\"border_bottom\">
                                <td align=\"right\"><strong>OP. INAFECTAS :</strong></td>
                                <td width=\"120\" align=\"right\">
                                    <span>";
            // line 293
            echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoOperInafectas", []));
            echo "</span>
                                </td>
                            </tr>
                            ";
        }
        // line 297
        echo "                            ";
        if ($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoOperExoneradas", [])) {
            // line 298
            echo "                            <tr class=\"border_bottom\">
                                <td align=\"right\">
                                    <strong>OP. EXONERADAS :</strong>
                                </td>
                                <td width=\"120\" align=\"right\">
                                    <span>";
            // line 303
            echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoOperExoneradas", []));
            echo "</span>
                                </td>
                            </tr>
                            ";
        }
        // line 307
        echo "                            <tr>
                                <td align=\"right\"><strong>IGV (18%) :</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
        // line 309
        echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
        echo "  ";
        echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoIGV", []));
        echo "</span></td>
                            </tr>
                            ";
        // line 311
        if ($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoISC", [])) {
            // line 312
            echo "                            <tr>
                                <td align=\"right\"><strong>ISC :</strong></td>
                                <td width=\"120\" align=\"right\"><span>";
            // line 314
            echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoISC", []));
            echo "</span></td>
                            </tr>
                            ";
        }
        // line 317
        echo "                            ";
        if ($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "sumOtrosCargos", [])) {
            // line 318
            echo "                                <tr>
                                    <td align=\"right\"><strong>OTROS CARGOS :</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 320
            echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "sumOtrosCargos", []));
            echo "</span></td>
                                </tr>
                            ";
        }
        // line 323
        echo "                            ";
        if ($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoOtrosTributos", [])) {
            // line 324
            echo "                                <tr>
                                    <td align=\"right\"><strong>OTROS TRIBUTOS :</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 326
            echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoOtrosTributos", []));
            echo "</span></td>
                                </tr>
                            ";
        }
        // line 329
        echo "                            <tr>
                                <td align=\"right\"><strong>PRECIO VENTA :</strong></td>
                                <td width=\"120\" align=\"right\"><span id=\"ride-importeTotal\" class=\"ride-importeTotal\">";
        // line 331
        echo (isset($context["moneda"]) ? $context["moneda"] : $this->getContext($context, "moneda"));
        echo "  ";
        echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "mtoImpVenta", []));
        echo "</span></td>
                            </tr>
                            ";
        // line 333
        if (($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "perception", []) && $this->getAttribute($this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "perception", []), "mto", []))) {
            // line 334
            echo "                                ";
            $context["perc"] = $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "perception", []);
            // line 335
            echo "                                ";
            $context["soles"] = $this->env->getRuntime('Greenter\Report\Filter\DocumentFilter')->getValueCatalog("PEN", "02");
            // line 336
            echo "                                <tr>
                                    <td align=\"right\"><strong>PERCEPCION :</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 338
            echo (isset($context["soles"]) ? $context["soles"] : $this->getContext($context, "soles"));
            echo "  ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute((isset($context["perc"]) ? $context["perc"] : $this->getContext($context, "perc")), "mto", []));
            echo "</span></td>
                                </tr>
                                <tr>
                                    <td align=\"right\"><strong>TOTAL AL PAGAR :</strong></td>
                                    <td width=\"120\" align=\"right\"><span>";
            // line 342
            echo (isset($context["soles"]) ? $context["soles"] : $this->getContext($context, "soles"));
            echo " ";
            echo $this->env->getRuntime('Greenter\Report\Filter\FormatFilter')->number($this->getAttribute((isset($context["perc"]) ? $context["perc"] : $this->getContext($context, "perc")), "mtoTotal", []));
            echo "</span></td>
                                </tr>
                            ";
        }
        // line 345
        echo "                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody></table>
            ";
        // line 350
        if (((isset($context["max_items"]) || array_key_exists("max_items", $context)) && (twig_length_filter($this->env, $this->getAttribute((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc")), "details", [])) > (isset($context["max_items"]) ? $context["max_items"] : $this->getContext($context, "max_items"))))) {
            // line 351
            echo "                <div style=\"page-break-after:always;\"></div>
            ";
        }
        // line 353
        echo "            <div>
                <hr style=\"display: block; height: 1px; border: 0; border-top: 1px solid #666; margin: 10px 0; padding: 0;\">
                <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                    <tbody><tr>
                        <td width=\"85%\">
                            <blockquote>
                                ";
        // line 359
        if ($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "user", [], "any", false, true), "footer", [], "any", true, true)) {
            // line 360
            echo "                                    ";
            echo $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "user", []), "footer", []);
            echo "
                                ";
        }
        // line 362
        echo "                                ";
        if (($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "system", [], "any", false, true), "hash", [], "any", true, true) && $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "system", []), "hash", []))) {
            // line 363
            echo "                                    <strong>Resumen :</strong>   ";
            echo $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "system", []), "hash", []);
            echo "<br>
                                ";
        }
        // line 365
        echo "                                <span>Representacion impresa de la ";
        echo (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name"));
        echo " ELECTRÓNICA.</span><br>
                                <span>Autorizado mediante Resolución ";
        // line 366
        echo $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "user", []), "resolucion", []);
        echo "</span>
                            </blockquote>
                        </td>
                        <td width=\"15%\" align=\"right\">
                            <img src=\"";
        // line 370
        echo $this->env->getRuntime('Greenter\Report\Filter\ImageFilter')->toBase64($this->env->getRuntime('Greenter\Report\Render\QrRender')->getImage((isset($context["doc"]) ? $context["doc"] : $this->getContext($context, "doc"))), "png");
        echo "\" alt=\"Qr Image\">
                        </td>
                    </tr>
                    </tbody></table>
            </div>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "invoice.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  747 => 370,  740 => 366,  735 => 365,  729 => 363,  726 => 362,  720 => 360,  718 => 359,  710 => 353,  706 => 351,  704 => 350,  697 => 345,  689 => 342,  680 => 338,  676 => 336,  673 => 335,  670 => 334,  668 => 333,  661 => 331,  657 => 329,  649 => 326,  645 => 324,  642 => 323,  634 => 320,  630 => 318,  627 => 317,  619 => 314,  615 => 312,  613 => 311,  606 => 309,  602 => 307,  593 => 303,  586 => 298,  583 => 297,  574 => 293,  569 => 290,  566 => 289,  557 => 285,  552 => 282,  549 => 281,  540 => 277,  535 => 274,  533 => 273,  526 => 268,  521 => 265,  510 => 262,  506 => 261,  503 => 260,  499 => 259,  480 => 242,  478 => 241,  474 => 239,  471 => 238,  461 => 234,  455 => 231,  451 => 229,  446 => 228,  443 => 227,  436 => 223,  429 => 218,  427 => 217,  422 => 214,  416 => 213,  410 => 211,  407 => 210,  403 => 209,  383 => 192,  363 => 175,  358 => 172,  352 => 171,  345 => 170,  339 => 167,  335 => 166,  329 => 163,  325 => 162,  319 => 159,  313 => 156,  307 => 153,  301 => 150,  291 => 148,  286 => 147,  284 => 146,  269 => 133,  267 => 132,  263 => 130,  257 => 126,  248 => 125,  244 => 124,  240 => 122,  238 => 121,  235 => 120,  232 => 119,  226 => 118,  224 => 117,  219 => 115,  211 => 109,  205 => 106,  197 => 101,  190 => 96,  188 => 95,  182 => 92,  174 => 86,  170 => 85,  159 => 77,  153 => 74,  147 => 71,  142 => 68,  136 => 67,  130 => 63,  128 => 62,  113 => 52,  105 => 47,  101 => 46,  89 => 37,  85 => 36,  81 => 35,  64 => 21,  55 => 14,  53 => 13,  51 => 12,  49 => 11,  47 => 10,  42 => 7,  40 => 6,  34 => 3,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "invoice.html.twig", "C:\\AppServ\\www\\Lab\\factbackend\\resources\\reports\\Templates\\invoice.html.twig");
    }
}
