<?php

namespace App\Admin\Controllers\District;

use App\Models\District\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '维护人员管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', '维护地市');
        $grid->column('name', '项目部名称');
        $grid->column('email', '部门名称');
        $grid->column('email_verified_at', '班组名称');
        $grid->column('password', '姓名');
        $grid->column('remember_token', '性别');
        $grid->column('created_at', '岗位');
        $grid->column('updated_at', '专业');
        $grid->column('updated_at', '手机号1');
        $grid->column('updated_at', '手机号2');
        $grid->column('updated_at', '集团短号');
        $grid->column('updated_at', '学历');
        $grid->column('updated_at', '生日');
        $grid->column('updated_at', '身份证号码');

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));

        return $form;
    }
}
