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

/* acp_language.html */
class __TwigTemplate_290ba63c4f7425b8a3c78421fedec5c193e33690deac927a5e8c3fd619514532 extends \Twig\Template
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
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_header.html", "acp_language.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if (($context["S_DETAILS"] ?? null)) {
            // line 6
            echo "
\t<a href=\"";
            // line 7
            echo ($context["U_BACK"] ?? null);
            echo "\" style=\"float: ";
            echo ($context["S_CONTENT_FLOW_END"] ?? null);
            echo ";\">&laquo; ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BACK");
            echo "</a>

\t<h1>";
            // line 9
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LANGUAGE_PACK_DETAILS");
            echo "</h1>

\t<form id=\"details\" method=\"post\" action=\"";
            // line 11
            echo ($context["U_ACTION"] ?? null);
            echo "\">

\t<fieldset>
\t\t<legend>";
            // line 14
            echo ($context["LANG_LOCAL_NAME"] ?? null);
            echo "</legend>
\t<dl>
\t\t<dt><label for=\"lang_english_name\">";
            // line 16
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LANG_ENGLISH_NAME");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</label></dt>
\t\t<dd><input type=\"text\" id=\"lang_english_name\" name=\"lang_english_name\" value=\"";
            // line 17
            echo ($context["LANG_ENGLISH_NAME"] ?? null);
            echo "\" maxlength=\"100\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"lang_local_name\">";
            // line 20
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LANG_LOCAL_NAME");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</label></dt>
\t\t<dd><input type=\"text\" id=\"lang_local_name\" name=\"lang_local_name\" value=\"";
            // line 21
            echo ($context["LANG_LOCAL_NAME"] ?? null);
            echo "\" maxlength=\"255\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label>";
            // line 24
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LANG_ISO_CODE");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</label></dt>
\t\t<dd><strong>";
            // line 25
            echo ($context["LANG_ISO"] ?? null);
            echo "</strong></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"lang_author\">";
            // line 28
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LANG_AUTHOR");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</label></dt>
\t\t<dd><input type=\"text\" id=\"lang_author\" name=\"lang_author\" value=\"";
            // line 29
            echo ($context["LANG_AUTHOR"] ?? null);
            echo "\" maxlength=\"255\" /></dd>
\t</dl>

\t<p class=\"quick\" style=\"margin-top: -15px;\">
\t\t<input type=\"submit\" name=\"update_details\" class=\"button2\" value=\"";
            // line 33
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SUBMIT");
            echo "\" />
\t</p>
\t";
            // line 35
            echo ($context["S_FORM_TOKEN"] ?? null);
            echo "
\t</fieldset>
\t</form>

