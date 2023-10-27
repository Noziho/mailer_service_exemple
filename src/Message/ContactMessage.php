<?php

namespace App\Message;

class ContactMessage
{
    private string $from;
    private string $message;
    private string $subject;
    private string $fullName;

    /**
     * @param string $from
     * @param string $message
     * @param string $subject
     * @param string $fullName
     */
    public function __construct(string $from, string $message, string $subject, string $fullName)
    {
        $this->from = $from;
        $this->message = $message;
        $this->subject = $subject;
        $this->fullName = $fullName;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function setFrom(string $from): void
    {
        $this->from = $from;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }


}