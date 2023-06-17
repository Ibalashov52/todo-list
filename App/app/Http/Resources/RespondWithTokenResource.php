<?php

namespace App\Http\Resources;

use App\DTO\AuthDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RespondWithTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var AuthDto $dto */
        $dto = $this->resource;

        return [
            'access_token' => $dto->token,
            'token_type' => $dto->tokenType,
            'expires_in' => $dto->expiresIn
        ];
    }
}
