<?php

namespace App\Traits;

trait Message
{
    public $message;

    private $statusMessages;

    private function message($statusCode)
    {
        $this->message = $this->statusMessages[$statusCode];
    }
}
