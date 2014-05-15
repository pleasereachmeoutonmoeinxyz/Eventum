<?php

/* event/basic.html */
class __TwigTemplate_8e11c5d951a5aa39c4990ef59d242a89c2b6c94fd4c7d1e4780772ebd8277b67 extends Twig_Template
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
        echo "        <div class=\"content-wrapper-internal\">
            <div class=\"content\">
                <h2 class=\"content-head is-center\">";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("basic_header"), "html", null, true);
        echo "</h2>
                    ";
        // line 7
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
                    <h4 class=\"is-center\">";
        // line 8
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "</h4>
                    <div class=\"pure-g-r\">
                        <div class=\"l-box pure-u-1 pure-u-med-1 pure-u-lrg-1 is-center\">
                                <fieldset class=\"pure-form pure-form-aligned\">

                            ";
        // line 13
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name"), 'row', array("attr" => array("dir" => "rtl")));
        echo "
                            ";
        // line 14
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "site"), 'row', array("attr" => array("dir" => "ltr")));
        echo "
                            ";
        // line 15
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email"), 'row', array("attr" => array("dir" => "ltr")));
        echo "
                            ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "tel"), 'row', array("attr" => array("dir" => "ltr")));
        echo "
                                </fieldset>
                        </div>
                    </div>
                    <div class=\"pure-g-r\">
                        <div class=\"l-box pure-u-1 pure-u-med-1-2 pure-u-lrg-1-3\">
                            <h3 class=\"content-subhead\">
                                <i class=\"fa fa-th-large\">";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("type"), "html", null, true);
        echo "</i>
                            </h3>
                                ";
        // line 25
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "types"));
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            // line 26
            echo "                                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), 'row', array("attr" => array("class" => "rtl_input")));
            echo "
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "                        </div>
                        <div class=\"l-box pure-u-1 pure-u-med-1-2 pure-u-lrg-1-3\">
                            <h3 class=\"content-subhead\">
                                <i class=\"fa fa-th-large\">";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("category"), "html", null, true);
        echo "</i>
                            </h3>
                                ";
        // line 33
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "categories"));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 34
            echo "                                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["category"]) ? $context["category"] : $this->getContext($context, "category")), 'row', array("attr" => array("class" => "rtl_input")));
            echo "
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "                        </div>
                        <div class=\"l-box pure-u-1 pure-u-med-1-2 pure-u-lrg-1-3\">
                            <h3 class=\"content-subhead\">
                                <i class=\"fa fa-th-large\">";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("location"), "html", null, true);
        echo "</i>
                            </h3>
                                ";
        // line 41
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "locations"));
        foreach ($context['_seq'] as $context["_key"] => $context["location"]) {
            // line 42
            echo "                                    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["location"]) ? $context["location"] : $this->getContext($context, "location")), 'row', array("attr" => array("class" => "rtl_input")));
            echo "
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['location'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "                        </div>              
                    </div>
                    <div class=\"pure-g-r\">
                        <div class=\"pure-u-1 is-center\">
                            <button type=\"submit\" class=\"pure-button pure-input-1-2\">";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("save_basic_event"), "html", null, true);
        echo "</button>
                        </div>
                    </div>
                    ";
        // line 51
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
            </div>            
            
        </div>
";
    }

    public function getTemplateName()
    {
        return "event/basic.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 51,  143 => 48,  137 => 44,  128 => 42,  124 => 41,  119 => 39,  114 => 36,  105 => 34,  101 => 33,  96 => 31,  91 => 28,  82 => 26,  78 => 25,  73 => 23,  63 => 16,  59 => 15,  55 => 14,  51 => 13,  43 => 8,  39 => 7,  35 => 6,  31 => 4,  28 => 3,);
    }
}
