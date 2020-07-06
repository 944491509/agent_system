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
use App\Models\District\UserProfile;
use App\Models\InitialValue\ProfessionalClass;
use App\Models\InitialValue\ProfessionalSkill;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Tests\Models\Profile;


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

//        $grid->column('areaStand.', '维护地市');
        $grid->column('area_stand_id', '项目部')->display(function () {
            return $this->profile->areaStand->name;
        });
        $grid->column('profile.department.name', '部门')->display(function () {
            return $this->profile->department->name;
        });
        $grid->column('group_id', '班组')->display(function () {
            return $this->profile->group->name;
        });
        $grid->column('major_id', '专业')->display(function () {
            return $this->profile->major->name;
        });
        $grid->column('post_id', '岗位')->display(function () {
            return $this->profile->post->name;
        });
        $grid->column('name', '姓名');
        $grid->column('gender', '性别')->using([User::GENDER_MAN => '男', User::GENDER_WOMAN => '女']);
        $grid->column('mobile', '手机号1');
        $grid->column('phone', '手机号2');
        $grid->column('group_cornet', '集团短号');
        $grid->column('profile.education', '学历');
        $grid->column('updated_at', '生日');
        $grid->column('profile.id_number', '身份证号码');

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
        $skill = ProfessionalSkill::all()->pluck('name', 'id');

        if ($form->isCreating()) {

            $form->column(1 / 2, function ($form) {
                $form->text('name', '姓名')->required();
                $form->text('profile.number', '工号')->required();
                $form->radio('gender', '性别')->options([
                    User::GENDER_MAN => '男',
                    User::GENDER_WOMAN => '女'
                ])->default(User::GENDER_MAN)->required();
                $form->select('profile.education', '学历')->options(UserProfile::getAllEducation())->required();
                $form->mobile('mobile', '手机号1')->required();
                $form->mobile('phone', '手机号2');
                $form->text('group_cornet', '集团短号');
                $form->email('email', '邮箱');
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
            $form->tab('个人信息', function ($form) {
                $form->text('name', '姓名')->required();
                $form->text('profile.number', '工号')->required();
                $form->radio('gender', '性别')->options([
                    User::GENDER_MAN => '男',
                    User::GENDER_WOMAN => '女'
                ])->default(User::GENDER_MAN)->required();
                $form->select('profile.education', '学历')->options(UserProfile::getAllEducation())->required();
                $form->mobile('mobile', '手机号1')->required();
                $form->mobile('phone', '手机号2');
                $form->text('group_cornet', '集团短号');
                $form->email('email', '邮箱');
                $form->text('profile.address', '家庭住址');
                $form->text('profile.id_number', '身份证号')->required();
                $form->date('profile.entry_time', '入职日期')->format('YYYY-MM-DD')->required();
                $form->date('profile.signing_time', '签约日期')->format('YYYY-MM-DD');
                $form->date('profile.due_time', '合同到期日期')->format('YYYY-MM-DD');
                $form->text('profile.serial', '合同编号');
                $form->date('profile.departure_time', '离职日期')->format('YYYY-MM-DD');
                $form->radio('profile.status', '是否在职')->options(UserProfile::whether())->default(1)->required();

            })->tab('附加信息', function ($form) {
                $form->text('profile.pay_card', '工资卡号');
                $form->radio('profile.certificate', '代维资格证书')->options(UserProfile::whether())->default(0);
                $form->radio('profile.accommodation', '是否住宿')->options(UserProfile::whether())->default(0);
                $form->text('profile.dormitory_num', '宿舍号');
                $form->text('profile.card_num', '劳保编号');
                $form->date('profile.card_time', '劳保办理日期')->format('YYYY-MM-DD');
                $form->radio('profile.is_insurance', '是否缴纳意外保险')->options(UserProfile::whether())->default(0);
                $form->text('profile.insurance_company', '保险公司');
                $form->date('profile.insurance_time', '意外保险到期时间')->format('YYYY-MM-DD');
                $form->radio('profile.vehicle_card', '是否有车辆行驶证')->options(UserProfile::whether())->default(0);
                $form->date('profile.get_vehicle_card_time', '车辆行驶证初领时间')->format('YYYY-MM-DD');
                $form->text('profile.vehicle_model', '准假车型');
                $form->text('profile.vehicle_model', '驾照编号');
                $form->date('profile.vehicle_model', '驾照年审时间')->format('YYYY-MM-DD');
                $form->date('profile.vehicle_model', '下次驾照年审时间')->format('YYYY-MM-DD');
            })->tab('部门信息', function ($form) use ($area, $posts) {

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

                $form->textarea('profile.note', '备注')->rows(5);
            })->tab('专业技能', function ($form)use ($skill) {

                $form->select('user_major.major_id_one', '专业技能1')->options($skill)
                    ->load('user_major.major_level_one', '/api/stand/get-major-classes', 'id', 'name');

                $form->select('user_major.major_level_one', '专业技能1 级别')->options(function ($id) {
                    return ProfessionalClass::where('id', $id)->pluck('name', 'id');
                });

                $form->select('user_major.major_id_two', '专业技能2')->options($skill)
                    ->load('user_major.major_level_two', '/api/stand/get-major-classes', 'id', 'name');

                $form->select('user_major.major_level_two', '专业技能2 级别')->options(function ($id) {
                    return ProfessionalClass::where('id', $id)->pluck('name', 'id');
                });

                $form->select('user_major.major_id_three', '专业技能3')->options($skill)
                    ->load('user_major.major_level_three', '/api/stand/get-major-classes', 'id', 'name');

                $form->select('user_major.major_level_three', '专业技能3 级别')->options(function ($id) {
                    return ProfessionalClass::where('id', $id)->pluck('name', 'id');
                });

                $form->select('user_major.skill', '职业技能鉴定名称')->options([]);
                $form->select('user_major.skill_type', '职业技能鉴定类别')->options([]);
                $form->select('user_major.skill_level', '职业技能鉴定级别')->options([]);
                $form->text('user_major.skill_num', '职业技能鉴定编号');
                $form->date('user_major.skill_time', '职业技能鉴定时间')->format('YYYY-MM-DD');
            });
        }

        return $form;
    }


}
