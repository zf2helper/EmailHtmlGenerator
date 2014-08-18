<?php
namespace EmailHtmlGenerator\Service;

class MailHtmlGenerator
{

    protected $emailTemplate = null;
    protected $viewRenderer = null;
    protected $transport = null;
    protected $htmlType = 'text/html';
    protected $charset = 'utf-8';

    public function send()
    {
        if (!$this->getHtmlTemplate()) {
            throw new \Exception("No template");
        }
        if (!$this->getTransport()) {
            throw new \Exception("No transport");
        }

        $html = new MimePart($this->getHtmlTemplate());
        $html->type = $this->getHtmlType();
        $html->charset = $this->getCharset();
        $body = new MimeMessage();
        $body->setParts(array($html));

        $this->setBody($body);

        $this->getTransport()->send($this);
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