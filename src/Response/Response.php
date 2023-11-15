<?php

namespace VendingMachine\Response;

class Response implements ResponseInterface
{
    private int $returnCode;
    private string $message;

    public function __construct(int $returnCode, string $message = '')
    {
        $this->returnCode = $returnCode;
        $this->message = $message;
    }

    public function __toString(): string
    {
        return $this->message;
    }

    public function getReturnCode(): int
    {
        return $this->returnCode;
    }
}
