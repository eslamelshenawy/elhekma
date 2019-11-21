<?php

namespace App\Admin\Controllers;

use App\Models\pharmaceuticalForm;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Show;

class pharmaceuticalFormController extends Controller
{
    use ModelForm;
    public function show($id, Content $content)
    {
        return $content
            ->header('Pharmaceutical Form Details')
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
        $show = new Show(pharmaceuticalForm::findOrFail($id));

        $show->id('ID');
        $show->name_en('name_en');
        $show->name_ar('name_ar');


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

            $content->header('Pharmaceutical Forms');
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

            $content->header('Edit Pharmaceutical Form');
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

            $content->header('Create New Pharmaceutical Form');
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
        return Admin::grid(pharmaceuticalForm::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name_en('Name English')->sortable();
            $grid->name_ar('Name Arabic')->sortable();
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
    protected function form()
    {
        return Admin::form(pharmaceuticalForm::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name_en', 'Name English')->rules('required');
            $form->text('name_ar', 'Name Arabic')->rules('required');

            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');
        });
    }
}
