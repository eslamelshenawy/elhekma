<?php

namespace App\Admin\Controllers;

use App\Models\store_identity;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Show;

class store_identityController extends Controller
{
    use ModelForm;
/**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Store Details')
            ->body($this->detail($id));
    }


      /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(store_identity::findOrFail($id));

        $show->name_en('Name English');
        $show->name_ar('Name Arabic');
        $show->shipping_cost('Shipping Cost');
      //  $show->logo('Logo')->image(url($path ='uploads'). "/", 100, 100);
        $show->address('Address');
        $show->phone('Phone');
     //   $show->latitude('Latitude');
     //   $show->longitude('Longitude');
        $show->email('Email');
     //   $show->facebook('Facebook');
     //   $show->youtube('Youtube');
     //   $show->twitter('Twitter');
        $show->website('Website');

        return $show;
    }
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Store Identity');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Edit Store');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Create New Store');
            // $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(store_identity::class, function (Grid $grid) {

            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
            $grid->disableCreateButton();
            $grid->disableFilter();

            $grid->disableRowSelector();

            $grid->disableColumnSelector();

            $grid->disableTools();

            $grid->disableExport();

            $grid->id('ID')->sortable();
            $grid->name_en('Name English')->sortable();
            $grid->name_ar('Name Arabic')->sortable();
            $grid->shipping_cost('Shipping Cost')->sortable();
            $grid->address('address');
            $grid->phone('Phone');
        //    $grid->logo('Logo')->image(url($path ='uploads'). "/", 100, 100);


            $grid->filter(function($filter){

                $filter->column(1 / 2, function ($filter) {
                    $filter->like('address', 'Address');
                });

                $filter->column(1 / 2, function ($filter) {
                    $filter->like('name_en', 'Name English');
                    $filter->like('name_ar', 'Name Arabic');

                });
        });
    });
}

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(store_identity::class, function (Form $form) {


            $form->text('name_en', 'Name English')->rules('required');
            $form->text('name_ar', 'Name Arabic')->rules('required');
            $form->number('shipping_cost', 'Shipping cost')->min(1)->default(1);
           // $form->image('logo', 'Logo');
            $form->text('address', 'Address')->rules('required');
            $form->text('phone', 'Phone')->rules('required');
          //  $form->text('latitude', 'Latitude');
          //  $form->text('longitude', 'Longitude');
            // $form->map("latitude","longitude","Select Location")->rules('required')->useGoogleMap();
            $form->email('email');
          //  $form->url('facebook', 'Facebook');
          //  $form->url('youtube', 'Youtube');
           // $form->url('twitter', 'Twitter');
            $form->url('website', 'Website');

        });
    }
}
