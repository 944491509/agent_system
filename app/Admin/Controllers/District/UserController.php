<?php

namespace App\Admin\Controllers\District;

use App\Dao\District\AreaStandDao;
use App\Dao\District\MajorDao;
use App\Dao\District\PostDao;
use App\Models\ChinaArea;
use App\Models\District\Department;
use App\Models\District\Major;
use App\Models\District\Post;
use App\Models\District\TaskGroup;
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

        $dao = new AreaStandDao;
        $areaDao = $dao->getAllAreaStand();
        $area = $areaDao->pluck('name', 'id');

        $postDao = new postDao;
        $postData = $postDao->getAllPost();
        $posts = [];
        foreach ($postData as $val) {
            $posts[$val->id] = $val->name;
        }
        if ($form->isCreating()) {

            $form->column(1 / 2, function ($form) {
                $form->text('name', '姓名')->required();
                $form->text('profile.number', '工号')->required();
                $form->radio('gender', '性别')->options([
                    User::GENDER_MAN => '男',
                    User::GENDER_WOMAN => '女'
                ])->default(User::GENDER_MAN)->required();
                $form->select('profile.education', '学历')->options(['学历'])->required();
                $form->mobile('mobile', '手机号1')->required();
                $form->mobile('phone', '手机号2');
                $form->text('group_cornet', '集团短号');
                $form->email('profile.email', '邮箱');
                $form->text('profile.address', '家庭住址');
                $form->text('profile.id_number', '身份证号')->required();
            });

            $form->column(1 / 2, function ($form) use ($area, $posts) {

                $form->select('profile.area_stand_id', '所属项目部')->options(function () use ($area) {
                    return $area;
                })->load('profile.department_id', '/api/stand/get-departments', 'id', 'name')->required();

                $form->select('profile.department_id', '维护部门')->options(function ($id) {
                    return Department::where('id', $id)->pluck('name', 'id');
                })->load('profile.group_id', '/api/stand/get-group', 'id', 'name')->required();

                $form->select('profile.group_id', '维护班组')->options(function ($id) {
                    return TaskGroup::where('id', $id)->pluck('name', 'id');
                })->required();

                $form->select('profile.post_id', '维护岗位')->options($posts)->load('profile.major_id', '/api/stand/get-major', 'id', 'name')->required();

                $form->select('profile.major_id', '维护专业')->options(function ($id) {
                    return Major::where('id', $id)->pluck('name', 'id');
                })->required();

                $form->date('profile.entry_time', '入职日期')->format('YYYY-MM-DD')->required();
                $form->date('profile.signing_time', '签约日期')->format('YYYY-MM-DD');
                $form->date('profile.due_time', '合同到期日期')->format('YYYY-MM-DD');
                $form->text('profile.serial', '合同编号');
                $form->textarea('profile.note', '备注')->rows(5);
            });
        }

        if ($form->isEditing()) {
            $form->tab('技能信息', function ($form) {
                $form->text('company')->required();
                $form->date('start_date');
                $form->date('end_date');
            })->tab('附加信息', function ($form) {
                $form->text('company');
                $form->date('start_date');
                $form->date('end_date');
            });
        }


        return $form;
    }


}
