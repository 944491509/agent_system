<?php

namespace App\Admin\Controllers\District;

use App\Dao\District\AreaStandDao;
use App\Models\District\Department;
use App\Models\District\TaskGroup;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TaskGroupController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '班组';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TaskGroup());

        $grid->column('id', __('Id'));
        $grid->column('areaStand.name', __('Stand'));
        $grid->column('department.name', __('Department'));
        $grid->column('name', '班组'.__('Name'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->actions(function ($actions) {
            $actions->disableView(); // 去掉查看
            $actions->disableDelete(); // todo 暂时关闭删除 删除逻辑后需要修改
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
        $show = new Show(TaskGroup::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('stand_id', __('Stand id'));
        $show->field('department_id', __('Department id'));
        $show->field('name', __('Name'));
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
        $taskGroup = new TaskGroup();
        $form = new Form($taskGroup);
        $areaStandDao = new AreaStandDao();
        $stands = $areaStandDao->getAreaStandOption();

        $form->select('stand_id', __('Stand'))->options($stands)
            ->load('department_id',
                '/api/stand/get-departments','id',
                'name')->required();

        $form->select('department_id', __('Department'))->options(function ($id) {
            return Department::where('id', $id)->pluck('name', 'id');
        })->required();
        $form->text('name', '班组'.__('Name'))->required();

        // 关闭详情和删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        return $form;
    }
}
