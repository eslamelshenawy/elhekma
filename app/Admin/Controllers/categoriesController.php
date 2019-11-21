<?php

namespace App\Admin\Controllers;

use App\Models\categories;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\department;
use App\Models\customFields;
use App\Models\tagsGroup;
use Encore\Admin\Show;

class categoriesController extends Controller
{
    use ModelForm;
    public function show($id, Content $content)
    {
        return $content
            ->header('Category Details')
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
        $show = new Show(categories::findOrFail($id));

        $show->id('ID');
        $show->name_en('name_en');
        $show->name_ar('name_ar');
       // $show->logo('Logo')->image();
        $show->desc_en('desc_en');
        $show->desc_ar('desc_ar');

        /*$show->custom_field('Custom Field')->as(function ($customField) {
           if($customField){
            return $customField->name_en;
           }

        });*/

        $show->department('Department')->as(function ($department) {
            return $department->name_en;
        });

/*        $show->tags_group('Tags Group')->as(function ($tagsGroup) {
            $data='';
            foreach ($tagsGroup as $key => $value) {
                $data  .= "<span class='label label-info' style= 'margin-right:5px;'> {$value['name_en']} </span>";
            }
            return $data;
        })->unescape();*/

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

            $content->header('Categories');
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

            $content->header('Edit Category');
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

            $content->header('Create New Category');
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
        return Admin::grid(categories::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name_en('Name English')->sortable();
            $grid->name_ar('Name Arabic')->sortable();
           // $grid->logo('Logo')->image();
          //  $grid->custom_field()->name_en('Custom Field');
            $grid->department()->name_en('Department');
            /*$grid->tags_group()->display(function ($tagsGroups) {

                $tagsGroups = array_map(function ($tagGroup) {
                    return "<span class='label label-success'>{$tagGroup['name_en']}</span>";
                }, $tagsGroups);

                return join('&nbsp;', $tagsGroups);
            });*/

            $grid->created_at();
            // $grid->updated_at();
            $grid->filter(function ($filter) {
                $filter->useModal();
                $filter->disableIdFilter();
                $filter->like('name_en', 'Name English');
                $filter->like('name_ar', 'Name Arabic');
                $filter->equal('department_id', 'Department')->Select(department::all()->pluck('name_en', 'id'));
                //$filter->equal('custom_field_id', 'Custom Field')->Select(customFields::all()->pluck('name_en', 'id'));
                /*$filter->where(function ($query) {
                    $query->whereHas('tagsGroup', function ($query) {
                        $query->whereIn('tags_group_id', $this->input);
                    });
                }, 'Tags Group')->multipleSelect(tagsGroup::all()->pluck('name_en', 'id'));*/


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
        return Admin::form(categories::class, function (Form $form) {

            // $form->display('id', 'ID');
            $form->text('name_en', 'Name English')->rules('required');
            $form->text('name_ar', 'Name Arabic')->rules('required');
            $form->text('desc_en', 'Description English')->rules('required');
            $form->text('desc_ar', 'Description Arabic')->rules('required');
           // $form->image('logo', 'Logo')->uniqueName();
            $form->select('department_id','Department')->options(department::all()->pluck('name_en', 'id'));
          //  $form->select('custom_field_id','Custom Field')->options(customFields::all()->pluck('name_en', 'id'));
         //   $form->multipleSelect('tags_group','Tags Group')->options(tagsGroup::all()->pluck('name_en', 'id'));

            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');
        });
    }
}