\t";
            // line 39
            if (twig_length_filter($this->env, $this->getAttribute(($context["loops"] ?? null), "missing_files", []))) {
                // line 40
                echo "\t\t<h3 class=\"error\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("MISSING_FILES");
                echo "</h3>

\t\t<fieldset>
\t\t\t<legend>";
                // line 43
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("MISSING_LANG_FILES");
                echo "</legend>
\t\t\t";
                // line 44
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["loops"] ?? null), "missing_files", []));
                foreach ($context['_seq'] as $context["_key"] => $context["missing_files"]) {
                    // line 45
                    echo "\t\t\t&raquo; ";
                    echo $this->getAttribute($context["missing_files"], "FILE_NAME", []);
                    echo "<br />
\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['missing_files'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 47
                echo "\t\t</fieldset>
\t";
            }
            // line 49
            echo "
\t";
            // line 50
            if (twig_length_filter($this->env, $this->getAttribute(($context["loops"] ?? null), "missing_varfile", []))) {
                // line 51
                echo "\t\t<h3 class=\"error\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("MISSING_VARS_EXPLAIN");
                echo "</h3>

\t\t<fieldset>
\t\t\t<legend>";
                // line 54
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("MISSING_LANG_VARIABLES");
                echo "</legend>
\t\t\t";
                // line 55
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["loops"] ?? null), "missing_varfile", []));
                foreach ($context['_seq'] as $context["_key"] => $context["missing_varfile"]) {
                    // line 56
                    echo "\t\t\t<dl>
\t\t\t\t<dt><label>";
                    // line 57
                    echo $this->getAttribute($context["missing_varfile"], "FILE_NAME", []);
                    echo "</label></dt>
\t\t\t\t";
                    // line 58
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["missing_varfile"], "variable", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["variable"]) {
                        // line 59
                        echo "\t\t\t\t<dd>";
                        echo $this->getAttribute($context["variable"], "VAR_NAME", []);
                        echo "</dd>
\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['variable'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 61
                    echo "\t\t\t</dl>
\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['missing_varfile'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 63
                echo "\t\t</fieldset>
\t";
            }
        } else {
            // line 66
            echo "
\t<h1>";
            // line 67
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_LANGUAGE_PACKS");
            echo "</h1>

\t<p>";
            // line 69
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_LANGUAGE_PACKS_EXPLAIN");
            echo "</p>

\t<fieldset class=\"quick\">
\t\t<span class=\"small\"><a href=\"https://www.phpbb.com/go/customise/language-packs/3.2\" target=\"_blank\">";
            // line 72
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BROWSE_LANGUAGE_PACKS_DATABASE");
            echo "</a></span>
\t</fieldset>

\t<table class=\"table1 zebra-table\">
\t<thead>
\t<tr>
\t\t<th>";
            // line 78
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LANGUAGE_PACK_NAME");
            echo "</th>
\t\t<th>";
            // line 79
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LANGUAGE_PACK_LOCALNAME");
            echo "</th>
\t\t<th>";
            // line 80
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LANGUAGE_PACK_ISO");
            echo "</th>
\t\t<th>";
            // line 81
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LANGUAGE_PACK_USED_BY");
            echo "</th>
\t\t<th>";
            // line 82
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("OPTIONS");
            echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t<tr>
\t\t<td class=\"row3\" colspan=\"5\"><strong>";
            // line 87
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("INSTALLED_LANGUAGE_PACKS");
            echo "</strong></td>
\t</tr>
\t";
            // line 89
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["loops"] ?? null), "lang", []));
            foreach ($context['_seq'] as $context["_key"] => $context["lang"]) {
                // line 90
                echo "\t<tr>
\t\t<td><a href=\"";
                // line 91
                echo $this->getAttribute($context["lang"], "U_DETAILS", []);
                echo "\">";
                echo $this->getAttribute($context["lang"], "ENGLISH_NAME", []);
                echo "</a> ";
                echo $this->getAttribute($context["lang"], "TAG", []);
                echo "</td>
\t\t<td>";
                // line 92
                echo $this->getAttribute($context["lang"], "LOCAL_NAME", []);
                echo "</td>
\t\t<td style=\"text-align: center;\"><strong>";
                // line 93
                echo $this->getAttribute($context["lang"], "ISO", []);
                echo "</strong></td>
\t\t<td style=\"text-align: center;\">";
                // line 94
                echo $this->getAttribute($context["lang"], "USED_BY", []);
                echo "</td>
\t\t<td style=\"text-align: center;\"><a href=\"";
                // line 95
                echo $this->getAttribute($context["lang"], "U_DELETE", []);
                echo "\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DELETE");
                echo "</a></td>
\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['lang'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 98
            echo "\t";
            if (twig_length_filter($this->env, $this->getAttribute(($context["loops"] ?? null), "notinst", []))) {
                // line 99
                echo "\t<tr>
\t\t<td class=\"row3\" colspan=\"5\"><strong>";
                // line 100
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("UNINSTALLED_LANGUAGE_PACKS");
                echo "</strong></td>
\t</tr>
\t";
            }
            // line 103
            echo "\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["loops"] ?? null), "notinst", []));
            foreach ($context['_seq'] as $context["_key"] => $context["notinst"]) {
                // line 104
                echo "\t<tr>
\t\t<td>";
                // line 105
                echo $this->getAttribute($context["notinst"], "NAME", []);
                echo "</td>
\t\t<td>";
                // line 106
                echo $this->getAttribute($context["notinst"], "LOCAL_NAME", []);
                echo "</td>
\t\t<td style=\"text-align: center;\"><strong>";
                // line 107
                echo $this->getAttribute($context["notinst"], "ISO", []);
                echo "</strong></td>
\t\t<td colspan=\"2\" style=\"text-align: center;\"><a href=\"";
                // line 108
                echo $this->getAttribute($context["notinst"], "U_INSTALL", []);
                echo "\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("INSTALL");
                echo "</a></td>
\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notinst'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 111
            echo "\t</tbody>
\t</table>

";
        }
        // line 115
        echo "
";
        // line 116
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_language.html", 116)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_language.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  358 => 116,  355 => 115,  349 => 111,  338 => 108,  334 => 107,  330 => 106,  326 => 105,  323 => 104,  318 => 103,  312 => 100,  309 => 99,  306 => 98,  295 => 95,  291 => 94,  287 => 93,  283 => 92,  275 => 91,  272 => 90,  268 => 89,  263 => 87,  255 => 82,  251 => 81,  247 => 80,  243 => 79,  239 => 78,  230 => 72,  224 => 69,  219 => 67,  216 => 66,  211 => 63,  204 => 61,  195 => 59,  191 => 58,  187 => 57,  184 => 56,  180 => 55,  176 => 54,  169 => 51,  167 => 50,  164 => 49,  160 => 47,  151 => 45,  147 => 44,  143 => 43,  136 => 40,  134 => 39,  127 => 35,  122 => 33,  115 => 29,  110 => 28,  104 => 25,  99 => 24,  93 => 21,  88 => 20,  82 => 17,  77 => 16,  72 => 14,  66 => 11,  61 => 9,  52 => 7,  49 => 6,  47 => 5,  42 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "acp_language.html", "");
    }
}
