<?php

namespace App\Admin\Controllers;

use App\Models\companies;
use Encore\Admin\Show;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Models\department;
use App\Models\CompanyUsers;
use App\Admin\Extensions\CheckRow;
use Illuminate\Support\MessageBag;

class companyControllers extends Controller
{
    use ModelForm;
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
            ->header('Company Details')
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
        $show = new Show(companies::findOrFail($id));

        $show->logo('Company Logo')->image(url($path ='uploads'). "/", 100, 100);
        $show->name_en('Company Name E');
        $show->name_ar('Company Name A');
        $show->email('E-mail');
        /*$show->phone('Phone');
        $show->address('Address');
        $show->num_available_accounts('Available Accounts');
        $show->num_available_departments('Available Departments');
        $show->latitude('lat');
        $show->longitude('long');
        $show->active_status('Active Status')->as(function ($account) {
            $html='';
            if($account == 0){
                $html= "<span class='label label-success' > True </span>";
                return $html;
            }else{
                $html= "<span class='label label-danger' >False </span>";
                return $html;
            }

         })->unescape();

         $show->block_status('Block Status')->as(function ($account) {
            $html='';
            if($account == 0){
                $html= "<span class='label label-success' > True </span>";
                return $html;
            }else{
                $html= "<span class='label label-danger' >False</span>";
                return $html;
            }

         })->unescape();
        $show->facebook('Facebook Page');
        $show->youtube('Youtube Channel');
        $show->twitter('Twitter Page');
        $show->website('Website Url');
        $show->departments('Departments')->as(function ($departments) {
            $data='';
            foreach ($departments as $key => $value) {
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

            $content->header('Companies');
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

            $content->header('Edit Company');
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

            $content->header('Create New Company');
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
        return Admin::grid(companies::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name_en('Name English')->sortable();
            $grid->name_ar('Name Arabic')->sortable();
            $grid->email('E-mail');
         //   $grid->phone('Phone')->sortable();
            $grid->logo('Logo')->image(url($path ='uploads'). "/", 100, 100);
            /*$grid->departments()->display(function ($departments) {

                    $departments = array_map(function ($department) {
                        return "<span class='label label-success'>{$department['name_en']}</span>";
                    }, $departments);

                    return join('&nbsp;', $departments);
                });*/
           $grid->actions(function ($actions) {
        // $actions->getKey();
           // $actions->append(new CheckRow($actions->getKey()));
});


// $grid->outlets(function($outlet,$id){
//     $outlet->append("<a href='outlets/create' class='btn btn-default'> create</a>");
// });

            // $grid->created_at();
            // $grid->updated_at();
            $grid->filter(function($filter){
                $filter->useModal();
                    $filter->like('name_en', 'Name English');
                    $filter->like('name_ar', 'Name Arabic');
              //      $filter->equal('active_status', 'Active Status')->radio([0 => 'Active',1 => 'Not Active']);
                //    $filter->equal('block_status', 'Block Status')->radio([0 => 'Blocked',1 => 'Un Blocked']);

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
        return Admin::form(companies::class, function (Form $form) {

            $form->image('logo', 'Add Logo')->uniqueName()->placeholder('Add Logo');
            $form->text('name_en', 'Company Name E')->rules('required');
            $form->text('name_ar', 'Company Name A')->rules('required');
            $form->email('email', 'Company Email')->rules('required');
          //  $form->text('address', 'Address')->rules('required');
          //  $form->mobile('phone', 'Phone')->rules('required');
           // $form->text('latitude', 'Lat');
           // $form->text('longitude', 'Long');
            // $form->map("latitude","longitude","Select Location")->rules('required')->useGoogleMap();
          //  $form->number('num_available_accounts', 'Available Accounts')->rules('required')->min(0)->default(0);
          //  $form->number('num_available_departments', 'Available Departments')->rules('required')->min(0)->default(0);
          /*  $states = [
                'on'  => ['value' => 0, 'text' => 'True', 'color' => 'success'],
                'off' => ['value' => 1, 'text' => 'False', 'color' => 'danger'],
            ];
            $form->switch('active_status', 'Active Status')->states($states);

            $states = [
                'on'  => ['value' => 0, 'text' => 'True', 'color' => 'success'],
                'off' => ['value' => 1, 'text' => 'False', 'color' => 'danger'],
            ];
            $form->switch('block_status', 'Block Status')->states($states);*/

         /*   $form->url('facebook', 'Facebook Page');
            $form->url('youtube', 'Youtube Channel');
            $form->url('twitter', 'Twitter Page');
            $form->url('website', 'Website Url');
            $form->multipleSelect('departments')->options(department::all()->pluck('name_en', 'id'));
        $form->saving(function (Form $form) {
            // dd($form->num_available_departments);
            $countDepartment = count($form->departments) - 1;
            $num_departments = intval($form->num_available_departments);
            if($num_departments < $countDepartment){
                $error = new MessageBag([
                    'title'   => 'Accounts limte',
                    'message' => 'Check Count of Avilable Departments',
                ]);

                return back()->with(compact('error'));
            }
        });*/

        });
    }
}
