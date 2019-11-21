<?php

namespace App\Admin\Controllers;

use App\Models\MobileSlider;
use App\Models\products;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MobileSliderController extends Controller
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
        $grid = new Grid(new MobileSlider);

        $grid->id('ID');
        $grid->product()->name_en('Product Name');
        $grid->image('Image')->image(url($path ='uploads'). "/", 100, 100);
        $grid->title('Title');
        $grid->title_ar('Title Arabic');
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
        $show = new Show(MobileSlider::findOrFail($id));

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
        $form = new Form(new MobileSlider);
        $form->select('product_id','Product')->options(products::all()->pluck('name_en', 'id'))->rules(function ($form) {
            if (!$id = $form->model()->id) {
                return 'required|unique:mobile_slider,product_id';
            }else{
                return 'required';
            }

        });
        
        $form->image('image','Product Slider Image')->uniqueName()->rules('required');;
        $form->text('title','Title')->rules('required');;
        $form->text('title_ar','Title Arabic')->rules('required');
        return $form;
    }
}
