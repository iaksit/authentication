<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 19.8.2015
 * Time: 17:16
 */

namespace iaksit\Mail;


class Mailer
{
    protected $view;

    protected $mailer;

    /**
     * Mailer constructor.
     * @param $view
     * @param $mailer
     */
    public function __construct($view, $mailer)
    {
        $this->view = $view;
        $this->mailer = $mailer;
    }

    public function send($template, $data, $callback)
    {
        $message = new Message($this->mailer);

        $this->view->appendData($data);

        $message->body($this->view->render($template));

        call_user_func($callback, $message);

        $this->mailer->send();
        /*
        if (!$this->mailer->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mailer->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }*/
    }
}