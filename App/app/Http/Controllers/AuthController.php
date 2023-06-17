<?php

namespace App\Http\Controllers;

use App\Actions\AddUserAction;
use App\DTO\AuthDto;
use App\DTO\UserDto;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\RespondWithTokenResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @group Авторизация
     *
     * Регистрация
     *
     * @authorized
     * @bodyParam nickname string required Имя пользователя. Обязательная уникальная строка от 4 до 10 символов
     * Example: TestUser
     * @bodyParam password string required Пароль пользователя. Обязательная строка от 4 до 10 символов
     * Example: TestPass
     *
     * @response 422 scenario="error"
     * {
     *      "message": "The password field must not be greater than 10 characters.",
     *      "errors": {
     *          "password": [
     *              "The password field must not be greater than 10 characters."
     *          ]
     *      },
     * }
     *
     * @response 200 scenario="success"
     * {
     *          "nickname": "TestUser",
     *          "id": 1
     * }
     * @param RegistrationRequest $request
     * @param AddUserAction $action
     * @return JsonResponse
     */
    public function registration(
        RegistrationRequest $request,
        AddUserAction       $action
    ): JsonResponse
    {
        $dto = UserDto::make($request->only([
            'nickname',
            'password'
        ]));

        $user = $action($dto);

        return response()->json(UserResource::make($user), 201);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only([
            'nickname',
            'password'
        ]);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $dto = AuthDto::make([
            'token' => $token,
            'tokenType' => 'bearer',
            'expiresIn' => auth()->factory()->getTTL() * 60
        ]);

        return response()->json(RespondWithTokenResource::make($dto));
    }
//
//    /**
//     * Get the authenticated User.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function me()
//    {
//        return response()->json(auth()->user());
//    }
//
//    /**
//     * Log the user out (Invalidate the token).
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function logout()
//    {
//        auth()->logout();
//
//        return response()->json(['message' => 'Successfully logged out']);
//    }
//
//    /**
//     * Refresh a token.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function refresh()
//    {
//        return $this->respondWithToken(auth()->refresh());
//    }
//
}
