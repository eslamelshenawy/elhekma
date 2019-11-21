<?php

namespace App\Admin\Controllers;

use App\Models\brandsGroup;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\brands;
use Encore\Admin\Show;

class brandsGroupController extends Controller
{
    use ModelForm;

//public $dir=storage_path('uploads/images');
public function show($id, Content $content)
{
    return $content
        ->header('Brand Group Details')
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
    $show = new Show(brandsGroup::findOrFail($id));

    $show->id('ID');
    $show->name_en('name_en');
    $show->name_ar('name_ar');
    $show->logo('Logo')->image();
    $show->desc_en('desc_en');
    $show->desc_ar('desc_ar');

    $show->brands('Brands')->as(function ($brands) {
        $data='';
        foreach ($brands as $key => $value) {
            $data  .= "<span class='label label-info' style= 'margin-right:5px;'> {$value['name_en']} </span><br>";
        }
        return $data;
    })->unescape();

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

            $content->header('Brands Group');
            // $content->description(' ');

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

            $content->header('Edit Brand Group');
            $content->description(' ');

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

            $content->header('Create New Brand Group');
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
        return Admin::grid(brandsGroup::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name_en('Name English')->sortable();
            $grid->name_ar('Name Arabic')->sortable();
            // $grid->logo('Logo')->sortable();
            $grid->logo('Logo')->image();
            $grid->brands()->display(function ($brands) {

                    $brands = array_map(function ($brand) {
                        return "<span class='label label-success'>{$brand['name_en']}</span>";
                    }, $brands);

                    return join('&nbsp;', $brands);
                });
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

        return Admin::form(brandsGroup::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name_en', 'Name English')->rules('required');
            $form->text('name_ar', 'Name Arabic')->rules('required');
            $form->text('desc_en', 'Description English')->rules('required');
            $form->text('desc_ar', 'Description Arabic')->rules('required');
            // $form->display('logo', 'Logo');
            $form->image('logo', 'Logo')->uniqueName();
            $form->multipleSelect('brands')->options(brands::all()->pluck('name_en', 'id'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

//     public function search($name){
// $brands =brandsGroup::where('name_en', 'like','%' .$name. '%')->get();
// // 'name', 'like', '%' . Input::get('name') . '%'

// return $brands;
//     }
}
