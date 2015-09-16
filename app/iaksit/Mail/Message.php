<?php
/**
 * Created by PhpStorm.
 * User: lvm
 * Date: 19.8.2015
 * Time: 17:22
 */

namespace iaksit\Mail;


class Message
{
    protected $mailer;

    /**
     * Message constructor.
     * @param $mailer
     */
    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function to($address, $name = null)
    {
        $this->mailer->addAddress($address, $name);
    }

    public function subject($subject)
    {
        $this->mailer->Subject = $subject;
    }

    public function body($body)
    {
        $this->mailer->Body = $body;
    }

}