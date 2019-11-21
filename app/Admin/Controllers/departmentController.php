<?php

namespace App\Admin\Controllers;

use App\Models\department;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\brandsGroup;
use Encore\Admin\Show;

class departmentController extends Controller
{
    use ModelForm;
    public function show($id, Content $content)
    {
        return $content
            ->header('Department Details')
            // ->description(' ')
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
        $show = new Show(department::findOrFail($id));

        $show->id('ID');
        $show->name_en('name_en');
        $show->name_ar('name_ar');
        //$show->logo('Logo')->image(url($path ='uploads'). "/", 100, 100);
        $show->desc_en('desc_en');
        $show->desc_ar('desc_ar');
        /*$show->brandsGroup('Active Ingredients')->as(function ($brands) {
            $data='';
            foreach ($brands as $key => $value) {
                $data  .= "<span class='label label-info' style= 'margin-right:5px;'> {$value['name_en']} </span>";
            }
            return $data;
        })->unescape();*/
       // $show->target_audiences('target_audiences');
       // $show->colors('colors');

       // $show->active_ingredient('active_ingredient');
       // $show->pharmaceutical_form('pharmaceutical_form');

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

            $content->header('Departments');
            $content->description(' ');

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

            $content->header('Edit Department');
            // $content->description(' ');

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

            $content->header('Create New Department');
            // $content->description(' ');

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
        return Admin::grid(department::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name_en('Name English')->sortable();
            $grid->name_ar('Name Arabic')->sortable();
           /* $grid->logo('Logo')->image();
            $grid->brandsGroup()->display(function ($brandsGroup) {

                    $brandsGroup = array_map(function ($brandGroup) {
                        return "<span class='label label-success'>{$brandGroup['name_en']}</span>";
                    }, $brandsGroup);

                    return join('&nbsp;', $brandsGroup);
                });*/
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
        return Admin::form(department::class, function (Form $form) {

            // $form->display('id', 'ID');
            $form->text('name_en', 'Name English')->rules('required');
            $form->text('name_ar', 'Name Arabic')->rules('required');
            $form->text('desc_en', 'Description English')->rules('required');
            $form->text('desc_ar', 'Description Arabic')->rules('required');
          //  $form->image('logo', 'Logo')->uniqueName();
          //  $form->multipleSelect('brandsGroup' , 'brands Group')->options(brandsGroup::all()->pluck('name_en', 'id'));
          //  $form->radio('target_audiences','target_audiences')->options(['1' => 'Yes','0'=>'No']);
          //  $form->radio('colors','colors')->options(['1' => 'Yes','0'=>'No']);
          //  $form->radio('active_ingredient','active_ingredient')->options(['1' => 'Yes','0'=>'No']);
           // $form->radio('pharmaceutical_form','pharmaceutical_form')->options(['1' => 'Yes','0'=>'No']);
            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');
        });
    }
}
