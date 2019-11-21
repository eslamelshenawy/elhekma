<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
//use Encore\Admin\Controllers\Dashboard;
use App\Models\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Request;
use Encore\Admin\Facades\Admin;

class HomeController extends Controller
{
    public function index(Request $request, Content $content)
    {

        if (Admin::user()->isRole('administrator')) {
        return $content
            ->header('Dashboard')
            ->description('Description...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });


                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });


                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

            });
        }else if (Admin::user()->isRole('company')) {
        return $content
            ->header('Company Dashboard')
            ->description('Control Company ')
            ->row(Dashboard::title());
            //->row("<a href='' target='_blank' rel='noopener noreferrer' class='btn btn-twitter'></a>");

            
        } else if (Admin::user()->isRole('Branch')) {
        return $content
            ->header('Branch Dashboard')
            ->description('Control Branch Order')
            ->row(Dashboard::title());
        }


         
    }
}
