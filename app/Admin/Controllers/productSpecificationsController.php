<?php

namespace App\Admin\Controllers;

use App\Models\productSpecifications;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class productSpecificationsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

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
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new productSpecifications);

        $grid->id('ID');
        $grid->name_en('Name English')->sortable();
            $grid->name_ar('Name Arabic')->sortable();
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(productSpecifications::findOrFail($id));

        $show->id('ID');
        $show->name_en('name_en');
        $show->name_ar('name_ar');
        $show->desc_en('desc_en');
        $show->desc_ar('desc_ar');
        $show->target_audiences('target_audiences');
        $show->colors('colors');
        $show->active_ingredient('active_ingredient');
        $show->pharmaceutical_form('pharmaceutical_form');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new productSpecifications);

        $form->display('ID');
        $form->text('name_en', 'Name English')->rules('required');
        $form->text('name_ar', 'Name Arabic')->rules('required');
        $form->text('desc_en', 'Description English')->rules('required');
        $form->text('desc_ar', 'Description Arabic')->rules('required');
        $form->radio('target_audiences','target_audiences')->options(['1' => 'Yes','0'=>'No']);
        $form->radio('colors','colors')->options(['1' => 'Yes','0'=>'No']);
        $form->radio('active_ingredient','active_ingredient')->options(['1' => 'Yes','0'=>'No']);
        $form->radio('pharmaceutical_form','pharmaceutical_form')->options(['1' => 'Yes','0'=>'No']);

        $form->display('Created at');
        $form->display('Updated at');

        return $form;
    }
}
