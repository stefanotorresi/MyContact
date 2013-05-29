<?php

namespace MyContact;

return array(
    'factories' => array(
        'MyContactCaptcha' => 'MyContact\Service\ContactCaptchaFactory',
        'MyContact\Form\ContactForm' => 'MyContact\Service\ContactFormFactory',
        'MyContactMailMessage' => 'MyContact\Service\ContactMailMessageFactory',
        'MyContactMailTransport' => 'MyContact\Service\ContactMailTransportFactory',
    ),
    'aliases' => array(
        'MyContactForm' => 'MyContact\Form\ContactForm',
    )
);
