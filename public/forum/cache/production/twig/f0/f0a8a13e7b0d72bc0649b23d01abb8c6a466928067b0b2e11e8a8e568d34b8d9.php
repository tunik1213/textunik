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

/* ucp_main_front.html */
class __TwigTemplate_101a92cea3e262f36f2096f50f089b2798fe38f300ea6716c654fe36d815a65e extends \Twig\Template
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
        $location = "ucp_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_header.html", "ucp_main_front.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<h2>";
        // line 3
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TITLE");
        echo "</h2>

<div class=\"panel\">
\t<div class=\"inner\">

\t<p>";
        // line 8
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("UCP_WELCOME");
        echo "</p>

";
        // line 10
        if (twig_length_filter($this->env, $this->getAttribute(($context["loops"] ?? null), "topicrow", []))) {
            // line 11
            echo "\t<h3>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("IMPORTANT_NEWS");
            echo "</h3>

\t<ul class=\"topiclist cplist two-long-columns\">
\t";
            // line 14
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["loops"] ?? null), "topicrow", []));
            foreach ($context['_seq'] as $context["_key"] => $context["topicrow"]) {
                // line 15
                echo "\t\t<li class=\"row";
                if (($this->getAttribute($context["topicrow"], "S_ROW_COUNT", []) % 2 == 1)) {
                    echo " bg1";
                } else {
                    echo " bg2";
                }
                echo "\">
\t\t\t<dl class=\"row-item ";
                // line 16
                echo $this->getAttribute($context["topicrow"], "TOPIC_IMG_STYLE", []);
                echo "\">
\t\t\t\t<dt ";
                // line 17
                if ($this->getAttribute($context["topicrow"], "TOPIC_ICON_IMG", [])) {
                    echo "style=\"background-image: url(";
                    echo ($context["T_ICONS_PATH"] ?? null);
                    echo $this->getAttribute($context["topicrow"], "TOPIC_ICON_IMG", []);
                    echo "); background-repeat: no-repeat;\"";
                }
                echo ">
\t\t\t\t\t";
                // line 18
                if ($this->getAttribute($context["topicrow"], "S_UNREAD_TOPIC", [])) {
                    echo "<a href=\"";
                    echo $this->getAttribute($context["topicrow"], "U_NEWEST_POST", []);
                    echo "\" class=\"row-item-link\"></a>";
                }
                // line 19
                echo "\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t";
                // line 20
                if ($this->getAttribute($context["topicrow"], "S_UNREAD", [])) {
                    // line 21
                    echo "\t\t\t\t\t\t\t<a class=\"unread\" href=\"";
                    echo $this->getAttribute($context["topicrow"], "U_NEWEST_POST", []);
                    echo "\">
\t\t\t\t\t\t\t\t<i class=\"icon fa-file fa-fw icon-red icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                    // line 22
                    echo ($context["NEW_POST"] ?? null);
                    echo "</span>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t";
                }
                // line 25
                echo "\t\t\t\t\t\t<a href=\"";
                echo $this->getAttribute($context["topicrow"], "U_VIEW_TOPIC", []);
                echo "\" class=\"topictitle\">";
                echo $this->getAttribute($context["topicrow"], "TOPIC_TITLE", []);
                echo "</a><br />
\t\t\t\t\t\t";
                // line 26
                if (twig_length_filter($this->env, $this->getAttribute($context["topicrow"], "pagination", []))) {
                    // line 27
                    echo "\t\t\t\t\t\t<div class=\"pagination\">
\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t";
                    // line 29
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["topicrow"], "pagination", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["pagination"]) {
                        // line 30
                        echo "\t\t\t\t\t\t\t\t";
                        if ($this->getAttribute($context["pagination"], "S_IS_PREV", [])) {
                            // line 31
                            echo "\t\t\t\t\t\t\t\t";
                        } elseif ($this->getAttribute($context["pagination"], "S_IS_CURRENT", [])) {
                            echo "<li class=\"active\"><span>";
                            echo $this->getAttribute($context["pagination"], "PAGE_NUMBER", []);
                            echo "</span></li>
\t\t\t\t\t\t\t\t";
                        } elseif ($this->getAttribute(                        // line 32
$context["pagination"], "S_IS_ELLIPSIS", [])) {
                            echo "<li class=\"ellipsis\"><span>";
                            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ELLIPSIS");
                            echo "</span></li>
\t\t\t\t\t\t\t\t";
                        } elseif ($this->getAttribute(                        // line 33
$context["pagination"], "S_IS_NEXT", [])) {
                            // line 34
                            echo "\t\t\t\t\t\t\t\t";
                        } else {
                            echo "<li><a href=\"";
                            echo $this->getAttribute($context["pagination"], "PAGE_URL", []);
                            echo "\">";
                            echo $this->getAttribute($context["pagination"], "PAGE_NUMBER", []);
                            echo "</a></li>
\t\t\t\t\t\t\t\t";
                        }
                        // line 36
                        echo "\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pagination'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 37
                    echo "\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
                }
                // line 40
                echo "\t\t\t\t\t\t<div class=\"responsive-hide\">
\t\t\t\t\t\t\t";
                // line 41
                if ($this->getAttribute($context["topicrow"], "ATTACH_ICON_IMG", [])) {
                    echo "<i class=\"icon fa-paperclip fa-fw\" aria-hidden=\"true\"></i> ";
                }
                // line 42
                echo "\t\t\t\t\t\t\t";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_BY_AUTHOR");
                echo " ";
                echo $this->getAttribute($context["topicrow"], "TOPIC_AUTHOR_FULL", []);
                echo " &raquo; ";
                echo $this->getAttribute($context["topicrow"], "FIRST_POST_TIME", []);
                echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"responsive-show\" style=\"display: none;\">
\t\t\t\t\t\t\t";
                // line 45
                if ($this->getAttribute($context["topicrow"], "ATTACH_ICON_IMG", [])) {
                    echo "<i class=\"icon fa-paperclip fa-fw\" aria-hidden=\"true\"></i> ";
                }
                // line 46
                echo "\t\t\t\t\t\t\t";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LAST_POST");
                echo " ";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_BY_AUTHOR");
                echo " ";
                echo $this->getAttribute($context["topicrow"], "LAST_POST_AUTHOR_FULL", []);
                echo " &laquo; <a href=\"";
                echo $this->getAttribute($context["topicrow"], "U_LAST_POST", []);
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("GOTO_LAST_POST");
                echo "\">";
                echo $this->getAttribute($context["topicrow"], "LAST_POST_TIME", []);
                echo "</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</dt>
\t\t\t\t<dd class=\"lastpost\">
\t\t\t\t\t<span>";
                // line 51
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LAST_POST");
                echo " ";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_BY_AUTHOR");
                echo " ";
                echo $this->getAttribute($context["topicrow"], "LAST_POST_AUTHOR_FULL", []);
                echo "
\t\t\t\t\t\t<a href=\"";
                // line 52
                echo $this->getAttribute($context["topicrow"], "U_LAST_POST", []);
                echo "\" title=\"";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("GOTO_LAST_POST");
                echo "\">
\t\t\t\t\t\t\t<i class=\"icon fa-external-link-square fa-fw icon-lightgray icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                // line 53
                echo ($context["VIEW_LATEST_POST"] ?? null);
                echo "</span>
\t\t\t\t\t\t</a>
\t\t\t\t\t\t<br />";
                // line 55
                echo $this->getAttribute($context["topicrow"], "LAST_POST_TIME", []);
                echo "
\t\t\t\t\t</span>
\t\t\t\t</dd>
\t\t\t</dl>
\t\t</li>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['topicrow'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 61
            echo "\t</ul>
";
        }
        // line 63
        echo "
\t<h3>";
        // line 64
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("YOUR_DETAILS");
        echo "</h3>

";
        // line 66
        // line 67
        echo "\t<dl class=\"details\">
\t\t";
        // line 68
        // line 69
        echo "\t\t<dt>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JOINED");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</dt> <dd>";
        echo ($context["JOINED"] ?? null);
        echo "</dd>
