<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\customer;
use App\Models\governs;
use App\Models\place;
use Hash;

class CustomerController extends Controller
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
            ->header('Customers List')
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
            ->header('Customer Details')
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
            ->header('Edit Customer')
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
            ->header('Create New Customer')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new customer);

        $grid->id('ID');
        $grid->full_name('Full Name');
        $grid->email('Email');
        $grid->phone_number('Phone Number');
        $grid->image('Image')->image(url($path ='uploads'). "/", 100, 100);
        $grid->address('Address');
        $grid->govern()->name_en('State');
        $grid->place()->name_en('City');
        // $grid->zip_code('zip_code');
        // $grid->created_at('Created at');
        // $grid->updated_at('Updated at');
        // $grid->disableCreateButton();
        $grid->disableExport();

        $grid->actions(function ($actions) {
            // $actions->disableEdit();
        });



        $grid->filter(function ($filter) {

            //$filter->expand();
            $filter->useModal();


            $filter->column(1 / 2, function ($filter) {
                $filter->like('full_name', 'Name');
                $filter->like('phone_number', 'Phone Number');
            });
            $filter->column(1 / 2, function ($filter) {


                $filter->equal('state_id', 'State')->Select(governs::all()->pluck('name_en', 'id'))
                ->load('city_id', '/place', 'id', 'name_en');

                $filter->equal('city_id', 'City')->Select();
            });
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
        $show = new Show(customer::findOrFail($id));

        // $show->id('ID');
        $show->full_name('Full Name');
        $show->email('Email');
        $show->phone_number('Phone Number');
        $show->image('Image')->image(url($path ='uploads'). "/", 100, 100);
        $show->address('Address');
        $show->govern()->as(function ($govern) {
            return $govern['name_en'];
        });
;
        $show->place()->as(function ($place) {
            return $place['name_en'];
        });
        $show->zip_code('zip_code');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        $show->panel()
            ->tools(function ($tools) {
                // $tools->disableEdit();
                // $tools->disableList();
                // $tools->disableDelete();
            });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new customer);
        $form->text('full_name', 'Full Name')->rules('required');
        $form->text('email', 'E-mail')->rules(function ($form) {    // If it is not an edit state, add field unique verification
            // if (!$id = $form->model()->id) {
                return 'required|unique:customer,email,'.$form->model()->id.',id';
            // }
        });
        $form->text('address', 'Address')->rules('required');
        $form->mobile('phone_number', 'Phone Number')->rules(function ($form) {    // If it is not an edit state, add field unique verification
            // if (!$id = $form->model()->id) {
                return 'required|unique:customer,phone_number,'.$form->model()->id.',id';
            // }
        });
        $form->image('image','Image')->move('customer_image')->uniqueName();
        $form->select('state_id', 'State')->options(governs::all()->pluck('name_en', 'id'))->rules('required')
        ->load('city_id', '/place', 'id', 'name_en')->rules('required');
        $form->select('city_id', 'City')->options(function ($id) {
            $city = place::find($id);

            if ($city) {
                return [$city->id => $city->name_en];
            }
        })->rules('required');
        $form->password('password', 'Password')->rules('required');
        $form->text('zip_code', 'Zip Code');

        $form->saving(function (Form $form) {
            if($form->model()->password != $form->password && $form->model()->password != Hash::make($form->password) &&  $form->password  != trim('') ){
                $form->password = Hash::make($form->password) ;
                $form->model()->api_token = md5($form->password);
            }

        });

        return $form;
    }
}
