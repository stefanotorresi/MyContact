<?php
/**
 *
 * @author Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

namespace MyContact;

return array(
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type' => 'phpArray',
                'base_dir'      => 'vendor/zendframework/zendframework/resources/languages',
                'pattern'       => '%s/Zend_Captcha.php',
                'text_domain'   => 'zend_captcha'
            ),
            array(
                'type' => 'phpArray',
                'base_dir'      => 'vendor/zendframework/zendframework/resources/languages',
                'pattern'       => '%s/Zend_Validate.php',
                'text_domain'   => 'zend_validate'
            )
        ),
    ),

    'asset_manager' => array(
        'filters' => array(
            'js/jquery.form.js' => array(
                array( 'filter' => 'UglifyJS2' ),
            ),
        ),
        'caching' => array(
            'js/jquery.form.js' => array(
                'cache' => 'FilePath',
                'options' => array(
                    'dir' => './data/cache',
                ),
            ),
        ),
    ),
);
