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

/* assets/style.min.css */
class __TwigTemplate_ffbf08ef0b905a4fe97cb2e109160c73794791aa45d7fbb27a3212fd56ff771c extends \Twig\Template
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
        echo "html{font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:transparent}body{color:#424242;font-family:Tahoma,Geneva,sans-serif;margin:0;padding-top:0;font-size:11px}.text-red{color:#d32f2f}.text-blue{color:#1976d2}table th,table td{font-size:11px}.tabla_borde{border:1px solid #757575;border-radius:10px;font-size:12px;font-family:\"open sans\",\"Helvetica Neue\",Helvetica,Arial,sans-serif}.tabla_borde>.title{background:#757575;font-size:15px;border-top-left-radius:8px;border-top-right-radius:8px;padding:5px 20px;color:white}.table{margin-bottom:15px;font-family:Tahoma,Geneva,sans-serif}table.details{border-collapse:collapse;border-style:hidden;border-radius:8px;overflow:hidden}.table caption{background-color:#42a5f5;color:#fff;font-size:15px;font-weight:bold;padding:5px 15px}table.details th,table.details td{padding:3px;border-width:1px;border-style:solid;border-color:#42a5f5 #9e9e9e}table.details thead th{background-color:#e1f5fe}table.details tr.even{background-color:#e1f5fe}table.details tfoot th,table.details tfoot td{background-color:#9e9e9e;color:#fff}table.resumen{border-collapse:collapse;border:1px solid #9e9e9e;border-radius:8px;overflow:hidden;box-shadow:0 0 0 1px #9e9e9e}table.resumen td{padding:3px;border-width:1px;border-style:solid;border-color:#9e9e9e}";
    }

    public function getTemplateName()
    {
        return "assets/style.min.css";
    }

    public function getDebugInfo()
    {
        return array (  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "assets/style.min.css", "C:\\AppServ\\www\\Lab\\factbackend\\resources\\reports\\Templates\\assets\\style.min.css");
    }
}
