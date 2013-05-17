<?php

namespace MyContact\Controller;

use MyContact\Form\ContactForm;
use Zend\Mail\Transport;
use Zend\Mail\Message;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController extends AbstractActionController
{
    /*
     * @var ContactForm
     */
    protected $form;

    /**
     *
     * @var Message
     */
    protected $message;

    /**
     *
     * @var Transport\TransportInterface
     */
    protected $transport;

    public function indexAction()
    {
        $model = new ViewModel( array(
            'contactForm' => $this->form,
        ));

        if ($this->getRequest()->isXmlHttpRequest()) {
            $model->setTemplate('my-contact/contact/form')->setTerminal(true);
        }

        return $model;
    }

    public function processAction()
    {

        if (!$this->request->isPost()) {
            return $this->redirect()->toRoute('contact');
        }

        $model = new ViewModel();
        $model->setTerminal($this->getRequest()->isXmlHttpRequest());

        $post = $this->request->getPost();
        $form = $this->form;
        $form->setData($post);

        if (!$form->isValid()) {
            $model->setVariables(array(
                'error' => true,
                'contactForm'  => $form,
            ));

            if ($model->terminate()) {
                $model->setTemplate('my-contact/contact/form');
            } else {
                $model->setTemplate('my-contact/contact/index');
            }

            return $model;
        }

        // send email...
        $this->sendEmail($form->getData());

        $model->setTemplate('my-contact/contact/thank-you');

        return $model;
    }

    public function setContactForm(ContactForm $form)
    {
        $this->form = $form;
    }

    public function setMessage(Message $message)
    {
        $this->message = $message;
    }

    public function setMailTransport(Transport\TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    protected function sendEmail(array $data)
    {
        $name       = $data['name'];
        $email      = $data['email'];
        $subject    = $this->message->getSubject().$data['subject'];
        $body       = $data['body'];

        $this->message->addFrom($email, $name)
                      ->addReplyTo($email, $name)
                      ->setSubject($subject)
                      ->setBody($body);
        $this->transport->send($this->message);
    }
}
