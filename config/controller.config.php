<?php

namespace MyContact;

return array(    
    'factories' => array(
        'MyContact\Controller\Contact' => 'MyContact\Service\ContactControllerFactory',
    ),
);