<?php
return array(
   'service_manager' => array(
        //Mail factory
        'factories' => array(
            'MailHtmlGenerator' => function ($sm) {
                $mail = new \EmailHtmlGenerator\Service\MailHtmlGenerator();
                //Google email example
                $options = new \Zend\Mail\Transport\SmtpOptions(array(
                    'name' => 'localhost',
                    'host' => 'smtp.gmail.com',
                    'port' => 587,
                    'connection_class' => 'login',
                    'connection_config' => array(
                        'username' => 'username@gmail.com',
                        'password' => 'password',
                        'ssl' => 'tls'
                    ),
                ));
                $transport = new \Zend\Mail\Transport\Smtp($options);
                $mail->setTransport($transport);
                $mail->setViewRenderer($sm->get('ViewRenderer'));
                return $mail;
            },
        ),
    ),
);