<?php

namespace App\Admin\Controllers;

use App\Models\tagItem;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\tagsGroup;
use Encore\Admin\Show;

class tagItemController extends Controller
{
    use ModelForm;
    public function show($id, Content $content)
    {
        return $content
            ->header('Tag Item Details')
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
        $show = new Show(tagItem::findOrFail($id));

        $show->id('ID');
        $show->name_en('name_en');
        $show->name_ar('name_ar');
        $show->desc_en('desc_en');
        $show->desc_ar('desc_ar');

        $show->tagsGroup('Tags Group')->as(function ($tagsGroup) {
            $data='';
            foreach ($tagsGroup as $key => $value) {
                $data  .= "<span class='label label-info' style= 'margin-right:5px;'> {$value['name_en']} </span>";
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

            $content->header('Tags Items ');
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

            $content->header('Edit Tag Item');
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

            $content->header('Create New Tag Item');
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
        return Admin::grid(tagItem::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name_en('Name English')->sortable();
            $grid->name_ar('Name Arabic')->sortable();
            $grid->tagsGroup()->display(function ($tagsGroup) {

                    $tagsGroup = array_map(function ($tagGroup) {
                        return "<span class='label label-success'>{$tagGroup['name_en']}</span>";
                    }, $tagsGroup);

                    return join('&nbsp;', $tagsGroup);
                });
            $grid->created_at();
            // $grid->updated_at();
            $grid->filter(function($filter){
                    $filter->useModal();
                    $filter->like('name_en', 'Name English');
                    $filter->like('name_ar', 'Name Arabic');
// $filter->equal('tag_item_tags_group.tags_group_id', 'Province')
//                 ->select(tagsGroup::all()->pluck('name', 'id'))
//                 ->load('tag_item_tags_group.tag_item_id', '');

    //                 $filter->where(function ($query) {
    //     $input = $this->input;
    //     $query->whereHas('tag_item_tags_group', function ($query) use ($input) {
    //         $query->where('tags_group_id', 'like', "%{$input}%");
    //     });

    // },'fff');


$filter->where(function ($query) {

                    $input = $this->input;

                    $query->whereHas('tagsGroup', function ($query) use ($input) {
                        $query->where('id', $input);
                    });

                }, 'Has tag', 'tag')
                    ->select(tagsGroup::all()->pluck('name_en', 'id'));
            });

    // $filter->is('tags_group_id', 'tag_item_tags_group')->select(tagsGroup::all()->pluck('name_en', 'id'));

                // });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(tagItem::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name_en', 'Name English')->rules('required');
            $form->text('name_ar', 'Name Arabic')->rules('required');
            $form->text('desc_en', 'Description English')->rules('required');
            $form->text('desc_ar', 'Description Arabic')->rules('required');
            $form->multipleSelect('tagsGroup')->options(tagsGroup::all()->pluck('name_en', 'id'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}