<?php

namespace App\Admin\Controllers;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use File;

class SliderController extends Controller
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
            ->header('Slider Images And Links')
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
        $grid = new Grid(new Slider);

        $grid->id('ID');
        $grid->image('Image')->image(url($path ='uploads'). "/", 100, 100);
        $grid->link('Link');
        $grid->text1('Text1 EN');
        $grid->text2('Text2 EN');
        $grid->text1_ar('Text1 AR');
        $grid->text2_ar('Text2 AR');

        $grid->disableFilter();
        $grid->disableExport();
        $grid->actions(function ($actions) {
            // $actions->disableDelete();
            // $actions->disableEdit();
            $actions->disableView();
        });
        // $grid->created_at('Created at');
        // $grid->updated_at('Updated at');

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
        $show = new Show(Slider::findOrFail($id));

        $show->id('ID');
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
        $form = new Form(new Slider);
        $path = public_path('uploads/slider_images');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        $form->image('image','Image')->move('slider_images')->uniqueName();
        $form->url('link','Full Link');
        $form->text('text1','Text1 EN');
        $form->text('text2','Text2 EN');
        $form->text('text1_ar','Text1 AR');
        $form->text('text2_ar','Text2 AR');
        // $form->display('ID');
        // $form->display('Created at');
        // $form->display('Updated at');
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
        });

        return $form;
    }
}
