<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

class ForceJson
{
    protected $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function handle(Request $request, Closure $next)
    {
        // Forçar o cabeçalho Accept para application/json
        $request->headers->set('Accept', 'application/json');

        // Processar a requisição
        $response = $next($request);

        // Garantir que a resposta seja JSON
        if (!$response instanceof JsonResponse) {
            $response = $this->responseFactory->json(
                $response->content(),
                $response->status(),
                $response->headers->all()
            );
        }

        return $response;
    }
}
