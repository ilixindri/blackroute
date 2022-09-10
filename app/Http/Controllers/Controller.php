<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function join_paths($args) {
        $paths = array();

        // foreach (func_get_args() as $arg) {
        foreach ($args as $arg) {
            if ($arg !== '') { $paths[] = $arg; }
        }

        return preg_replace('#/+#','/',join('/', $paths));
    }
}
