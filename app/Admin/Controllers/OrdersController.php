<?php

namespace App\Admin\Controllers;

use App\Models\Orders;
use App\Models\companies;
use App\Models\OrderStatus;
use App\Models\OrderStatusLog;
use App\Models\outlets;
use App\Models\products;
use App\Http\Controllers\Controller;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Facades\Admin as AdminUser;
use URL;

class OrdersController extends Controller
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
            ->header('Orders')
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

        $model = Orders::findOrFail($id);

        $logs = $model->orderStatusLog()->orderBy('created_at', 'DESC')->get();
        $logs_data = [];
        foreach($logs as $log){
            $logs_data[] = [
                'admin' => $log->admin ? $log->admin->username : '',
                'customer'=> $log->customer ? $log->customer->full_name : '',
                'status'=> $log->status->title,
                'created_at' => $log->created_at
            ];
        }
        $table =  (new Table(['Admin', 'Customer', 'Status', 'Time'], $logs_data));
        $box = new Box('Order Status change log', $table->render());
        $box->collapsable();
        $box->solid();

        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id))
            ->row($box);
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
        $grid = new Grid(new Orders);
        $grid->model()->orderBy('id', 'desc');
        $grid->disableCreateButton();
        $grid->disableExport();
         $grid->actions(function ($actions) {
            $actions->disableEdit();
        });
        $user_brnach_id = AdminUser::user()->branch_id;
       // dd(AdminUser::user()->isRole('company'));
        if (AdminUser::user()->isRole('Branch')) {
            $grid->disableActions();    
            $grid->disableColumnSelector();
            $grid->model()->where(function ($query) {
                    $query->whereHas('orderDetails', function ($query){
                        // logger($this->input);
                        $query->where('outlet_id', '=', AdminUser::user()->branch_id);
                    });
                });
        }
        $grid->id('Order ID')->sortable();
        $grid->customer()->full_name('Full Name');
        $grid->column('Details')->expand(function ($model) {
            $tables = '';
            if (!empty($model->orderDetails()->get())) {
                $order_data =[];
                $orders = $model->orderDetails;

                foreach ($orders as $order) {
                    $order_data[] = [
                        'product_id' => products::find($order['product_id'])->name_en ,
                        'price'  => $order['price'],
                        'quantity' => $order['quantity'],
                        'sub_total' => $order['sub_total'],
                        'branch' => $order->outlet->place->name_en,
                        'created_at' => $order['created_at']
                    ];
                }
                $tables .=  (new Table(['Product','Price','Quantity','Sub total','Branch', 'Created At'], $order_data))->render();
            }

            $address = $model->deliveryAddress;
            $address_data = [];
            $address_data[] = [
                'name'=>$address->first_name." ".$address->last_name,
                'email'=>$address->email,
                'phone'=>$address->phone_number,
                'address'=>$address->address
            ];
            $tables .=  (new Table(['Name', 'Email', 'Phone', 'Address'], $address_data))->render();

            return $tables;
        });

        $grid->total('Total');
        $grid->order_status()->editable('select', OrderStatus::all()->pluck('title', 'id'));
//        $grid->paymnet_id('Payment');
        $grid->qr_code_img('QrCode')->image(url($path ='uploads'). "/", 100, 100);
//        $grid->payment_status('Payment Status');
//        $grid->gateway_response('Gateway Response');
        $grid->created_at('Created at')->sortable();

        $grid->filter(function ($filter) {

            $filter->useModal();
            $filter->disableIdFilter();

            $filter->equal('company_id', 'Company')->Select(companies::all()->pluck('name_en', 'id'))
                ->load('orderDetails', '/branch', 'id', 'name_en');

            $filter->where(function ($query) {
                $query->whereHas('orderDetails', function ($query) {
                    // logger($this->input);
                    $query->where('outlet_id', '=', $this->input);
                });
            }, 'Outlet')->Select(outlets::orderBy('name_en', 'asc')->pluck('name_en', 'id'));

            $filter->equal('order_status','Order Status')->select([
                1=>'Pending',
                2=>'Preparing',
                3=>'Shipped',
                4=>'Partially delivered',
                5=>'Completely delivered',
                6=>'User cancelled'
            ]);

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
        $model = Orders::findOrFail($id);

        $show = new Show($model);

        $show->id('ID');
        if($model->prescription_id){
            $show->prescription_id('Prescription')->unescape()->as(function($content) use($model){
                $url = urldecode(URL::to('/uploads',$model->prescription->image));
                $html = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="max-width:100px;max-height:100px;"></a>';
                return $html;
            });
        }
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
        $form = new Form(new Orders);

        $form->display('ID');

        $form->select('order_status', 'Status')->options(OrderStatus::all()->pluck('title', 'id'))->rules('required');

        $form->display('Created at');
        $form->display('Updated at');

        $form->saving(function (Form $form) {
            if ($form->order_status && $form->model()->order_status != $form->order_status) {
                //log admin changed status
                $form->model()->order_status = $form->order_status;
                $form->model()->logStatusChange('admin', \Encore\Admin\Facades\Admin::user()->id);
            }
        });

        return $form;
    }
}
