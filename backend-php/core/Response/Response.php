<?php

namespace App\Core\Response;

class Response
{
    /**
     * @var
     */
    private string $data;

    /**
     * @param $data
     * @return $this
     */
    public function toJson($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $this->data = json_encode($data);
        return $this;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setStatusCode($code)
    {
        http_response_code($code);
        return $this;
    }

    /**
     * @return mixed
     */
    public function send()
    {
        if (! $this->data) {
            return null;
        }

        echo $this->data;
    }
}