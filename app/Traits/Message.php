<?php

namespace App\Traits;

trait Message
{
    public $message;

    private $statusMessages;

    /**
     * Defines a hash with custom messages for custom given status codes
     * @param array $statusMessages
     */
    private function setStatusMessages(array $statusMessages)
    {
        $this->statusMessages = $statusMessages;
    }

    /**
     * Defines the message attribute according to de status code
     * @param int $statusCode
     */
    private function message(int $statusCode)
    {
        $this->message = $this->statusMessages[$statusCode];
    }
}
