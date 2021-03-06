<?php

namespace MyContact\Service;

use Traversable;
use Zend\Mail\Message;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;

class ContactMailMessageFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $globalConfig  = $services->get('config');
        if ($globalConfig instanceof Traversable) {
            $globalConfig = ArrayUtils::iteratorToArray($globalConfig);
        }
        $config  = $globalConfig['MyContact']['message'];

        $message = new Message();

        if (isset($config['subject_prefix'])) {
            $message->setSubject($config['subject_prefix']);
        }

        if (isset($config['to'])) {
            $message->addTo($config['to']);
        }

        if (isset($config['from'])) {
            $message->addFrom($config['from']);
        }

        if (isset($config['sender']) && isset($config['sender']['address'])) {
            $address = $config['sender']['address'];
            $name    = isset($config['sender']['name']) ? $config['sender']['name'] : null;
            $message->setSender($address, $name);
        }

        return $message;
    }
}
