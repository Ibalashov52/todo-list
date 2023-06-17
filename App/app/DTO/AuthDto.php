<?php

namespace App\DTO;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

class AuthDto extends DataTransferObject
{
    public string $token;
    public string $tokenType;
    public int $expiresIn;
}
