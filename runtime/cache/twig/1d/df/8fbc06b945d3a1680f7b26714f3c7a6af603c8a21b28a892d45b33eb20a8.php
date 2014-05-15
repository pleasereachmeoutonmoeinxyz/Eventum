<?php

/* mail/setting.html */
class __TwigTemplate_1ddf8fbc06b945d3a1680f7b26714f3c7a6af603c8a21b28a892d45b33eb20a8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.html");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"content-wrapper-internal\">
            <div class=\"content\">
                <h2 class=\"content-head is-center\">";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("setting_header"), "html", null, true);
        echo "</h2>
                    ";
        // line 7
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
                    ";
        // line 8
        if (((isset($context["save"]) ? $context["save"] : $this->getContext($context, "save")) == true)) {
            // line 9
            echo "                        <h4 class=\"is-center\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("setting_saved"), "html", null, true);
            echo "</h4>
                    ";
        }
        // line 11
        echo "                    <h4 class=\"is-center\">";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "</h4>
                    <div class=\"pure-g-r\">
                        <div class=\"l-box pure-u-1 pure-u-med-1-2 pure-u-lrg-1-3\">
                            <h3 class=\"content-subhead\">
                                <i class=\"fa fa-th-large\">";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("type"), "html", null, true);
        echo "</i>
                            </h3>
                                ";
        // line 17
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "types"));
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            // line 18
            echo "                                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), 'row', array("attr" => array("class" => "rtl_input")));
            echo "
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "                        </div>
                        <div class=\"l-box pure-u-1 pure-u-med-1-2 pure-u-lrg-1-3\">
                            <h3 class=\"content-subhead\">
                                <i class=\"fa fa-th-large\">";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("category"), "html", null, true);
        echo "</i>
                            </h3>
                                ";
        // line 25
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "categories"));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 26
            echo "                                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["category"]) ? $context["category"] : $this->getContext($context, "category")), 'row', array("attr" => array("class" => "rtl_input")));
            echo "
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "                        </div>
                        <div class=\"l-box pure-u-1 pure-u-med-1-2 pure-u-lrg-1-3\">
                            <h3 class=\"content-subhead\">
                                <i class=\"fa fa-th-large\">";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("location"), "html", null, true);
        echo "</i>
                            </h3>
                                ";
        // line 33
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "locations"));
        foreach ($context['_seq'] as $context["_key"] => $context["location"]) {
            // line 34
            echo "                                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["location"]) ? $context["location"] : $this->getContext($context, "location")), 'row', array("attr" => array("class" => "rtl_input")));
            echo "
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['location'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "                        </div>              
                    </div>
                    <div class=\"pure-g-r\">
                        <div class=\"pure-u-1 is-center\">
                            <button type=\"submit\" class=\"pure-button pure-input-1-2\">";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("save_setting"), "html", null, true);
        echo "</button>
                        </div>
                    </div>
                    ";
        // line 43
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
            </div>            
            
        </div>
";
    }

    public function getTemplateName()
    {
        return "mail/setting.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 43,  129 => 40,  123 => 36,  114 => 34,  110 => 33,  105 => 31,  100 => 28,  91 => 26,  87 => 25,  82 => 23,  77 => 20,  68 => 18,  64 => 17,  59 => 15,  51 => 11,  45 => 9,  43 => 8,  39 => 7,  35 => 6,  31 => 4,  28 => 3,);
    }
}
