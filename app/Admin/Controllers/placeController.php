<?php

namespace App\Admin\Controllers;

use App\Models\place;
use App\Models\governs;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class placeController extends Controller
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
            ->header('Places')
            // ->description('description')
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
            ->header('Place Details')
            // ->description('description')
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
            ->header('Edit Place')
            // ->description('description')
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
            ->header('Create New Place')
            // ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new place);

        $grid->id('ID');
        $grid->name_en('Name English')->sortable();
        $grid->name_ar('Name Arabic')->sortable();
        $grid->govern()->name_en('Govern');
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
        $show = new Show(place::findOrFail($id));

        $show->id('ID');
        $show->name_en('name_en');
        $show->name_ar('name_ar');
        $show->govern('Govern')->as(function ($govern) {
        $data='';
         $data = "<span class='label label-info' style= 'margin-right:5px;'> {$govern['name_en']} </span><br>";
            return $data;
        })->unescape();
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
        $form = new Form(new place);

        $form->display('ID');
        $form->text('name_en', 'Name English')->rules('required');
        $form->text('name_ar', 'Name Arabic')->rules('required');
        $form->select('govern_id')->options(governs::all()->pluck('name_en', 'id'));

        $form->display('Created at');
        // $form->display('Updated at');

        return $form;
    }
}
