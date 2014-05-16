<?php

/* mail/unsubscribe.html */
class __TwigTemplate_26ed45c9edc4dacbaf9021f77bcf66bd058827a6d85fd4bf3b33bdfeaaa99b02 extends Twig_Template
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
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("unsubscribe_header"), "html", null, true);
        echo "</h2>
                <div class=\"pure-g-r\">
                    <div class=\"l-box pure-u-1 pure-u-med-1-1 pure-u-lrg-1-1 is-center\">
                        <p>";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("unsubscribe_text"), "html", null, true);
        echo "</p>
                    </div>
                </div>
            </div>
        </div>
";
    }

    public function getTemplateName()
    {
        return "mail/unsubscribe.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 9,  35 => 6,  31 => 4,  28 => 3,);
    }
}
