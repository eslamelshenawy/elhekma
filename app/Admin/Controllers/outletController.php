<?php

namespace App\Admin\Controllers;

use App\Models\outlets;
use App\Models\governs;
use App\Models\companies;
use App\Models\place;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Show;

class outletController extends Controller
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
            ->header('Branch Details')

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
        $show = new Show(outlets::findOrFail($id));

        $show->id('ID');
        $show->name_en('name_en');
        $show->name_ar('name_ar');
        //$show->logo('Logo')->image();
        $show->address('address');
        $show->govern('Govern')->as(function ($govern) {
            return $govern->name_en;
        });

        // ->display(function ($brandsGroup) {

        //     $brandsGroup = array_map(function ($brandGroup) {
        //         return "<span class='label label-success'>{$brandGroup['name_en']}</span>";
        //     }, $brandsGroup);

        //     return join('&nbsp;', $brandsGroup);
        // });
        $show->place('Place')->as(function ($place) {
            return $place->name_en;
        });

        $show->phone('phone');
        $show->email('email');
        //$show->latitude('latitude');
        //$show->longitude('longitude');
        //$show->facebook('facebook');
        //$show->youtube('youtube');
        //$show->twitter('twitter');
        $show->website('website');

        $show->created_at('Created at');
        $show->updated_at('Updated at');

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

            $content->header('Branchs');
            $content->description('Company Branchs');

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

            $content->header('Edit Branch');
            // $content->description('Branch');

            $content->body($this->form($id)->edit($id));
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

            $content->header('Create New Branch');
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
        return Admin::grid(outlets::class, function (Grid $grid) {
         // $grid->outlets()->where('id', '>', 2);
            if (!Admin::user()->isAdministrator()) {
                $grid->model()->where('company_id', '=', Admin::user()->company_id);
            }
            $grid->id('ID')->sortable();
            $grid->name_en('Name English')->sortable();
            $grid->name_ar('Name Arabic')->sortable();
            $grid->phone('Phone')->sortable();
            //$grid->logo('Logo')->image(url($path ='uploads'). "/", 100, 100);

            $grid->created_at();
            // $grid->updated_at();
            $grid->filter(function($filter){
                $filter->useModal();
                    $filter->like('name_en', 'Name English');
                    $filter->like('name_ar', 'Name Arabic');
                });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id='')
    {
        $places = null;
        if($id){
            $model = outlets::find($id);
            if($model){
                $places = $model->govern->places;
            }
        }
        return Admin::form(outlets::class, function (Form $form) use($places) {

            $form->display('id', 'ID');
            $form->text('name_en', 'Name English')->rules('required');
            $form->text('name_ar', 'Name Arabic')->rules('required');
            if (Admin::user()->isAdministrator()) {
                $form->select('company_id', 'Company')->options(companies::all()->pluck('name_en', 'id'))->rules('required');
            }
            //$form->select('company_id','Company')->options(companies::all()->pluck('name_en', 'id'));
        //    $form->image('logo', 'Logo')->uniqueName();
            $form->text('address', 'Address');
            $form->select('govern_id', 'Govern')->options(governs::all()->pluck('name_en', 'id'))->rules('required')
                ->load('place_id','/place', 'id', 'name_en');

            if($places){
                $form->select('place_id', 'Place')->options($places->pluck('name_en', 'id'))->rules('required');
            }else{
                $form->select('place_id', 'Place')->options()->rules('required');
            }

            $form->mobile('phone', 'Phone');
            $form->text('email', 'E-mail');
          //  $form->text('latitude', 'Latitude');
         //   $form->text('longitude', 'Longitude');
           // $form->url('facebook', 'Facebook');
           // $form->url('youtube', 'Youtube');
           // $form->url('twitter', 'Twitter');
            $form->url('website', 'Website');
            // $form->hidden('company_id')->value(json_encode((int)explode('/',\URL::current())[5]));

          //  $form->select('type','Type')->options([0 => 'stock', 2 => 'outlet', 'val' => 'Option Types']);

            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');

        $form->saving(function (Form $form) {
            if (!Admin::user()->isAdministrator()) {
                $form->model()->company_id = Admin::user()->company_id ;
            }
        });

        });
    }
}
