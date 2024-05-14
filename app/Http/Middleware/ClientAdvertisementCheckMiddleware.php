<?php

namespace App\Http\Middleware;

use App\Services\ClientAdvertisementService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientAdvertisementCheckMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $advertisementUuid = $request->route('advertisement');

        $checkAdvertisement
            = app(ClientAdvertisementService::class)
            ->checkAdvertisement(
                $request->user()->id,
                $advertisementUuid
            );

        if ($checkAdvertisement === false) {
            if ($request->user()->isMaster()) {
                return redirect(
                    route('master-payment.client-advertisement', [
                        'advertisement' => $advertisementUuid,
                    ])
                );
            }

            abort(Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }

}
