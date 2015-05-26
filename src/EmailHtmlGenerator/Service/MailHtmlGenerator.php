<?php
namespace EmailHtmlGenerator\Service;

use \Zend\Mime\Part as MimePart;
use \Zend\Mime\Message as MimeMessage;

class MailHtmlGenerator extends \Zend\Mail\Message
{

    protected $emailTemplate = null;
    protected $viewRenderer = null;
    protected $transport = null;
    protected $htmlType = 'text/html';
    protected $charset = 'utf-8';
    protected $attachments = array();

    public function send()
    {
        if (!$this->getHtmlTemplate()) {
            throw new \Exception("No template");
        }
        if (!$this->getTransport()) {
            throw new \Exception("No transport");
        }

        $content  = new MimeMessage();
        
        $html = new MimePart($this->getHtmlTemplate());
        $html->type = $this->getHtmlType();
        $html->charset = $this->getCharset();
        
        $parts = array($html);
        foreach ($this->attachments as $attachment){
            $parts[] = $attachment;
        }
        
        $content->setParts($parts);
        
        $this->setBody($content);

        $result = $this->getTransport()->send($this);
        
        return $result;
    }
    
    public function addAttachment($file, $name)
    {
        $attachment = new MimePart(fopen($file, 'r'));
        $attachment->type = mime_content_type($file);
        $attachment->encoding    = \Zend\Mime\Mime::ENCODING_BASE64;
        $attachment->disposition =  \Zend\Mime\Mime::DISPOSITION_ATTACHMENT;
        
        $this->attachments[] = $attachment;
    }

    public function setHtmlTemplate($templateName, $params = array())
    {
        if (!$templateName){
        throw new \Exception("Not template passed");}

        $this->emailTemplate = $this->getViewRenderer()
                ->render($templateName, $params);
    }

    public function getHtmlTemplate()
    {
        return $this->emailTemplate;
    }

    public function setTransport(\Zend\Mail\Transport\TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    public function getTransport()
    {
        return $this->transport;
    }

    public function setHtmlType($type)
    {
        $this->htmlType = $type;
    }

    public function getHtmlType()
    {
        return $this->htmlType;
    }

    public function setCharset($encoding)
    {
        $this->charset = $encoding;
    }

    public function getCharset()
    {
        return $this->charset;
    }

    public function setFromEmail($email)
    {
        $this->emailFromEmail = $email;
    }

    public function getFromName()
    {
        return $this->emailFromName;
    }

    public function setViewRenderer($viewRender)
    {
        $this->viewRenderer = $viewRender;
    }

    public function getViewRenderer()
    {
        return $this->viewRenderer;
    }

}
