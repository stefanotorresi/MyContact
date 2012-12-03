<?php

namespace MyContact\Service;

use Traversable;
use MyContact\Form\ContactFilter;
use MyContact\Form\ContactForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;
use Zend\Validator\AbstractValidator as Validator;

class ContactFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        $name    = $config['MyContact']['form']['name'];

        Validator::setDefaultTranslator($services->get('translator'));
        Validator::setDefaultTranslatorTextDomain('zend_validate');

        $captcha = $services->get('MyContactCaptcha');

        $filter  = new ContactFilter();
        $form    = new ContactForm($name, $captcha);
        $form->setInputFilter($filter);

        return $form;
    }
}
