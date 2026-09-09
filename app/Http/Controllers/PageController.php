<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PageController extends Controller
{
    /**
     * Dashboard
     */
    public function index()
    {
        return app()->call(AuthController::class . '@home');
    }

    /**
     * Dynamic Page Dispatcher
     */
    public function page(Request $request)
    {
        $encrypted = $request->query('data');

        abort_unless($encrypted, 404);

        /*
        |--------------------------------------------------------------------------
        | DECRYPT DATA
        |--------------------------------------------------------------------------
        */

        try {

            $decrypted = Crypt::decryptString($encrypted);

            $data = json_decode(
                $decrypted,
                true
            );

            abort_unless(
                is_array($data),
                404
            );

        } catch (\Throwable $e) {

            abort(404);

        }


        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $controllerName = $data['controller'] ?? null;
        $action = $data['action'] ?? 'index';
        $id = $data['id'] ?? null;


        abort_unless(
            $controllerName,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | ALLOWED ACTION
        |--------------------------------------------------------------------------
        */

        $allowedActions = [
            'index',
            'create',
            'show',
            'edit',
            'store',
            'update',
            'destroy',
        ];

        abort_unless(
            in_array($action, $allowedActions, true),
            404
        );


        /*
        |--------------------------------------------------------------------------
        | CONTROLLER CLASS
        |--------------------------------------------------------------------------
        */

        $controllerClass =
            'App\\Http\\Controllers\\' . $controllerName;


        abort_unless(
            class_exists($controllerClass),
            404
        );


        $controller = app($controllerClass);


        /*
        |--------------------------------------------------------------------------
        | METHOD
        |--------------------------------------------------------------------------
        */

        abort_unless(
            method_exists($controller, $action),
            404
        );


        /*
        |--------------------------------------------------------------------------
        | SHARE DATA TO BLADE
        |--------------------------------------------------------------------------
        */

        view()->share(
            'currentController',
            $controllerName
        );


        /*
        |--------------------------------------------------------------------------
        | PARAMETERS
        |--------------------------------------------------------------------------
        */

        $parameters = [];


        if ($request->isMethod('GET')) {

            if ($id !== null) {
                $parameters['id'] = $id;
            }

        } else {

            $parameters = $request->except('data');

            if ($id !== null) {
                $parameters['id'] = $id;
            }

        }


        /*
        |--------------------------------------------------------------------------
        | CALL CONTROLLER
        |--------------------------------------------------------------------------
        */

        return app()->call(
            [$controller, $action],
            $parameters
        );
    }
}