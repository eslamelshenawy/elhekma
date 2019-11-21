<?php

namespace App\Admin\Controllers;

use App\Models\customFieldsItems;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\customFields;
use Encore\Admin\Show;

class customFieldsItemsController extends Controller
{
    use ModelForm;
    public function show($id, Content $content)
    {
        return $content
            ->header('Custom Field Item Details')
            // ->description('description')
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
        $show = new Show(customFieldsItems::findOrFail($id));

        $show->id('ID');
        $show->name_en('name_en');
        $show->name_ar('name_ar');
        $show->desc_en('desc_en');
        $show->desc_ar('desc_ar');
        $show->custom_field('Custom Field')->as(function ($customField) {
            if($customField){
             return $customField->name_en;
            }

         });


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

            $content->header('Custom Fields Items');
            // $content->description('description');

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

            $content->header('Edit Custom Field Item');
            // $content->description('description');

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

            $content->header('Create New Custom Field Item');
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
        return Admin::grid(customFieldsItems::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name_en('Name English')->sortable();
            $grid->name_ar('Name Arabic')->sortable();
            $grid->custom_field()->name_en('Custom Field');
            $grid->created_at();
            // $grid->updated_at();
            $grid->filter(function($filter){
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->equal('custom_field_id', 'custom field')->Select(customFields::all()->pluck('name_en', 'id'));
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
    protected function form()
    {
        return Admin::form(customFieldsItems::class, function (Form $form) {

            // $form->display('id', 'ID');
            $form->text('name_en', 'Name English')->rules('required');
            $form->text('name_ar', 'Name Arabic')->rules('required');
            $form->text('desc_en', 'Description English')->rules('required');
            $form->text('desc_ar', 'Description Arabic')->rules('required');
            $form->select('custom_field_id','Custom Field')->options(customFields::all()->pluck('name_en', 'id'));

            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');
        });
    }
}
