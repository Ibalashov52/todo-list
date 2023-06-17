<?php

namespace App\DTO;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

class UserDto extends DataTransferObject
{
    public string $nickname;
    public string $password;
}
