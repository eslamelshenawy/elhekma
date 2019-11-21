<?php

//namespace Encore\Admin\Controllers;
namespace App\Models;
use Encore\Admin\Admin;
use Illuminate\Http\Request;

class Dashboard
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function title()
    {
        return view('dashboard.title');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function environment()
    {
        return view('dashboard.environment',[

        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function extensions()
    {

        return view('dashboard.extensions', [

        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function dependencies()
    {
        return view('dashboard.dependencies',[

        ]);
    }
}
