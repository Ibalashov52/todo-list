<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class WelcomeController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        return response()->json([
            'message' => __('welcome.baseMessage'),
        ]);
    }
}
