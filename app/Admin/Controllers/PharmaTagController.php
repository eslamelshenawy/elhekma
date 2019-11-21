<?php

namespace App\Admin\Controllers;

use App\Models\categories;
use App\Models\department;
use App\Models\PharmaTag;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PharmaTagController extends Controller
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
            ->header('Sub categories')
            ->description(' ')
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
            ->header('Sub category Details')
            // ->description(' ')
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
            ->header('Edit Sub category')
            ->description(' ')
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
            ->header('Create New Sub category')
            // ->description(' ')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PharmaTag);

        $grid->id('ID');
        $grid->name_en('name english')->sortable();
        //$grid->name_ar('Name Arabic')->sortable();

        $grid->category()->name_en('Category');
        $grid->parent()->name_en('Parent');

        $grid->created_at('Created at');
       // $grid->updated_at('Updated at');

        $grid->filter(function($filter){
            $filter->useModal();
            $filter->disableIdFilter();
            $filter->equal('department_id', 'Department')->Select(department::all()->pluck('name_en', 'id'))
                ->load('category_id', '/category', 'id', 'name_en');
            $filter->equal('category_id', 'category')->Select(categories::all()->pluck('name_en', 'id'));
            $filter->like('name_en', 'Name English');
            $filter->like('name_ar', 'Name Arabic');
        });

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
        $show = new Show(PharmaTag::findOrFail($id));

        $show->id('ID');
        $show->name_en('name');
        $show->category('Category')->as(function ($category) {
            return $category['name_en'];
        });
        $show->Parent('parent')->as(function ($parent) {
            return $parent['name_en'];
        });
        $show->department('Department')->as(function ($department) {
            return $department['name_en'];
        });
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
        $form = new Form(new PharmaTag);

        $form->display('ID');
        $form->text('name_en', 'Name English')->rules('required');
        $form->text('name_ar', 'Name Arabic')->rules('required');


        $form->select('department_id', 'Department')->options(department::all()->pluck('name_en', 'id'))->rules('required')
            ->loads(['category_id', 'brand_id'], ['/category', '/brand'], 'id', 'name_en');

        $form->select('category_id', 'Category')->options(categories::all()->pluck('name_en', 'id'))->rules('required')
            ->load('parent_id',   '/pharmaTag/0' , 'id', 'name_en');

        /*$subcats =PharmaTag::where('category_id',$form->model()->category_id)->get(['id', 'name_en'])->toArray();

        $sub1 = array (
            0 =>
                array (
                    'id' => 0,
                    'name_en' => '-',
                )
        );
        $mer = array_merge($sub1 , $subcats);
        */
        /*logger(' f'.$form->model()->category_id);
        $subcats =PharmaTag::where('category_id',$form->model()->category_id)->get()->pluck('name_en', 'id');
       // $subcats->prepend('-', 0);
        $form->select('parent_id', 'Parent')->options($subcats);*/

        $form->select('parent_id', 'Parent ')->options(function ($id, $form) {
            $sub1_category = PharmaTag::find($id);

            if ($sub1_category) {
                return [$sub1_category->id => $sub1_category->name_en];
            }
        });



        $form->display('Created at');
        $form->display('Updated at');

        $form->saved(function (Form $form) {
            if ($form->model()->parent_id == null || $form->model()->parent_id == '-') {
                $form->model()->parent_id = 0;
                $form->model()->save();

            }
        });

        return $form;
    }
}
