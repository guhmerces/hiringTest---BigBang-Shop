<?php

namespace App\Traits;

trait Message
{
    public $message;

    public $statusMessages;

    private function message($statusCode)
    {
        $this->message = $this->statusMessages[$statusCode];
    }
}
