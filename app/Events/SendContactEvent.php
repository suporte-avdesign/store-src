<?php

namespace AVD\Events;


class SendContactEvent
{
    private $name;
    private $email;
    private $subject;
    private $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email, $name, $subject, $message)
    {
        $this->name    = $name;
        $this->email   = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

}
