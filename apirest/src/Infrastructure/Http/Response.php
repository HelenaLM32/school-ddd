<?php

namespace App\Infrastructure\Http;

class Response
{

    private int $statusCode;
    private array $headers = [];
    private mixed $body;

    public function __construct(mixed $body = null, int $statusCode = 200, array $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeader(string $key, string $value)
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    public function json(array $data, int $status)
    {
        return new self(json_encode($data), $status, ['Content-Type' => 'application/json']);
    }

    public function send(): void
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $header => $value) {
            header("{$header}:{$value}");
        }
        echo $this->body;
    }

    public function html(string $template, ?array $data = [], int $status = 200)
    {
        ob_start();
        if ($data) extract($data);
        include VIEWS . "{$template}.view.php";
        $body = ob_get_clean();
        return new self($body, $status, ['Content-Type' => 'text/html']);
    }
}
