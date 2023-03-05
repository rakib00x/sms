<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'file-upload',
        'file-upload/upload',
        'csv-upload',
        'csv-upload/upload',
        'add-attachment',
        'add-attachment/attachment',
        'api/checkApiRequest',
        'checkApiRequest',
        'uploadbyapps',
        'uploadbyapps'
    ];
}
