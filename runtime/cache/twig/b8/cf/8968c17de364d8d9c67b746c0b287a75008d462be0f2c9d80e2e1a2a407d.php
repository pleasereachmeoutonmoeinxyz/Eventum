<?php

/* event/template.html */
class __TwigTemplate_b8cf8968c17de364d8d9c67b746c0b287a75008d462be0f2c9d80e2e1a2a407d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
\t<meta content=\"text/html; charset=UTF-8\" http-equiv=\"Content-Type\" />
\t<title>*|MC:SUBJECT|*</title>
\t<style type=\"text/css\">/* /\\/\\/\\/\\/\\/\\/\\/\\/ CLIENT-SPECIFIC STYLES /\\/\\/\\/\\/\\/\\/\\/\\/ */
\t\t\t#outlook a{padding:0;} /* Force Outlook to provide a \"view in browser\" message */
\t\t\t.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
\t\t\t.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
\t\t\tbody, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
\t\t\ttable, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
\t\t\timg{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

\t\t\t/* /\\/\\/\\/\\/\\/\\/\\/\\/ RESET STYLES /\\/\\/\\/\\/\\/\\/\\/\\/ */
\t\t\tbody{margin:0; padding:0;}
\t\t\timg{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
\t\t\ttable{border-collapse:collapse !important;}
\t\t\tbody, #bodyTable, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;}

\t\t\t/* /\\/\\/\\/\\/\\/\\/\\/\\/ TEMPLATE STYLES /\\/\\/\\/\\/\\/\\/\\/\\/ */

\t\t\t/* ========== Page Styles ========== */

\t\t\t#bodyCell{padding:20px;}
\t\t\t#templateContainer{width:600px;}

\t\t\t/**
\t\t\t* @tab Page
\t\t\t* @section background style
\t\t\t* @tip Set the background color and top border for your email. You may want to choose colors that match your company's branding.
\t\t\t* @theme page
\t\t\t*/
\t\t\tbody, #bodyTable{
\t\t\t\t/*@editable*/ background-color:#DEE0E2;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Page
\t\t\t* @section background style
\t\t\t* @tip Set the background color and top border for your email. You may want to choose colors that match your company's branding.
\t\t\t* @theme page
\t\t\t*/
\t\t\t#bodyCell{
\t\t\t\t/*@editable*/ border-top:4px solid #BBBBBB;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Page
\t\t\t* @section email border
\t\t\t* @tip Set the border for your email.
\t\t\t*/
\t\t\t#templateContainer{
\t\t\t\t/*@editable*/ border:1px solid #BBBBBB;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Page
\t\t\t* @section heading 1
\t\t\t* @tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
\t\t\t* @style heading 1
\t\t\t*/
\t\t\th1{
\t\t\t\t/*@editable*/ color:#202020 !important;
\t\t\t\tdisplay:block;
\t\t\t\t/*@editable*/ font-family:Helvetica;
\t\t\t\t/*@editable*/ font-size:26px;
\t\t\t\t/*@editable*/ font-style:normal;
\t\t\t\t/*@editable*/ font-weight:bold;
\t\t\t\t/*@editable*/ line-height:100%;
\t\t\t\t/*@editable*/ letter-spacing:normal;
\t\t\t\tmargin-top:0;
\t\t\t\tmargin-right:0;
\t\t\t\tmargin-bottom:10px;
\t\t\t\tmargin-left:0;
\t\t\t\t/*@editable*/ text-align:left;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Page
\t\t\t* @section heading 2
\t\t\t* @tip Set the styling for all second-level headings in your emails.
\t\t\t* @style heading 2
\t\t\t*/
\t\t\th2{
\t\t\t\t/*@editable*/ color:#404040 !important;
\t\t\t\tdisplay:block;
\t\t\t\t/*@editable*/ font-family:Helvetica;
\t\t\t\t/*@editable*/ font-size:20px;
\t\t\t\t/*@editable*/ font-style:normal;
\t\t\t\t/*@editable*/ font-weight:bold;
\t\t\t\t/*@editable*/ line-height:100%;
\t\t\t\t/*@editable*/ letter-spacing:normal;
\t\t\t\tmargin-top:0;
\t\t\t\tmargin-right:0;
\t\t\t\tmargin-bottom:10px;
\t\t\t\tmargin-left:0;
\t\t\t\t/*@editable*/ text-align:left;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Page
\t\t\t* @section heading 3
\t\t\t* @tip Set the styling for all third-level headings in your emails.
\t\t\t* @style heading 3
\t\t\t*/
\t\t\th3{
\t\t\t\t/*@editable*/ color:#606060 !important;
\t\t\t\tdisplay:block;
\t\t\t\t/*@editable*/ font-family:Helvetica;
\t\t\t\t/*@editable*/ font-size:16px;
\t\t\t\t/*@editable*/ font-style:italic;
\t\t\t\t/*@editable*/ font-weight:normal;
\t\t\t\t/*@editable*/ line-height:100%;
\t\t\t\t/*@editable*/ letter-spacing:normal;
\t\t\t\tmargin-top:0;
\t\t\t\tmargin-right:0;
\t\t\t\tmargin-bottom:10px;
\t\t\t\tmargin-left:0;
\t\t\t\t/*@editable*/ text-align:left;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Page
\t\t\t* @section heading 4
\t\t\t* @tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
\t\t\t* @style heading 4
\t\t\t*/
\t\t\th4{
\t\t\t\t/*@editable*/ color:#808080 !important;
\t\t\t\tdisplay:block;
\t\t\t\t/*@editable*/ font-family:Helvetica;
\t\t\t\t/*@editable*/ font-size:14px;
\t\t\t\t/*@editable*/ font-style:italic;
\t\t\t\t/*@editable*/ font-weight:normal;
\t\t\t\t/*@editable*/ line-height:100%;
\t\t\t\t/*@editable*/ letter-spacing:normal;
\t\t\t\tmargin-top:0;
\t\t\t\tmargin-right:0;
\t\t\t\tmargin-bottom:10px;
\t\t\t\tmargin-left:0;
\t\t\t\t/*@editable*/ text-align:left;
\t\t\t}

\t\t\t/* ========== Header Styles ========== */

\t\t\t/**
\t\t\t* @tab Header
\t\t\t* @section preheader style
\t\t\t* @tip Set the background color and bottom border for your email's preheader area.
\t\t\t* @theme header
\t\t\t*/
\t\t\t#templatePreheader{
\t\t\t\t/*@editable*/ background-color:#F4F4F4;
\t\t\t\t/*@editable*/ border-bottom:1px solid #CCCCCC;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Header
\t\t\t* @section preheader text
\t\t\t* @tip Set the styling for your email's preheader text. Choose a size and color that is easy to read.
\t\t\t*/
\t\t\t.preheaderContent{
\t\t\t\t/*@editable*/ color:#808080;
\t\t\t\t/*@editable*/ font-family:Helvetica;
\t\t\t\t/*@editable*/ font-size:10px;
\t\t\t\t/*@editable*/ line-height:125%;
\t\t\t\t/*@editable*/ text-align:left;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Header
\t\t\t* @section preheader link
\t\t\t* @tip Set the styling for your email's preheader links. Choose a color that helps them stand out from your text.
\t\t\t*/
\t\t\t.preheaderContent a:link, .preheaderContent a:visited, /* Yahoo! Mail Override */ .preheaderContent a .yshortcuts /* Yahoo! Mail Override */{
\t\t\t\t/*@editable*/ color:#606060;
\t\t\t\t/*@editable*/ font-weight:normal;
\t\t\t\t/*@editable*/ text-decoration:underline;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Header
\t\t\t* @section header style
\t\t\t* @tip Set the background color and borders for your email's header area.
\t\t\t* @theme header
\t\t\t*/
\t\t\t#templateHeader{
\t\t\t\t/*@editable*/ background-color:#F4F4F4;
\t\t\t\t/*@editable*/ border-top:1px solid #FFFFFF;
\t\t\t\t/*@editable*/ border-bottom:1px solid #CCCCCC;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Header
\t\t\t* @section header text
\t\t\t* @tip Set the styling for your email's header text. Choose a size and color that is easy to read.
\t\t\t*/
\t\t\t.headerContent{
\t\t\t\t/*@editable*/ color:#505050;
\t\t\t\t/*@editable*/ font-family:Helvetica;
\t\t\t\t/*@editable*/ font-size:20px;
\t\t\t\t/*@editable*/ font-weight:bold;
\t\t\t\t/*@editable*/ line-height:100%;
\t\t\t\t/*@editable*/ padding-top:0;
\t\t\t\t/*@editable*/ padding-right:0;
\t\t\t\t/*@editable*/ padding-bottom:0;
\t\t\t\t/*@editable*/ padding-left:0;
\t\t\t\t/*@editable*/ text-align:left;
\t\t\t\t/*@editable*/ vertical-align:middle;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Header
\t\t\t* @section header link
\t\t\t* @tip Set the styling for your email's header links. Choose a color that helps them stand out from your text.
\t\t\t*/
\t\t\t.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
\t\t\t\t/*@editable*/ color:#EB4102;
\t\t\t\t/*@editable*/ font-weight:normal;
\t\t\t\t/*@editable*/ text-decoration:underline;
\t\t\t}

\t\t\t#headerImage{
\t\t\t\theight:auto;
\t\t\t\tmax-width:600px;
\t\t\t}

\t\t\t/* ========== Body Styles ========== */

\t\t\t/**
\t\t\t* @tab Body
\t\t\t* @section body style
\t\t\t* @tip Set the background color and borders for your email's body area.
\t\t\t*/
\t\t\t#templateBody{
\t\t\t\t/*@editable*/ background-color:#F4F4F4;
\t\t\t\t/*@editable*/ border-top:1px solid #FFFFFF;
\t\t\t\t/*@editable*/ border-bottom:1px solid #CCCCCC;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Body
\t\t\t* @section body text
\t\t\t* @tip Set the styling for your email's main content text. Choose a size and color that is easy to read.
\t\t\t* @theme main
\t\t\t*/
\t\t\t.bodyContent{
\t\t\t\t/*@editable*/ color:#505050;
\t\t\t\t/*@editable*/ font-family:Helvetica;
\t\t\t\t/*@editable*/ font-size:14px;
\t\t\t\t/*@editable*/ line-height:150%;
\t\t\t\tpadding-top:20px;
\t\t\t\tpadding-right:20px;
\t\t\t\tpadding-bottom:20px;
\t\t\t\tpadding-left:20px;
\t\t\t\t/*@editable*/ text-align:left;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Body
\t\t\t* @section body link
\t\t\t* @tip Set the styling for your email's main content links. Choose a color that helps them stand out from your text.
\t\t\t*/
\t\t\t.bodyContent a:link, .bodyContent a:visited, /* Yahoo! Mail Override */ .bodyContent a .yshortcuts /* Yahoo! Mail Override */{
\t\t\t\t/*@editable*/ color:#EB4102;
\t\t\t\t/*@editable*/ font-weight:normal;
\t\t\t\t/*@editable*/ text-decoration:underline;
\t\t\t}

\t\t\t.bodyContent img{
\t\t\t\tdisplay:inline;
\t\t\t\theight:auto;
\t\t\t\tmax-width:560px;
\t\t\t}

\t\t\t/* ========== Footer Styles ========== */

\t\t\t/**
\t\t\t* @tab Footer
\t\t\t* @section footer style
\t\t\t* @tip Set the background color and borders for your email's footer area.
\t\t\t* @theme footer
\t\t\t*/
\t\t\t#templateFooter{
\t\t\t\t/*@editable*/ background-color:#F4F4F4;
\t\t\t\t/*@editable*/ border-top:1px solid #FFFFFF;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Footer
\t\t\t* @section footer text
\t\t\t* @tip Set the styling for your email's footer text. Choose a size and color that is easy to read.
\t\t\t* @theme footer
\t\t\t*/
\t\t\t.footerContent{
\t\t\t\t/*@editable*/ color:#808080;
\t\t\t\t/*@editable*/ font-family:Helvetica;
\t\t\t\t/*@editable*/ font-size:10px;
\t\t\t\t/*@editable*/ line-height:150%;
\t\t\t\tpadding-top:20px;
\t\t\t\tpadding-right:20px;
\t\t\t\tpadding-bottom:20px;
\t\t\t\tpadding-left:20px;
\t\t\t\t/*@editable*/ text-align:left;
\t\t\t}

\t\t\t/**
\t\t\t* @tab Footer
\t\t\t* @section footer link
\t\t\t* @tip Set the styling for your email's footer links. Choose a color that helps them stand out from your text.
\t\t\t*/
\t\t\t.footerContent a:link, .footerContent a:visited, /* Yahoo! Mail Override */ .footerContent a .yshortcuts, .footerContent a span /* Yahoo! Mail Override */{
\t\t\t\t/*@editable*/ color:#606060;
\t\t\t\t/*@editable*/ font-weight:normal;
\t\t\t\t/*@editable*/ text-decoration:underline;
\t\t\t}

\t\t\t/* /\\/\\/\\/\\/\\/\\/\\/\\/ MOBILE STYLES /\\/\\/\\/\\/\\/\\/\\/\\/ */

            @media only screen and (max-width: 480px){
\t\t\t\t/* /\\/\\/\\/\\/\\/\\/ CLIENT-SPECIFIC MOBILE STYLES /\\/\\/\\/\\/\\/\\/ */
\t\t\t\tbody, table, td, p, a, li, blockquote{-webkit-text-size-adjust:none !important;} /* Prevent Webkit platforms from changing default text sizes */
                body{width:100% !important; min-width:100% !important;} /* Prevent iOS Mail from adding padding to the body */

\t\t\t\t/* /\\/\\/\\/\\/\\/\\/ MOBILE RESET STYLES /\\/\\/\\/\\/\\/\\/ */
\t\t\t\t#bodyCell{padding:10px !important;}

\t\t\t\t/* /\\/\\/\\/\\/\\/\\/ MOBILE TEMPLATE STYLES /\\/\\/\\/\\/\\/\\/ */

\t\t\t\t/* ======== Page Styles ======== */

\t\t\t\t/**
\t\t\t\t* @tab Mobile Styles
\t\t\t\t* @section template width
\t\t\t\t* @tip Make the template fluid for portrait or landscape view adaptability. If a fluid layout doesn't work for you, set the width to 300px instead.
\t\t\t\t*/
\t\t\t\t#templateContainer{
\t\t\t\t\tmax-width:600px !important;
\t\t\t\t\t/*@editable*/ width:100% !important;
\t\t\t\t}

\t\t\t\t/**
\t\t\t\t* @tab Mobile Styles
\t\t\t\t* @section heading 1
\t\t\t\t* @tip Make the first-level headings larger in size for better readability on small screens.
\t\t\t\t*/
\t\t\t\th1{
\t\t\t\t\t/*@editable*/ font-size:24px !important;
\t\t\t\t\t/*@editable*/ line-height:100% !important;
\t\t\t\t}

\t\t\t\t/**
\t\t\t\t* @tab Mobile Styles
\t\t\t\t* @section heading 2
\t\t\t\t* @tip Make the second-level headings larger in size for better readability on small screens.
\t\t\t\t*/
\t\t\t\th2{
\t\t\t\t\t/*@editable*/ font-size:20px !important;
\t\t\t\t\t/*@editable*/ line-height:100% !important;
\t\t\t\t}

\t\t\t\t/**
\t\t\t\t* @tab Mobile Styles
\t\t\t\t* @section heading 3
\t\t\t\t* @tip Make the third-level headings larger in size for better readability on small screens.
\t\t\t\t*/
\t\t\t\th3{
\t\t\t\t\t/*@editable*/ font-size:18px !important;
\t\t\t\t\t/*@editable*/ line-height:100% !important;
\t\t\t\t}

\t\t\t\t/**
\t\t\t\t* @tab Mobile Styles
\t\t\t\t* @section heading 4
\t\t\t\t* @tip Make the fourth-level headings larger in size for better readability on small screens.
\t\t\t\t*/
\t\t\t\th4{
\t\t\t\t\t/*@editable*/ font-size:16px !important;
\t\t\t\t\t/*@editable*/ line-height:100% !important;
\t\t\t\t}

\t\t\t\t/* ======== Header Styles ======== */

\t\t\t\t#templatePreheader{display:none !important;} /* Hide the template preheader to save space */

\t\t\t\t/**
\t\t\t\t* @tab Mobile Styles
\t\t\t\t* @section header image
\t\t\t\t* @tip Make the main header image fluid for portrait or landscape view adaptability, and set the image's original width as the max-width. If a fluid setting doesn't work, set the image width to half its original size instead.
\t\t\t\t*/
\t\t\t\t#headerImage{
\t\t\t\t\theight:auto !important;
\t\t\t\t\t/*@editable*/ max-width:600px !important;
\t\t\t\t\t/*@editable*/ width:100% !important;
\t\t\t\t}

\t\t\t\t/**
\t\t\t\t* @tab Mobile Styles
\t\t\t\t* @section header text
\t\t\t\t* @tip Make the header content text larger in size for better readability on small screens. We recommend a font size of at least 16px.
\t\t\t\t*/
\t\t\t\t.headerContent{
\t\t\t\t\t/*@editable*/ font-size:20px !important;
\t\t\t\t\t/*@editable*/ line-height:125% !important;
\t\t\t\t}

\t\t\t\t/* ======== Body Styles ======== */

\t\t\t\t/**
\t\t\t\t* @tab Mobile Styles
\t\t\t\t* @section body text
\t\t\t\t* @tip Make the body content text larger in size for better readability on small screens. We recommend a font size of at least 16px.
\t\t\t\t*/
\t\t\t\t.bodyContent{
\t\t\t\t\t/*@editable*/ font-size:18px !important;
\t\t\t\t\t/*@editable*/ line-height:125% !important;
\t\t\t\t}

\t\t\t\t/* ======== Footer Styles ======== */

\t\t\t\t/**
\t\t\t\t* @tab Mobile Styles
\t\t\t\t* @section footer text
\t\t\t\t* @tip Make the body content text larger in size for better readability on small screens.
\t\t\t\t*/
\t\t\t\t.footerContent{
\t\t\t\t\t/*@editable*/ font-size:14px !important;
\t\t\t\t\t/*@editable*/ line-height:115% !important;
\t\t\t\t}

\t\t\t\t.footerContent a{display:block !important;} /* Place footer social and utility links on their own lines, for easier access */
\t\t\t}
\t</style>
</head>
<body leftmargin=\"0\" marginheight=\"0\" marginwidth=\"0\" offset=\"0\" topmargin=\"0\">
<center>
<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" id=\"bodyTable\" width=\"100%\">
\t<tbody>
\t\t<tr>
\t\t\t<td align=\"center\" id=\"bodyCell\" valign=\"top\"><!-- BEGIN TEMPLATE // -->
\t\t\t<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"templateContainer\">
\t\t\t\t<tbody>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td align=\"center\" valign=\"top\"><!-- BEGIN PREHEADER // -->
\t\t\t\t\t\t<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"templatePreheader\" width=\"100%\">
\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t<td class=\"preheaderContent\" mc:edit=\"preheader_content00\" style=\"padding-top:10px; padding-right:20px; padding-bottom:10px; padding-left:20px;\" valign=\"top\"><a href=\"http://eventum.ir\">www.eventum.ir</a></td>
\t\t\t\t\t\t\t\t\t<!-- *|IFNOT:ARCHIVE_PAGE|* -->
\t\t\t\t\t\t\t\t\t<td class=\"preheaderContent\" mc:edit=\"preheader_content01\" style=\"padding-top:10px; padding-right:20px; padding-bottom:10px; padding-left:0;\" valign=\"top\" width=\"180\">&nbsp;</td>
\t\t\t\t\t\t\t\t\t<!-- *|END:IF|* -->
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t</table>
\t\t\t\t\t\t<!-- // END PREHEADER --></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td align=\"center\" valign=\"top\"><!-- BEGIN HEADER // -->
\t\t\t\t\t\t<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"templateHeader\" width=\"100%\">
\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t<td class=\"headerContent\" valign=\"top\"><img id=\"headerImage\" mc:allowdesigner=\"\" mc:allowtext=\"\" mc:edit=\"header_image\" mc:label=\"header_image\" src=\"http://gallery.mailchimp.com/2425ea8ad3/images/header_placeholder_600px.png\" style=\"max-width:600px;\" /></td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t</table>
\t\t\t\t\t\t<!-- // END HEADER --></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td align=\"center\" valign=\"top\"><!-- BEGIN BODY // -->
\t\t\t\t\t\t<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"templateBody\" width=\"100%\">
\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t<td class=\"bodyContent\" mc:edit=\"body_content\" valign=\"top\">
\t\t\t\t\t\t\t\t\t<h1>Designing Your Template</h1>

\t\t\t\t\t\t\t\t\t<h3>Creating a good-looking email is simple</h3>
\t\t\t\t\t\t\t\t\tCustomize your template by clicking on the style editor tabs above. Set your fonts, colors, and styles. After setting your styling is all done you can click here in this area, delete the text, and start adding your own awesome content.<br />
\t\t\t\t\t\t\t\t\t&nbsp;
\t\t\t\t\t\t\t\t\t<h2>Styling Your Content</h2>

\t\t\t\t\t\t\t\t\t<h4>Make your email easy to read</h4>
\t\t\t\t\t\t\t\t\tAfter you enter your content, highlight the text you want to style and select the options you set in the style editor in the &quot;<em>styles</em>&quot; drop down box. Want to <a href=\"http://www.mailchimp.com/kb/article/im-using-the-style-designer-and-i-cant-get-my-formatting-to-change\" target=\"_blank\">get rid of styling on a bit of text</a>, but having trouble doing it? Just use the &quot;<em>remove formatting</em>&quot; button to strip the text of any formatting and reset your style.</td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t</table>
\t\t\t\t\t\t<!-- // END BODY --></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td align=\"center\" valign=\"top\"><!-- BEGIN FOOTER // -->
\t\t\t\t\t\t<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"templateFooter\" width=\"100%\">
\t\t\t\t\t\t\t<tbody>
\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t<td class=\"footerContent\" mc:edit=\"footer_content00\" valign=\"top\">&nbsp;</td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t\t\t<td class=\"footerContent\" mc:edit=\"footer_content02\" style=\"padding-top:0; padding-bottom:40px;\" valign=\"top\">sent from <a href=\"http://eventum.ir\">www.eventum.ir</a>, free and open source project by <a href=\"http://moeinhm.name\">MoeinHm</a></td>
\t\t\t\t\t\t\t\t</tr>
\t\t\t\t\t\t\t</tbody>
\t\t\t\t\t\t</table>
\t\t\t\t\t\t<!-- // END FOOTER --></td>
\t\t\t\t\t</tr>
\t\t\t\t</tbody>
\t\t\t</table>
\t\t\t<!-- // END TEMPLATE --></td>
\t\t</tr>
\t</tbody>
</table>
</center>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "event/template.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
