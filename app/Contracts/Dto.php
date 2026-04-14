<?php

namespace App\Contracts;

interface Dto
{
    public static function fromArray(array $data): static;
}
