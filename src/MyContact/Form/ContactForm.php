<?php

namespace MyContact\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;

class ContactForm extends Form
{
    protected $captchaAdapter;
    protected $csrfToken;

    public function __construct($name = null, CaptchaAdapter $captchaAdapter = null)
    {
        parent::__construct($name);

        if (null !== $captchaAdapter) {
            $this->captchaAdapter = $captchaAdapter;
        }

        $name = $this->getName();
        if (null === $name) {
            $this->setName('contact');
        }

        $this->addElements();

        $this->setAttribute('method', \Zend\Http\Request::METHOD_POST);
    }

    public function addElements()
    {
        $this->add(array(
            'name'  => 'name',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Full Name',
            ),
            'attributes' => array(
                'id'            => $this->getName().'-name',
                'placeholder'   => 'Full Name',
                'class'         => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'id'            => $this->getName().'-email',
                'placeholder'   => 'Email',
                'class'         => 'text'
            ),
        ));

        $this->add(array(
            'name'  => 'subject',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Subject',
            ),
            'attributes' => array(
                'id'            => $this->getName().'-subject',
                'placeholder'   => 'Subject',
                'class'         => 'text'
            ),
        ));

        $this->add(array(
            'name'  => 'body',
            'type'  => 'Zend\Form\Element\Textarea',
            'options' => array(
                'label' => 'Your message',
            ),
            'attributes' => array(
                'id'            => $this->getName().'-body',
                'placeholder'   => 'Your message',
            ),
        ));

        $captcha = new Element\Captcha('captcha');
        $captcha
            ->setCaptcha($this->captchaAdapter)
            ->setOptions(array('label' => 'Copy the code in the field next to it'))
            ->setAttribute('id', $this->getName().'-captcha');
        $this->add($captcha);

        $this->add(new Element\Csrf('csrf'));

        $this->add(array(
            'name' => 'submit',
            'type'  => 'Zend\Form\Element\Submit',
        ));
    }
}
