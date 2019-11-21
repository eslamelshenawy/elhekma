<?php

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use App\Models\colors;
use App\Models\companies;
use App\Models\customFieldsItems;
use App\Models\pharmaceuticalForm;

use App\Models\products;
use App\Models\productsImages;
use App\Models\tagItem;
use App\Models\effectiveMaterial;
use App\Models\PharmaTag;
use Encore\Admin\Facades\Admin;

use App\Models\department;
use App\Models\categories;
use App\Models\targetAudience;
use App\Models\brands;
use App\Models\outlets;
use App\Models\customFields;
use App\Models\CompanyUsers;
use Illuminate\Http\Request;

class productController extends Controller
{
    public $department_id;
    public $category_id;
    public $pharma_tag1_id;
    public $pharma_tag2_id;
    use HasResourceActions;
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            if(isset($_GET['department_id']))
                $this->department_id = $_GET['department_id'];

            if(isset($_GET['category_id']))
                $this->category_id = $_GET['category_id'];

            if(isset($_GET['pharma_tag1_id']))
                $this->pharma_tag1_id = $_GET['pharma_tag1_id'];

            if(isset($_GET['pharma_tag2_id']))
                $this->pharma_tag2_id = $_GET['pharma_tag2_id'];


            $content->header('Products');
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

            $content->header('Edit Product');
            // $content->description(' ');

            // $product = products::find($id);
            // $brand = brands::find($product->brand_id)->select('name_en', 'id')->first();

            $content->body($this->formEdit()->edit($id));
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

