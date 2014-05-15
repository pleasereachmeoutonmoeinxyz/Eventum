<?php

/* event/content.html */
class __TwigTemplate_05ad061f9b10ee5bc8328a263cef28854db8e284aac7636d2333f45141b1a09f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.html");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
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
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("basic_header"), "html", null, true);
        echo "</h2>
                ";
        // line 7
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
                ";
        // line 8
        if (((isset($context["save"]) ? $context["save"] : $this->getContext($context, "save")) == true)) {
            // line 9
            echo "                    <h4 class=\"is-center\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("content_saved"), "html", null, true);
            echo "</h4>
                ";
        }
        // line 11
        echo "                <h4 class=\"is-center\">";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "</h4>
                <div class=\"pure-g-r\">
                    <div class=\"l-box pure-u-1 pure-u-med-1 pure-u-lrg-1 is-center\">
                        <fieldset class=\"pure-form pure-form-aligned\">
                            ";
        // line 15
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "subject"), 'row', array("attr" => array("dir" => "rtl")));
        echo "
                            ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "content"), 'row');
        echo "                            
                        </fieldset>
                    </div>
                </div>
                <div class=\"pure-g-r\">
                    <div class=\"pure-u-1 is-center\">
                        <button type=\"submit\" class=\"pure-button pure-input-1-2\">";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("save_event_content"), "html", null, true);
        echo "</button>
                    </div>
                </div>
                ";
        // line 25
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
        </div>
    </div>
";
    }

    // line 30
    public function block_javascripts($context, array $blocks = array())
    {
        // line 31
        echo "    <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "basepath"), "html", null, true);
        echo "/assets/ckeditor/ckeditor.js\"></script>
    <script type=\"text/javascript\">
        \$(document).ready(function(){
            CKEDITOR.replace( 'form_content', {
                fullPage: true,
                allowedContent: true
            });            
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "event/content.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 31,  87 => 30,  79 => 25,  73 => 22,  64 => 16,  60 => 15,  52 => 11,  46 => 9,  44 => 8,  40 => 7,  36 => 6,  32 => 4,  29 => 3,);
    }
}
