<?php

namespace MyContact;

return array(
    'factories' => array(
        'translator'                => 'Zend\Mvc\Service\TranslatorServiceFactory',
        'MyContactCaptcha'          => 'MyContact\Service\ContactCaptchaFactory',
        'MyContactForm'             => 'MyContact\Service\ContactFormFactory',
        'MyContactMailMessage'      => 'MyContact\Service\ContactMailMessageFactory',
        'MyContactMailTransport'    => 'MyContact\Service\ContactMailTransportFactory',
    ),
);
