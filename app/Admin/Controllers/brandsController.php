<?php

namespace App\Admin\Controllers;

use App\Models\brands;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\brandsGroup;
use Encore\Admin\Show;

class brandsController extends Controller
{
    use ModelForm;
    public function show($id, Content $content)
    {
        return $content
            ->header('Brand Details')
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
        $show = new Show(brands::findOrFail($id));

        $show->id('ID');
        $show->name_en('name_en');
        $show->name_ar('name_ar');
        $show->logo('Logo')->image();
        $show->brandsGroup('Brands Group')->as(function ($brandsGroup) {
            $data='';
            foreach ($brandsGroup as $key => $value) {
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

            $content->header('Brands');
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

            $content->header('Edit Brand');
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

            $content->header('Create New Brand');
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
        return Admin::grid(brands::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
             $grid->name_en('Name English')->sortable();
            $grid->name_ar('Name Arabic')->sortable();
            $grid->logo('Logo')->image();
            $grid->brandsGroup()->display(function ($brandsGroup) {

                    $brandsGroup = array_map(function ($brandGroup) {
                        return "<span class='label label-success'>{$brandGroup['name_en']}</span>";
                    }, $brandsGroup);

                    return join('&nbsp;', $brandsGroup);
                });
                        $grid->created_at();
                        // $grid->updated_at();

                $grid->filter(function($filter){
                    $filter->useModal();
                    $filter->like('name_en', 'Name English');
                    $filter->like('name_ar', 'Name Arabic');
                    // $filter->is('brands_group_id', 'Brands Group')->select(brandsGroup::all()->pluck('name_en', 'id'));

            $filter->where(function ($query) {

                                $input = $this->input;

                                $query->whereHas('brandsGroup', function ($query) use ($input) {
                                    $query->where('id', $input);
                                });

                            }, 'brands Group', 'brands')
                                ->select(brandsGroup::all()->pluck('name_en', 'id'));
                        });
                });
        // });
// });





}

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(brands::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name_en', 'Name English')->rules('required');
            $form->text('name_ar', 'Name Arabic')->rules('required');
            $form->image('logo', 'Logo')->move('uploads/images')->uniqueName();
            $form->multipleSelect('brandsGroup')->options(brandsGroup::all()->pluck('name_en', 'id'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
