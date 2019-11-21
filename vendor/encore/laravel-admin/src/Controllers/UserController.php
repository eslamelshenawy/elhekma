<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Routing\Controller;
use App\Models\companies;
use App\Models\outlets;
use Encore\Admin\Facades\Admin;
use App\Models\CompanyUsers;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header(trans('admin.administrator'))
            ->description(trans('admin.list'))
            ->body($this->grid()->render());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header(trans('admin.administrator'))
            ->description(trans('admin.detail'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param $id
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header(trans('admin.administrator'))
            ->description(trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header(trans('admin.administrator'))
            ->description(trans('admin.create'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $userModel = config('admin.database.users_model');

        $grid = new Grid(new $userModel());
        if (!Admin::user()->isAdministrator()) {
            $grid->model()->where('company_id', '=', Admin::user()->company_id);
        }
        $grid->id('ID')->sortable();
        $grid->username(trans('admin.username'));
        $grid->name(trans('admin.name'));
        $grid->roles(trans('admin.roles'))->pluck('name')->label();
        $grid->created_at(trans('admin.created_at'));
        $grid->updated_at(trans('admin.updated_at'));

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if ($actions->getKey() == 1) {
                $actions->disableDelete();
            }
        });

        $grid->tools(function (Grid\Tools $tools) {
            $tools->batch(function (Grid\Tools\BatchActions $actions) {
                $actions->disableDelete();
            });
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        $userModel = config('admin.database.users_model');

        $show = new Show($userModel::findOrFail($id));

        $show->id('ID');
        $show->username(trans('admin.username'));
        $show->name(trans('admin.name'));
        $show->roles(trans('admin.roles'))->as(function ($roles) {
            return $roles->pluck('name');
        })->label();
        $show->permissions(trans('admin.permissions'))->as(function ($permission) {
            return $permission->pluck('name');
        })->label();
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        $userModel = config('admin.database.users_model');
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');

        $form = new Form(new $userModel());

        $form->display('id', 'ID');

        if (request()->isMethod('POST')) {
            $userTable = config('admin.database.users_table');
            $userNameRules = "required|unique:{$userTable}";
        } else {
            $userNameRules = 'required';
        }

        $form->text('username', trans('admin.username'))->rules($userNameRules);
        if (Admin::user()->isRole('company')) {
            $form->hidden('company_id')->value(Admin::user()->company_id);
            $form->multipleSelect('roles', trans('admin.roles'))->options($roleModel::where('id', '>', 1)->pluck('name', 'id'));
            $form->select('branch_id', 'Branch')->options(outlets::where('company_id', Admin::user()->company_id)->pluck('name_en', 'id'))->rules('required_if:roles.0,3',['required_if' => 'Branch Required']);
        } else if (Admin::user()->isAdministrator()) {
            $form->multipleSelect('roles', trans('admin.roles'))->options($roleModel::all()->pluck('name', 'id'));

            $form->select('company_id', 'Company')->options(companies::all()->pluck('name_en', 'id'))
                ->load('branch_id', '/branch', 'id', 'name_en')->rules('required_if:roles.0,2|required_if:roles.0,3',['required_if' => 'Company Required']);

            $form->select('branch_id', 'Branch')->options(outlets::all()->pluck('name_en', 'id'))->rules('required_if:roles.0,3',['required_if' => 'Branch Required']);
        }

        $form->text('name', trans('admin.name'))->rules('required');
        $form->image('avatar', trans('admin.avatar'));
        $form->password('password', trans('admin.password'))->rules('required|confirmed');
        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });

        $form->ignore(['password_confirmation']);

        //$form->multipleSelect('permissions', trans('admin.permissions'))->options($permissionModel::all()->pluck('name', 'id'));

        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
            if (!empty($form->company_id)) {
                $company = companies::find($form->company_id);
                $countCompanyUser = CompanyUsers::where('company_id',$form->company_id)->count();

                if($company->num_available_accounts <= $countCompanyUser){
                    $error = new MessageBag([
                        'title'   => 'Accounts limte',
                        'message' => 'Check Count of Avilable Accounts',
                    ]);

                    return back()->with(compact('error'));                
                }
            }

        });

        return $form;
    }
}
