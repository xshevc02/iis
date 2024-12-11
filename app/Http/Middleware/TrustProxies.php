<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request as RequestAlias;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies = '**';

    /**
     * The current proxy header mappings.
     *
     * @var array
     */
    protected $headers = [
        RequestAlias::HEADER_FORWARDED => 'FORWARDED',
        RequestAlias::HEADER_X_FORWARDED_FOR => 'X_FORWARDED_FOR',
        RequestAlias::HEADER_X_FORWARDED_HOST => 'X_FORWARDED_HOST',
        RequestAlias::HEADER_X_FORWARDED_PORT => 'X_FORWARDED_PORT',
        RequestAlias::HEADER_X_FORWARDED_PROTO => 'X_FORWARDED_PROTO',
    ];
}
