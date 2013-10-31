<?php
return array(
    'service_manager' => array(
        //Mail factory
        'factories' => array(
            'MailHtmlGenerator' => function ($sm) {
                $html = new \Htmlgenerator\Service\MailHtmlGenerator();
                $html->setViewRenderer($sm->get('ViewRenderer'));
                
                return $html;
            },
        ),
    ),      
);