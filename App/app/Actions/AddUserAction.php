<?php

namespace App\Actions;

use App\DTO\UserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AddUserAction
{
    /**
     * @param UserDto $dto
     * @return User
     */
    public function __invoke(UserDto $dto): User
    {
        $user = new User();
        $user->setAttribute('nickname', $dto->nickname);
        $user->setAttribute('password', Hash::make($dto->password));
        $user->save();

        return $user;
    }
}
