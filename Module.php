<?php
/**
 * @author Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

namespace MyContact;

use MyContact\View\Helper\MyContactForm;
use Zend\ModuleManager\Feature;
use Zend\View\HelperPluginManager;

class Module implements
    Feature\AutoloaderProviderInterface,
    Feature\ConfigProviderInterface,
    Feature\ControllerProviderInterface,
    Feature\ServiceProviderInterface,
    Feature\ViewHelperProviderInterface
{
    public function getAutoloaderConfig()
    {
        return include __DIR__ . '/config/autoloader.config.php';
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getControllerConfig()
    {
        return include __DIR__ . '/config/controller.config.php';
    }

    public function getServiceConfig()
    {
        return include __DIR__ . '/config/service.config.php';
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'MyContactForm' => function(HelperPluginManager $pm) {
                    $form = $pm->getServiceLocator()->get('MyContactForm');
                    return new MyContactForm($form);
                }
            ),
        );
    }
}
