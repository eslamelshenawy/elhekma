<?php

namespace App\Admin\Controllers;

use App\Models\Orders;
use App\Models\outlets;
use App\Models\Prescription;
use App\Http\Controllers\Controller;
use App\Models\products;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use URL;
use Encore\Admin\Widgets\Box;
use \Symfony\Component\HttpFoundation\Request;

class PrescriptionController extends Controller
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
        $form = $this->addProductsForm()->edit($id);
        $box = new Box('Prescreption is currently pending, add products to make an order', $form->render());
        $box->collapsable();
        $box->solid();

        $model = Prescription::find($id);
        if($model && $model->status == Prescription::STATUS_PENDING){
            return $content
                ->header('Detail')
                ->description('description')
                ->body($this->detail($id))
                ->row($box);
        }else{
            return $content
                ->header('Detail')
                ->description('description')
                ->body($this->detail($id));
        }


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
        $grid = new Grid(new Prescription);
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableEdit();
        });

        $grid->model()->orderBy('created_at', 'desc');
        $grid->id('Id')->sortable();
        $status = [
            0 => 'Pending',
            1 => 'Ordered',
            2 => 'Rejected',
            3 => 'Cancelled'
        ];
        $grid->status('Status')->editable('select',$status)->sortable();
        $grid->column('Full name')->display(function () {
            return $this->first_name . ' ' . $this->last_name;
        });
        $grid->column('Location')->display(function () {
            return $this->govern->name_en . ' - ' . $this->place->name_en;
        });

        $grid->column('Image')->display(function () {
            return "<a target='_blank' href='".urldecode(URL::to('/uploads',$this->image))."'><img style='max-width:100px;max-height:100px;' src='".urldecode(URL::to('/uploads',$this->image))."'></a>";
        });

        $grid->created_at('Created at')->sortable();


        $grid->filter(function($filter){
            $filter->equal('status','Status')->select([
                Prescription::STATUS_PENDING => 'Pending',
                Prescription::STATUS_ORDERED => 'Ordered',
                Prescription::STATUS_REJECTED => 'Rejected',
                Prescription::STATUS_CANCELLED => 'Cancelled',
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
        $prescription = Prescription::findOrFail($id);
        $show = new Show($prescription);

        $show->id('Id');
        $show->customer_id('Customer id');
        $show->status('Status')->as(function($content) use($prescription){
            return $prescription->getStatus();
        });
        $show->govern_id('Location')->as(function($value) use ($prescription){
            return $prescription->govern->name_en." - ".$prescription->place->name_en;
        });
        $show->first_name('First name');
        $show->last_name('Last name');
        $show->address('Address');
        $show->email('Email');
        $show->phone_number('Phone number');
        $show->image('Image')->image();
        $show->image('Image')->unescape()->as(function($content){
            $url = urldecode(URL::to('/uploads',$content));
            $html = '<a target="_blank" href="'.$url.'"><img src="'.$url.'" style="max-width:100px;max-height:100px;"></a>';
            return $html;
        });
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->deleted_at('Deleted at');

        $show->panel()->tools(function ($tools) {
             $tools->disableEdit();
             $tools->disableDelete();
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
        $form = new Form(new Prescription);

        $form->number('customer_id', 'Customer id');
        $form->number('status', 'Status');
        $form->text('first_name', 'First name');
        $form->text('last_name', 'Last name');
        $form->text('address', 'Address');
        $form->email('email', 'Email');
        $form->text('phone_number', 'Phone number');
        $form->image('image', 'Image');

        return $form;
    }


    protected function addProductsForm()
    {
        $form = new Form(new Prescription);
        $form->setTitle('Add');

        $form->disableEditingCheck();
        $form->disableCreatingCheck();
        $form->disableViewCheck();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
            $tools->disableList();
        });

//        $form->select('product_id', 'Product')->options($medicineData)->default(0)->rules('required');
//        $form->number('quantity')->rules('required');

        //
//        $form->hasMany('products', function (Form\NestedForm $form) use ($medicineData) {
//            $form->select('id', 'Product')->options($medicineData)->rules('required');
//            $form->number('quantity')->rules('required');
//        });
//
//        $form->submitted(function (Form $form) {
//            echo '<pre>';var_dump($form);
//            exit;
//        });

        $form->setView('admin.form');

        return $form;
    }


    public function loadProducts(){
        $medicineData = products::where('is_viewed',0)->orderBy('name_en','ASC')->select(['id','name_en'])->get();
        return response()->json($medicineData);
    }

    public function checkOutlets(Request $request){
        $prescription = Prescription::find($request->input('prescription_id'));
        $item = [];
        $item['product_id'] = $request->input('product_id');
        $item['quantity'] = $request->input('quantity');
        $product = products::find($item['product_id']);
        $item['product_name'] = $product->name_en;

        $cart = [$item['product_id'] => $item];

        $location = [];
        $location['govern_id'] = $prescription->govern_id;
        $location['place_id'] = $prescription->place_id;

        list($outlets, $outlets_status) = Orders::findOutlets(null, $cart, $location);

        return response()->json($outlets_status);
    }

    public function order(Request $request){
        if($request->input('data') && $request->input('prescription_id')){
            $data = $request->input('data');
            $data = json_decode($data);
            $cart = [];
            foreach($data as $item){
                $product = products::find($item->product_id);
                $item = $product->formatCartItem(intval($item->quantity));
                if(!array_key_exists($item['product_id'], $cart)){
                    $cart[$item['product_id']] = $item;
                }
            }

            $prescription = Prescription::find($request->input('prescription_id'));
            if(!$prescription || $prescription->status != Prescription::STATUS_PENDING){
                return response()->json(['status'=>false]);
            }

            $inputs = [
                'customer_id' => $prescription->customer_id,
                'full_name' => $prescription->first_name." ".$prescription->last_name,
                'email' => $prescription->email,
                'phone' => $prescription->phone_number,
                'address' => $prescription->address,
                'govern' => $prescription->govern_id,
                'place' => $prescription->place_id,
                'payment-method' => 3,
                'prescription_id' => $prescription->id
            ];
            //create order & delivery address & qr code
            $order = Orders::createOrder($inputs, $cart);
            if(!$order){
                return response()->json(['status'=>false]);
            }

            $location = [
                'govern_id' => $prescription->govern_id,
                'place_id'  => $prescription->place_id
            ];
            list($outlets, $outlets_status) = orders::findOutlets(null, $cart, $location);

            try{
                $error = false;
                //add order details
                $order->createDetails($outlets, $cart);
            }catch (\Throwable $e){
                //delete order and everything related
                $order->rollBack();
                $error = true;
            }
            if($error){
                return response()->json(['status'=>false]);
            }

            //log status change
            $order->logStatusChange();

            $prescription->status = Prescription::STATUS_ORDERED;
            $prescription->save();

            return response()->json(['status'=>true]);
        }
    }

}
