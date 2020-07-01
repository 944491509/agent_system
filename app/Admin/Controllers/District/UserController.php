<?php

namespace App\Admin\Controllers\District;

use App\Models\District\User;
use Couchbase\Document;
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
        $form = new Form(new Document);

        // 第一列占据1/2的页面宽度
        $form->column(1 / 2, function ($form) {

            // 在这一列中加入表单项

            $form->text('title', __('Title'))->rules('min:10');

            $form->textarea('desc', __('Desc'))->required();

            $form->file('path', __('Path'))->required();
        });

        // 第二列占据右边1/2的页面宽度
        $form->column(1 / 2, function ($form) {
            $form->number('view_count', __('View count'))->default(0);

            $form->number('download_count', __('Download count'))->default(0);

            $form->number('rate', __('Rate'))->default(0);

            $form->datetimeRange('created_at', 'updated_at');
        });

        return $form;
    }
}
