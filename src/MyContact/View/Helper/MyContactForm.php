<?php
/**
 * @author Stefano Torresi (http://stefanotorresi.it)
 * @license See the file LICENSE.txt for copying permission.
 * ************************************************
 */

namespace MyContact\View\Helper;

use MyContact\Form\ContactForm;
use Zend\View\Helper\AbstractHelper;

class MyContactForm extends AbstractHelper
{
    /**
     * @var ContactForm
     */
    protected $form;

    /**
     * @param ContactForm $form
     */
    public function __construct(ContactForm $form)
    {
        $this->form = $form;
    }

    /**
     * @param string $partial
     * @return string
     */
    public function __invoke($partial = 'my-contact/contact/form')
    {
        return $this->getView()->partial($partial, array('contactForm' => $this->form));
    }

    /**
     * @return ContactForm
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param ContactForm $form
     * @return $this
     */
    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }
}
