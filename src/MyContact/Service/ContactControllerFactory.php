<?php

namespace MyContact\Service;

use MyContact\Controller;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $serviceLocator = $services->getServiceLocator();
        $form           = $serviceLocator->get('MyContactForm');
        $message        = $serviceLocator->get('MyContactMailMessage');
        $transport      = $serviceLocator->get('MyContactMailTransport');

        $config  = $serviceLocator->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }

        $controller = new Controller\ContactController();

        if (isset($config['MyContact']['ajax'])) {
            $controller->setAjax($config['MyContact']['ajax']);
        }

        $controller->setContactForm($form);
        $controller->setMessage($message);
        $controller->setMailTransport($transport);

        return $controller;
    }
}