\t\t<dt>";
        // line 70
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LAST_ACTIVE");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</dt> <dd>";
        echo ($context["LAST_VISIT_YOU"] ?? null);
        echo "</dd>
\t\t<dt>";
        // line 71
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TOTAL_POSTS");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</dt> <dd>";
        if (($context["POSTS_PCT"] ?? null)) {
            echo ($context["POSTS"] ?? null);
            if (($context["S_DISPLAY_SEARCH"] ?? null)) {
                echo " | <strong><a href=\"";
                echo ($context["U_SEARCH_USER"] ?? null);
                echo "\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SEARCH_YOUR_POSTS");
                echo "</a></strong>";
            }
            echo "<br />(";
            echo ($context["POSTS_DAY"] ?? null);
            echo " / ";
            echo ($context["POSTS_PCT"] ?? null);
            echo ")";
        } else {
            echo ($context["POSTS"] ?? null);
        }
        echo "</dd>
\t\t";
        // line 72
        if ((($context["ACTIVE_FORUM"] ?? null) != "")) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACTIVE_IN_FORUM");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd><strong><a href=\"";
            echo ($context["U_ACTIVE_FORUM"] ?? null);
            echo "\">";
            echo ($context["ACTIVE_FORUM"] ?? null);
            echo "</a></strong><br />(";
            echo ($context["ACTIVE_FORUM_POSTS"] ?? null);
            echo " / ";
            echo ($context["ACTIVE_FORUM_PCT"] ?? null);
            echo ")</dd>";
        }
        // line 73
        echo "\t\t";
        if ((($context["ACTIVE_TOPIC"] ?? null) != "")) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACTIVE_IN_TOPIC");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd><strong><a href=\"";
            echo ($context["U_ACTIVE_TOPIC"] ?? null);
            echo "\">";
            echo ($context["ACTIVE_TOPIC"] ?? null);
            echo "</a></strong><br />(";
            echo ($context["ACTIVE_TOPIC_POSTS"] ?? null);
            echo " / ";
            echo ($context["ACTIVE_TOPIC_PCT"] ?? null);
            echo ")</dd>";
        }
        // line 74
        echo "\t\t";
        if (($context["WARNINGS"] ?? null)) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("YOUR_WARNINGS");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd class=\"error\"><i class=\"icon fa-exclamation-triangle fa-fw icon-red\" aria-hidden=\"true\"></i> [";
            echo ($context["WARNINGS"] ?? null);
            echo "]</dd>";
        }
        // line 75
        echo "\t\t";
        // line 76
        echo "\t</dl>
";
        // line 77
        // line 78
        echo "
\t</div>
</div>

";
        // line 82
        $location = "ucp_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_footer.html", "ucp_main_front.html", 82)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "ucp_main_front.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  351 => 82,  345 => 78,  344 => 77,  341 => 76,  339 => 75,  329 => 74,  313 => 73,  298 => 72,  275 => 71,  268 => 70,  260 => 69,  259 => 68,  256 => 67,  255 => 66,  250 => 64,  247 => 63,  243 => 61,  231 => 55,  226 => 53,  220 => 52,  212 => 51,  193 => 46,  189 => 45,  178 => 42,  174 => 41,  171 => 40,  166 => 37,  160 => 36,  150 => 34,  148 => 33,  142 => 32,  135 => 31,  132 => 30,  128 => 29,  124 => 27,  122 => 26,  115 => 25,  109 => 22,  104 => 21,  102 => 20,  99 => 19,  93 => 18,  84 => 17,  80 => 16,  71 => 15,  67 => 14,  60 => 11,  58 => 10,  53 => 8,  45 => 3,  42 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "ucp_main_front.html", "");
    }
}
