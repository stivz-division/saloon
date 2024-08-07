<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class YookassaIpAccess
{

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $ips = [
            '185.71.76.0/27',
            '185.71.77.0/27',
            '77.75.153.0/25',
            '77.75.156.11',
            '77.75.156.35',
            '77.75.154.128/25',
            '2a02:5180::/32',
        ];
        if (app()->isProduction()) {
            $result = false;
            foreach ($ips as $ip) {
                if ($this->ipInRange($request->ip(), $ip)) {
                    $result = true;
                    break;
                }
            }
            abort_if(! $result, 404, 'Not found!');
        }

        return $next($request);
    }

    private function ipInRange($ip, $range): bool
    {
        if ( ! str_contains($range, '/')) {
            $range .= '/32';
        }
        [$range, $netmask] = explode('/', $range, 2);
        $range_decimal    = ip2long($range);
        $ip_decimal       = ip2long($ip);
        $wildcard_decimal = pow(2, (32 - $netmask)) - 1;
        $netmask_decimal  = ~$wildcard_decimal;

        return (($ip_decimal & $netmask_decimal) == ($range_decimal
                & $netmask_decimal));
    }

}
