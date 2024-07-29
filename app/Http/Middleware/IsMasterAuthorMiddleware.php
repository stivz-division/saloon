<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsMasterAuthorMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $masterAdvertisement = $request->route('masterAdvertisement');

        if ($masterAdvertisement === null) {
            abort(Response::HTTP_FORBIDDEN);
        }

        if (auth()->user()->can('update', $masterAdvertisement) === false) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }

}
