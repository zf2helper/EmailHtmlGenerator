<?php
namespace SmartexeHtmlgenerator\Service;

class MailHtmlGenerator
{
    private $viewRender = null;
    private $htmlType = 'text/html';
    private $charset = 'utf-8';

    public function generateHtml($template, $params = array())
    {
        $view = $this->getViewRenderer()->render($template, $params);        
        
        $html = new \Zend\Mime\Part($view);
        $html->type = $this->htmlType;
        $html->charset = $this->charset;
        $body = new \Zend\Mime\Message();
        $body->setParts(array($html));
        
        return $body;
    }
    
    public function setViewRenderer($viewRenderer)
    {
        $this->viewRender = $viewRenderer;
    }
    public function getViewRenderer()
    {
        return $this->viewRender;
    }
}