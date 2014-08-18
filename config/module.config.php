<?php
return array(
   'service_manager' => array(
        //Mail factory
        'factories' => array(
            'MailHtmlGenerator' => function ($sm) {
                $mail = new \EmailHtmlGenerator\Service\MailHtmlGenerator();
                $transport = new \Zend\Mail\Transport\Sendmail();
                
                $mail->setTransport($transport);
                $mail->setViewRenderer($sm->get('ViewRenderer'));
                return $mail;
            },
        ),
    ),
);