            $content->header('Create New Product');
            // $content->description(' ');
            if (!Admin::user()->isAdministrator()) {
            $company_user = CompanyUsers::find(Admin::user()->id);
            $branch = $company_user->company->outlets;
                if (isset($branch)) {
                $content->body('<h1><b>please add branch for '.$company_user->company->name_en.'</b></h1><a class="btn btn-sm btn-info" href="../branchs"><i class="fa fa-plus"></i>&nbsp;&nbsp;ADD</a>');
                }
            }else{
            $content->body($this->form());
            }

        });
    }

    public function show($id, Content $content)
    {
        return $content
            ->header('Product Details')
            // ->description(' ')
            ->body($this->detail($id));
    }

    protected function detail($id)
    {
        $show = new Show(products::findOrFail($id));

        $show->id('ID');
        $show->name_en('Name English');
        $show->name_ar('Name Arabic');
        $show->desc_en('Description English');
        $show->desc_ar('Description Arabic');
        $show->price('Price');
        $show->product_code('Product Code');
        $show->bar_code('Bar Code');
        $show->pack_details('Pack Details');

        $show->company('company')->as(function ($company) {
            return $company['name_en'];
        });
        $show->department('Department')->as(function ($department) {
            return $department->name_en;
        });
        $show->category('category')->as(function ($category) {
            return $category->name_en;
        });

        $show->pharma_tag1('subcategory 1')->as(function ($pharma_tag1) {
            return $pharma_tag1['name_en'];
        });
        $show->pharma_tag2('subcategory 2')->as(function ($pharma_tag2) {
            return $pharma_tag2['name_en'];
        });
        $show->pharma_tag3('subcategory 3')->as(function ($pharma_tag3) {
            return $pharma_tag3['name_en'];
        });

        $show->brand('brand')->as(function ($brand) {
            return $brand->name_en;
        });
        $show->pharma_form('pharmaForm')->as(function ($pharma_form) {
            return $pharma_form['name_en'];
        });

        $show->target_audience('target Audience')->as(function ($target_audience) {
            return $target_audience['name_en'];
        });
        $show->color('Color')->as(function ($color) {
           $html='';
           $html= "{$color['name']}  <span style='background-color:  {$color['hex']}; color: {$color['hex']};' > Color </span>";
            return $html;
        })->unescape();

        $show->productdetails('Custom Field')->as(function ($customs) {
            $customs_id=[];
            for ($i=0; $i < count($customs) ; $i++) {
                $customs_id[]= $customs[$i];
            }
            $customs_id = array_map(function ($custom) {
               $custom_name = customFieldsItems::where('id',$custom['custom_field_item_id'])->get();
               foreach ($custom_name as $key => $value) {
                return  "<span class='label label-info' > {$value['name_en']} </span>";
               }

            }, $customs_id);

            return join('&nbsp', $customs_id);
        })->unescape();

        $show->productdetails2('Branches')->as(function ($branchs) {
            $branchs_id = [];
            for ($i=0; $i < count($branchs) ; $i++) {
                $branchs_id[]= $branchs[$i];
            }
            $branchs_id = array_map(function ($branch) {
               $branch_name = outlets::where('id',$branch['outlet_id'])->get();
               foreach ($branch_name as $key => $value) {
                   return  "<span class='label label-info' > {$value['name_en']} </span>";
               }

            }, $branchs_id);

            return join('&nbsp', $branchs_id);
        })->unescape();

        $show->product_effective_material('Active Ingredients')->as(function ($ingredients) {
            $data='';
            foreach ($ingredients as $key => $value) {
                $data  .= "<span class='label label-info' style= 'margin-right:5px;'> {$value['name_en']} </span>";
            }
            return $data;
        })->unescape();

        $show->product_images('Product Images')->as(function ($images) {
            $html='';
         if($images){
            $all []= $images['image'];
            foreach ($all as $key => $value) {

                for ($i=0; $i <count($value) ; $i++) {
                   $html .="<img src='../../../uploads/$value[$i]' style= 'margin-right:10px; max-height:160px; max-width:160px;'>";
                }
            }

            return $html;
        }else{
            return "No Images";
        }
        })->unescape();

        $show->created_at();
        $show->updated_at();
        return $show;
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(products::class, function (Grid $grid) {

            // $grid->id('ID')->sortable();
            if (!Admin::user()->isAdministrator()) {
                $grid->model()->where('company_id', '=', Admin::user()->company_id);
            }

            $grid->name_en('Name English')->sortable();
            // $grid->name_ar('Name Arabic')->sortable();
            // $grid->created_at();

            $grid->price('Price')->sortable();
            // $grid->company()->name_en('Company')->sortable();
            $grid->department()->name_en('Departmnet')->sortable();
            $grid->category()->name_en('Category')->sortable();
            // $grid->brand()->name_en('Brand')->sortable();
            $grid->pharma_form()->name_en('Pharma Form')->sortable();
            $grid->target_audience()->name_en('Target Audience')->sortable();

            // $grid->productdetails('Custom Field')->display(function ($customs) {

            //     $customs = array_map(function ($custom) {
            //        $custom_name = customFields::where('id',$custom['custom_field_item_id'])->get();
            //        foreach ($custom_name as $key => $value) {
            //            return "<span class='label label-success'>{$value['name_en']}</span>";
            //        }

            //     }, $customs);

            //     return join('&nbsp;', $customs);
            // });

            // $grid->productdetails('Branches')->display(function ($branchs) {


            //     $branchs = array_map(function ($branch) {
            //        $branch_name = outlets::where('id',$branch['outlet_id'])->get();
            //        foreach ($branch_name as $key => $value) {
            //            return "<span class='label label-primary'>{$value['name_en']}</span>";
            //        }

            //     }, $branchs);

            //     return join('&nbsp;', $branchs);
            // });

            /*$grid->productEffectiveMaterial('Active Ingredients')->display(function ($ingredients) {

                $ingredients = array_map(function ($ingredient) {
                   $ingredient_name = effectiveMaterial::where('id',$ingredient['effective_material_id'])->get();
                   foreach ($ingredient_name as $key => $value) {
                       return "<span class='label label-info'>{$value['name_en']}</span>";
                   }

                }, $ingredients);

                return join('&nbsp;', $ingredients);
            });*/

            // $grid->productEffectiveMaterial('Active Ingredients')->pluck('name_en')->label();

            /*$grid->color()->hex('Color')->display(function ($hex) {
                return "<span style='background-color: {$hex};color:{$hex}'>COLOR</span>";
            })->sortable();*/

            $grid->filter(function ($filter) {

                //$filter->expand();
                $filter->useModal();
                $filter->disableIdFilter();

                $filter->column(1 / 2, function ($filter) {
                    /* filtering by company if user is admin, else filtering by branch of company user */
                if (Admin::user()->isAdministrator()) {
                    $filter->equal('company_id', 'Company')->Select(companies::all()->pluck('name_en', 'id'));
                    }else{
                        $filter->where(function ($query) {
                            $query->whereHas('productdetails', function ($query) {
                                $query->where('outlet_id', '=', $this->input);
                            });
                        }, 'Outlet')->Select(outlets::where('company_id', '=', Admin::user()->id)->pluck('name_en', 'id'));

                    }
                    $filter->equal('department_id', 'Department')->Select(department::all()->pluck('name_en', 'id'))
                    ->load('category_id', '/category', 'id', 'name_en');

                    /*$filter->equal('category_id', 'Category')->Select(categories::where('department_id',$_GET['department_id'])->orderBy('name_en', 'asc')->pluck('name_en', 'id'))
                    ->load('pharma_tag1_id',  '/pharmaTag/1', 'id', 'name_en');*/

                    $filter->equal('category_id', 'Category')->Select(categories::where('department_id',$this->department_id)->orderBy('name_en', 'asc')->pluck('name_en', 'id'))
                        ->load('pharma_tag1_id',  '/pharmaTag/1', 'id', 'name_en');



                    $filter->equal('pharma_tag1_id', 'Subcategory1')->Select(PharmaTag::where([ ['category_id',$this->category_id] ,['parent_id' , '0' ]] )->orderBy('name_en', 'asc')->pluck('name_en', 'id'))
                    ->load('pharma_tag2_id',  '/pharmaTag/2', 'id', 'name_en');

                    $filter->equal('pharma_tag2_id', 'Subcategory2')->Select(PharmaTag::where('parent_id',$this->pharma_tag1_id)->orderBy('name_en', 'asc')->pluck('name_en', 'id'))
                    ->load('pharma_tag3_id',  '/pharmaTag/3', 'id', 'name_en');

                    $filter->equal('pharma_tag3_id', 'Subcategory3')->Select(PharmaTag::where('parent_id',$this->pharma_tag2_id)->orderBy('name_en', 'asc')->pluck('name_en', 'id'));

                    $filter->where(function ($query) {
                        $query->whereHas('productdetails', function ($query) {
                            $query->where('custom_field_item_id', '=', $this->input);
                        });
                    }, 'Custom Field')->Select(customFields::all()->pluck('name_en', 'id'));


                });

                $filter->column(1 / 2, function ($filter) {
                    $filter->like('name_en', 'Product Name');

                    $filter->equal('target_audience_id', 'target Audience')->Select(targetAudience::orderBy('name_en', 'asc')->pluck('name_en', 'id'));
                    $filter->equal('color_id', 'Color')->Select(colors::orderBy('name', 'asc')->pluck('name', 'id'));
                    $filter->equal('pharma_form_id', 'Pharma Form')->Select(pharmaceuticalForm::orderBy('name_en', 'asc')->pluck('name_en', 'id'));

                    $filter->in('brand_id', 'Brand')->multipleSelect(brands::orderBy('name_en', 'asc')->pluck('name_en', 'id'));

                    $filter->where(function ($query) {
                        $query->whereHas('product_effective_material', function ($query) {
                            $query->whereIn('effective_material_id', $this->input);
                        });
                    }, 'Active Ingredients')->multipleSelect(effectiveMaterial::all()->pluck('name_en', 'id'));

                });

               /* $filter->column(1 / 2, function ($filter) {
                    $filter->equal('department_id', 'Department')->Select(department::all()->pluck('name_en', 'id'));
                });*/

                /*$filter->column(1 / 2, function ($filter) {
                    $filter->equal('category_id', 'Category')->Select(categories::all()->pluck('name_en', 'id'));
                });*/

                /*$filter->column(1 / 2, function ($filter) {
                    $filter->where(function ($query) {
                        $query->whereHas('productdetails', function ($query) {
                            $query->where('custom_field_item_id', '=', $this->input);
                        });
                    }, 'Custom Field')->Select(customFields::all()->pluck('name_en', 'id'));
                });

                $filter->column(1 / 2, function ($filter) {
                    $filter->equal('target_audience_id', 'target Audience')->Select(targetAudience::all()->pluck('name_en', 'id'));
                });

                $filter->column(1 / 2, function ($filter) {
                    $filter->in('brand_id', 'Brand')->multipleSelect(brands::all()->pluck('name_en', 'id'));
                    $filter->where(function ($query) {
                        $query->whereHas('brand', function ($query) {
                            $query->where('name_en', 'like', '%'.$this->input.'%');
                        });
                    }, 'Brand Name');
                });


                $filter->column(1 / 2, function ($filter) {
                    $filter->equal('color_id', 'Color')->Select(colors::all()->pluck('name', 'id'));
                });
                $filter->column(1 / 2, function ($filter) {
                    $filter->where(function ($query) {
                        $query->whereHas('productEffectiveMaterial', function ($query) {
                            $query->whereIn('effective_material_id', $this->input);
                        });
                    }, 'Active Ingredients')->multipleSelect(effectiveMaterial::all()->pluck('name_en', 'id'));
                });

                $filter->column(1 / 2, function ($filter) {
                    $filter->equal('pharma_form_id', 'Pharma Form')->Select(pharmaceuticalForm::all()->pluck('name_en', 'id'));
                });
                */

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
        return Admin::form(products::class, function (Form $form) {

            $form->tab('Basic info', function ($form) {
               // $form->display('id', 'ID');

            if (Admin::user()->isAdministrator()) {
                $form->select('company_id', 'Company')->options(companies::all()->pluck('name_en', 'id'))->rules('required');
            }

                $form->text('name_en', 'Name English')->rules('required');
                $form->text('name_ar', 'Name Arabic');
                $form->text('desc_en', 'Description English')->rules('required');
                $form->text('desc_ar', 'Description Arabic');
                $form->text('pack_details', 'Pack Details')->rules('required');
                $form->image('photo','Main Image')->move('uploads/images')->uniqueName()->rules('required');
                $form->text('product_code', 'product code')->rules('required');
                $form->text('bar_code', 'bar code');
                $form->number('price_before', 'Price Before')->rules('required')->min(0)->default(0);
                $form->switch('is_offer', 'Is Offer');
                $form->number('price', 'Price')->rules('required')->min(0)->default(0);
                $form->switch('is_viewed', 'Show');
                $states = [
                    'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
                ];
                $form->switch('featured_pro', 'Featured Product')->states($states);

                $states = [
                    'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
                ];
                $form->switch('best_seller', 'Best Seller')->states($states);

                $states = [
                    'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
                ];
                $form->switch('new_arrival', 'New Arrival')->states($states);
               // $form->display('created_at', 'Created At');
               // $form->display('updated_at', 'Updated At');

            })->tab('Data', function ($form) {
                $form->select('department_id', 'Department')->options(department::all()->pluck('name_en', 'id'))->rules('required')
                    ->loads(['category_id', 'brand_id'], ['/category', '/brand'], 'id', 'name_en');

                $form->select('brand_id', 'Brand')->options()->rules('required');

                $form->select('category_id', 'Category')->options()->rules('required')
                    //->loads(['pharma_tag1_id', 'custom_field_item_id'], ['/category/pharma_tag/1', '/custom_field'], 'id', 'name_en');
                ->load('pharma_tag1_id',  '/pharmaTag/1', 'id', 'name_en');
                   // ->loads(['custom_field_item_id' , 'pharma_tag1_id'], ['/custom_field' , '/pharmaTag/1'], 'id', 'name_en');

                $form->select('pharma_tag1_id', 'Subcategory1')->options()->rules('required')
                    ->load('pharma_tag2_id', '/pharmaTag/2', 'id', 'name_en');

                $form->select('pharma_tag2_id', 'Subcategory2')->options()->rules('required')
                    ->load('pharma_tag3_id', '/pharmaTag/3', 'id', 'name_en');

                $form->select('pharma_tag3_id', 'Subcategory3')->options()->rules('required');
                //$form->multipleSelect('product_pharma_tag','Pharma Tag')->options(PharmaTag::all()->pluck('name_en', 'id'));

               // $form->select('pharma_tag1_id', 'Pharma Tags (subcategories)')->options(PharmaTag::all()->pluck('name_en', 'id'));


                $form->multipleSelect('products_tags')->options(tagItem::all()->pluck('name_en', 'id'));

                $form->select('target_audience_id', 'Target Audience')->options(targetAudience::all()->pluck('name_en', 'id'));
                //$form->select('color_id', 'Color')->options(colors::all()->pluck('name', 'id'));
                $form->select('pharma_form_id', 'Pharmaceutical Form')->options(pharmaceuticalForm::all()->pluck('name_en', 'id'));


                $form->multipleSelect('product_effective_material')->options(effectiveMaterial::all()->pluck('name_en', 'id'));


            })->tab('images', function ($form) {
                $form->multipleImage('product_images.image', 'Images')->move('uploads/images')->uniqueName()->rules('mimes:png,jpg')->removable()->sortable();

            })->tab('Product details', function ($form) {
                $form->hasMany('productdetails', function ($form) {

                    $form->select('outlet_id', 'outlet')->options(outlets::all()->pluck('name_en', 'id'))->rules('required');
                    $form->select('custom_field_item_id', 'custom_field_item')->options(customFieldsItems::all()->pluck('name_en', 'id'))->rules('required');
                    $form->number('quantity', 'Quantity')->min(0)->default(0);
                });
            });

        $form->saving(function (Form $form) {
            if (!Admin::user()->isAdministrator()) {
                $form->model()->company_id = Admin::user()->company_id ;
            }
        });

        });

    }

    protected function formEdit()
    {
        return Admin::form(products::class, function (Form $form) {

            $form->tab('Basic info', function ($form) {
                $form->display('id', 'ID');
            if (Admin::user()->isAdministrator()) {
                $form->select('company_id', 'Company')->options(companies::all()->pluck('name_en', 'id'));
            }
                $form->text('name_en', 'Name English')->rules('required');
                $form->text('name_ar', 'Name Arabic');
                $form->text('desc_en', 'Description English')->rules('required');
                $form->text('desc_ar', 'Description Arabic');
                $form->text('pack_details', 'Pack Details')->rules('required');
                $form->image('photo','Main Image')->move('uploads/images')->uniqueName();
                $form->text('product_code', 'product code');
                $form->text('bar_code', 'bar code');
                $form->number('price_before', 'Price Before')->rules('required')->min(0)->default(0);
                $form->switch('is_offer', 'Is Offer');
                $form->number('price', 'Price')->rules('required')->min(0)->default(0);
                $form->switch('is_viewed', 'Show');
                $states = [
                    'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
                ];
                $form->switch('featured_pro', 'Featured Product')->states($states);

                $states = [
                    'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
                ];
                $form->switch('best_seller', 'Best Seller')->states($states);

                $states = [
                    'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
                ];
                $form->switch('new_arrival', 'New Arrival')->states($states);

                $form->display('created_at', 'Created At');
                $form->display('updated_at', 'Updated At');


            })->tab('Data', function ($form) {
                $form->select('department_id', 'Department')->options(department::all()->pluck('name_en', 'id'))->rules('required')
                    ->loads(['category_id', 'brand_id'], ['/category', '/brand'], 'id', 'name_en');

                $form->select('brand_id', 'Brand')->options(function ($id) {
                    $brand = brands::find($id);

                    if ($brand) {
                        return [$brand->id => $brand->name_en];
                    }
                });
                $form->select('category_id', 'Category')->options(function ($id) {
                    $category = categories::find($id);

                    if ($category) {
                        return [$category->id => $category->name_en];
                    }
                })->rules('required')->load('pharma_tag1_id',  '/pharmaTag/1', 'id', 'name_en');

                $form->select('pharma_tag1_id', 'Subcategory1')->options(function ($id) {
                    $sub1_category = PharmaTag::find($id);

                    if ($sub1_category) {
                        return [$sub1_category->id => $sub1_category->name_en];
                    }
                })->rules('required')->load('pharma_tag2_id', '/pharmaTag/2', 'id', 'name_en');

                $form->select('pharma_tag2_id', 'Subcategory2')->options(function ($id) {
                    $sub2_category = PharmaTag::find($id);

                    if ($sub2_category) {
                        return [$sub2_category->id => $sub2_category->name_en];
                    }
                })->rules('required')->load('pharma_tag3_id', '/pharmaTag/3', 'id', 'name_en');

                $form->select('pharma_tag3_id', 'Subcategory3')->options(function ($id) {
                    $sub3_category = PharmaTag::find($id);

                    if ($sub3_category) {
                        return [$sub3_category->id => $sub3_category->name_en];
                    }
                })->rules('required');




                $form->multipleSelect('products_tags','Products Tag')->options(tagItem::all()->pluck('name_en', 'id'));

                $form->select('target_audience_id', 'Target Audience')->options(targetAudience::all()->pluck('name_en', 'id'));
                //$form->select('color_id', 'Color')->options(colors::all()->pluck('name', 'id'));
                $form->select('pharma_form_id', 'Pharmaceutical Form')->options(pharmaceuticalForm::all()->pluck('name_en', 'id'));
               // $form->multipleSelect('product_pharma_tag','Pharma Tag')->options(PharmaTag::all()->pluck('name_en', 'id'));

                $form->multipleSelect('product_effective_material')->options(effectiveMaterial::all()->pluck('name_en', 'id'));


            })->tab('images', function ($form) {
                $form->multipleImage('product_images.image', 'Images')->move('uploads/images')->uniqueName()->rules('mimes:png,jpg')->removable()->sortable();

            })->tab('Product details', function ($form) {
                $form->hasMany('productdetails', function ($form) {

                    $form->select('outlet_id', 'outlet')->options(outlets::all()->pluck('name_en', 'id'))->rules('required');
                    $form->select('custom_field_item_id', 'custom_field_item')->options(customFieldsItems::all()->pluck('name_en', 'id'));
                    $form->number('quantity', 'Quantity')->min(0)->default(0);
                });
            });

        });
    }
}
