<?php

namespace App\Admin\Controllers\District;

use App\Dao\District\AreaStandDao;
use App\Models\District\Department;
use App\Models\District\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '维护岗位';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('areaStand.name', __('Stand'));
        $grid->column('department.name', __('Department'));
        $grid->column('name', __('Name'));
        $grid->column('explain', __('Explain'));
        $grid->column('require', __('Require'));
        $grid->column('level', __('Level'));
        $grid->column('belong_to', __('BelongTo'))->display(function () {
            return $this->belongToText();
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->actions(function ($actions) {
            $actions->disableView(); // 去掉查看
            $actions->disableDelete(); // todo 暂时关闭删除 删除逻辑后需要修改
        });

        return $grid;
    }



    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $post = new Post();
        $form = new Form($post);
        $areaStandDao = new AreaStandDao();
        $stands = $areaStandDao->getAreaStandOption();
        $belongTo = $post->getAllBelongTo();

        $form->select('stand_id', __('Stand'))->options($stands)
            ->load('department_id','/api/stand/get-departments','id', 'name')->required();
        $form->select('department_id', __('Department'))->options(function ($id) {
            return Department::where('id', $id)->pluck('name', 'id');
        })->required();
        $form->text('name', __('Name'))->required();
        $form->textarea('explain', __('Explain'));
        $form->textarea('require', __('Require'));
        $form->number('level', __('Level'))->default(1)->required();
        $form->multipleSelect('belong_to', __('BelongTo'))->options($belongTo)->required();
        // 关闭详情和删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });
        return $form;
    }
}
