<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class WelcomeController extends Controller
{
    /**
     * @group Тестовые страницы
     *
     * Стартовая страница
     *
     * Тестовая стартовая страница предназначенная для проверки работоспособности апи.
     * @response 200 scenario=success
     * {
     *     "message": "Привет. Добро пожаловать!"
     * }
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        return response()->json([
            'message' => __('welcome.baseMessage'),
        ]);
    }
}
