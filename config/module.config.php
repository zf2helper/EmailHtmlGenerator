<?php
return array(
   'service_manager' => array(
        //Mail factory
        'factories' => array(
            'MailHtmlGenerator' => function ($sm) {
                $config = $sm->get('Config');
                $mail = new \EmailHtmlGenerator\Service\MailHtmlGenerator();
                $transport = new \Zend\Mail\Transport\Sendmail();
                
                $mail->setTransport($transport);
                $viewRenderer = new \Zend\View\Renderer\PhpRenderer();
                $resolver = new \Zend\View\Resolver\AggregateResolver();
                $viewRenderer->setResolver($resolver);
                $viewsMap = new \Zend\View\Resolver\TemplatePathStack();
                $viewsMap->addPaths($config['view_manager']['emails_path']);
                $resolver->attach($viewsMap);
                $mail->setViewRenderer($viewRenderer);
                return $mail;
            },
        ),
    ),
);
