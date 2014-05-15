<?php

/* mailer/mail_layout.html */
class __TwigTemplate_afe7dbad7b0bbc83e1a63c9725f53750b74670b3b662d4ad7fc4416a023770aa extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div style=\"margin:0;padding:0\">
    <center>
        <div style=\"margin:10px;width:90%;border:1px solid;direction:rtl;text-align:right\">
            <div style=\"padding:8px 10px;margin-bottom:5px;background:#44B4BE;color:#fff;font-size:larger;font-weight:bold\">
                ";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["header"]) ? $context["header"] : $this->getContext($context, "header")), "html", null, true);
        echo "
            </div>
            <div style=\"padding:10px\">
            <div>
                ";
        // line 9
        $this->displayBlock('content', $context, $blocks);
        // line 12
        echo "            </div>
            </div>
            <div style=\"padding:10px;color:#444;border-top:1px dashed;\">
                ";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("mailer.help"), "html", null, true);
        echo "
            </div>
        </div>
     </center>
 </div>";
    }

    // line 9
    public function block_content($context, array $blocks = array())
    {
        // line 10
        echo "
                ";
    }

    public function getTemplateName()
    {
        return "mailer/mail_layout.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 10,  49 => 9,  35 => 12,  33 => 9,  26 => 5,  20 => 1,  64 => 11,  58 => 10,  54 => 9,  48 => 8,  44 => 7,  40 => 15,  36 => 5,  31 => 4,  28 => 3,);
    }
}
