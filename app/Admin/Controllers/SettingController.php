<?php

namespace App\Admin\Controllers;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\Setting;
use Encore\Admin\Show;

class SettingController extends Controller
{
    use ModelForm;
    public function show($id, Content $content)
    {
        return $content
            ->header('Setting Details')
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
        $show = new Show(Setting::findOrFail($id));

        $show->id('ID');
        $show->title('Title');
        $show->title_ar('Title Arabic');
        $show->description('Description');
        $show->description_ar('Description Arabic');
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

            $content->header('Setting');
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

            $content->header('Edit Setting');
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

            $content->header('Create New Setting');
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
        return Admin::grid(Setting::class, function (Grid $grid) {
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
            $grid->disableCreateButton();
            $grid->disableFilter();

            $grid->disableRowSelector();

            $grid->disableColumnSelector();

            $grid->disableTools();

            $grid->disableExport();


            $grid->id('ID')->sortable();
            $grid->title('Title');
            $grid->title_ar('Title Arabic');
            $grid->description()->display(function($description) {
                return str_limit($description, 30, '...');
            });                   
            $grid->description_ar()->display(function($description_ar) {
                return str_limit($description_ar, 30, '...');
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
        return Admin::form(Setting::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', 'Title')->rules('required');
            $form->text('title_ar', 'Title Arabic')->rules('required');
            $form->editor('description', 'Description')->rules('required');
            $form->editor('description_ar', 'Description Arabic')->rules('required');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
