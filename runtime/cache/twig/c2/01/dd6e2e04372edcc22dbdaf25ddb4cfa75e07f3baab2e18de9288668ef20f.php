<?php

/* mailer/setting.html */
class __TwigTemplate_c201dd6e2e04372edcc22dbdaf25ddb4cfa75e07f3baab2e18de9288668ef20f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("mailer/mail_layout.html");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "mailer/mail_layout.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("mailer.say_hello"), "html", null, true);
        echo "
    ";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("mailer.say_thanks"), "html", null, true);
        echo "
    ";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("mailer.say_please_share"), "html", null, true);
        echo "
    ";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("mailer.introduce_setting_url"), "html", null, true);
        echo "
    <a href='";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["setting_url"]) ? $context["setting_url"] : $this->getContext($context, "setting_url")), "html", null, true);
        echo "'>";
        echo twig_escape_filter($this->env, (isset($context["setting_url"]) ? $context["setting_url"] : $this->getContext($context, "setting_url")), "html", null, true);
        echo "</a>
    ";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("mailer.introduce_unsubscribe_url"), "html", null, true);
        echo "
    <a href='";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["unsubscribe_url"]) ? $context["unsubscribe_url"] : $this->getContext($context, "unsubscribe_url")), "html", null, true);
        echo "'>";
        echo twig_escape_filter($this->env, (isset($context["unsubscribe_url"]) ? $context["unsubscribe_url"] : $this->getContext($context, "unsubscribe_url")), "html", null, true);
        echo "</a>
    ";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("mailer.need_help"), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "mailer/setting.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 11,  58 => 10,  54 => 9,  48 => 8,  44 => 7,  40 => 6,  36 => 5,  31 => 4,  28 => 3,);
    }
}
