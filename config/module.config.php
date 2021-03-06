<?php

namespace MyContact;

return array(
    __NAMESPACE__ => array(
        'captcha'   => array(
            'class'             => 'MyBase\Captcha\ImagickCaptcha',
            'font'              => __DIR__ .'/../assets/fonts/arial.ttf',
            'fontSize'          => 30,
            'imgDir'            => 'public/img/captcha/',
            'imgUrl'            => 'img/captcha/',
            'dotNoiseLevel'     => 60,
            'lineNoiseLevel'    => 4,
            'width'             => 130,
            'height'            => 40,
            'wordlen'           => 6,
        ),
        'form' => array(
            'name' => 'contact-form',
        ),
        'mail_transport' => array(
            'class' => 'Zend\Mail\Transport\Sendmail',
            'options' => array(
            )
        ),
        'message' => array(
//            'subject_prefix' => '',
//            'to' => array(
//                'EMAIL HERE' => 'NAME HERE',
//            ),
//            'sender' => array(
//                'address' => 'EMAIL HERE',
//                'name'    => 'NAME HERE',
//            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'contact' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/contact',
                    'defaults' => array(
                        'controller' => 'MyContact\Controller\Contact',
                    ),
                ),
                'may_terminate' => false,
                'child_routes' => array(
                    'index' => array(
                        'type' => 'Method',
                        'options' => array(
                            'verb' => 'get',
                            'defaults' => array(
                                'action' => 'index',
                            ),
                        ),
                    ),
                    'process' => array(
                        'type' => 'Method',
                        'options' => array(
                            'verb' => 'post',
                            'defaults' => array(
                                'action' => 'process',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type'          => 'gettext',
                'base_dir'      => __DIR__ . '/../language',
                'pattern'       => '%s.mo',
                'text_domain'   => __NAMESPACE__
            ),
        ),
    ),

    'asset_manager' => array(
        'resolver_configs' => array(
            'map' => array(
                'my-contact/img/icon-reload.png' => __DIR__ . '/../assets/img/icon-reload.png',
                'my-contact/js/my-contact.js' => __DIR__ . '/../assets/js/my-contact.js',
            ),
        ),
    ),
);
