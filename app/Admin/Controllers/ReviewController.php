<?php

namespace App\Admin\Controllers;

use App\Models\Review;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\products;
use App\Models\customer;
class ReviewController extends Controller
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
        $grid = new Grid(new Review);
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        $grid->id('ID');
        $grid->product()->name_en('Product');
        $grid->customer()->full_name('Customer');
        $grid->review('Comment');
        $grid->rating('Rating');
        $grid->is_approved('Approved')->using([0 => 'Not Approved', 1 => 'Approved']);;
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
        $show = new Show(Review::findOrFail($id));

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
        $form = new Form(new Review);

        // $form->display('ID');

        $form->select('product_id', 'Product')->options(function ($id) {
            $product = products::find($id);

            if ($product) {
                return [$product->id => $product->name_en];
            }
        })->rules('required');  
        $form->select('customer_id', 'Customer')->options(function ($id) {
            $customer = customer::find($id);

            if ($customer) {
                return [$customer->id => $customer->full_name];
            }
        })->rules('required');  
        $form->display('review');
        $form->display('rating');
        $states = [
            'on'  => ['value' => 1, 'text' => 'Approve', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'Not Approve', 'color' => 'danger'],
        ];

        $form->switch('is_approved','Is Approve')->states($states);        
        // $form->is_approved
        // $form->display('Created at');
        // $form->display('Updated at');

        return $form;
    }
}
