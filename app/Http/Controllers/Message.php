<?php
class Message
{
    private $code;
    private $message;
    private $data;
    public function getCode()
    {
        return $this->code;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }
    public function setMessage($message)
    {
        $this->message = $message;
    }
    public function setData($data)
    {
        $this->data = $data;
    }
}
