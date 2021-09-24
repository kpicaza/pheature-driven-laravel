<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Pheature\Community\Laravel\Toggle;
use Pheature\Sdk\OnDisabledFeature;

final class HomePage extends Controller
{
    public function __invoke(): JsonResponse
    {
        $result = Toggle::inFeature('home_page', null, null, OnDisabledFeature::make(fn() => 'mundo!!'));

        return new JsonResponse(['hola' => $result->getData()]);
    }
}
