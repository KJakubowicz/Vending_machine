<?php

namespace VendingMachine\Response;

interface ResponseInterface
{
	public function __toString(): string;
    public function getReturnCode(): int;
}
