<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CachingMiddleware
{

    public const RESPONSE_TYPE_NORMAL = 'normal';
    public const RESPONSE_TYPE_FILE = 'file';

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Arr::get($request->input(), 'bad') == 1){
            throw new HttpException(400,'bad равен 1');
        }

        if (Cache::store('memcached')->get($request->route()->uri())) {
            return $this->unserialize(Cache::store('memcached')->get($request->route()->uri()));
        }

        $response = $next($request);
        if ($response->getStatusCode() === 200) {
            //sleep(5);
            Cache::store('memcached')->Forever($request->route()->uri(), $this->serialize($response));

        }
        return $response;
    }

    public function serialize(\Symfony\Component\HttpFoundation\Response $response): string
    {
        return serialize($this->getResponseData($response));
    }

    public function unserialize(string $serializedResponse): \Symfony\Component\HttpFoundation\Response
    {
        $responseProperties = unserialize($serializedResponse);

        $response = $this->buildResponse($responseProperties);

        $response->headers = $responseProperties['headers'];

        return $response;
    }

    protected function getResponseData(\Symfony\Component\HttpFoundation\Response $response): array
    {
        $statusCode = $response->getStatusCode();
        $headers = $response->headers;

        if ($response instanceof BinaryFileResponse) {
            $content = $response->getFile()->getPathname();
            $type = static::RESPONSE_TYPE_FILE;
            return compact('statusCode', 'headers', 'content', 'type');
        }

        $content = $response->getContent();
        $type = static::RESPONSE_TYPE_NORMAL;

        return compact('statusCode', 'headers', 'content', 'type');
    }

    protected function buildResponse(array $responseProperties): \Symfony\Component\HttpFoundation\Response
    {
        $type = $responseProperties['type'] ?? static::RESPONSE_TYPE_NORMAL;

        if ($type === static::RESPONSE_TYPE_FILE) {
            return new BinaryFileResponse(
                $responseProperties['content'],
                $responseProperties['statusCode']
            );
        }

        return new IlluminateResponse($responseProperties['content'], $responseProperties['statusCode']);
    }

}
