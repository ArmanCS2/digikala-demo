<?php

namespace App\Http\Services\Message\Email;

use App\Http\Interfaces\MessageInterface;
use Illuminate\Support\Facades\Mail;

class EmailService implements MessageInterface
{
    private $details;
    private $subject;
    protected $files=null;
    private $from = [
        ['address' => null, 'name' => null]
    ];
    private $to;

    public function fire()
    {
        Mail::to($this->to)->send(new MailViewProvider($this->details, $this->subject, $this->from,$this->files));
        return true;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details)
    {
        $this->details = $details;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($address, $name)
    {
        $this->from = [
            ['address' => $address, 'name' => $name]
        ];
    }

    public function setFiles($files)
    {
        $this->files = $files;
    }

    public function getFiles()
    {
        return $this->files;
    }
}
