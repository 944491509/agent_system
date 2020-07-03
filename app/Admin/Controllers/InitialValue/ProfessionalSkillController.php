<?php

namespace App\Admin\Controllers\InitialValue;

use App\Models\InitialValue\ProfessionalSkill;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use function foo\func;

class ProfessionalSkillController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '专业技能';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProfessionalSkill());
        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('classes',__('professionalClasses'))->display(function ($class) {
                $res = array_map(function ($class) {
                    return "<span class='label label-success'>{$class['name']}</span>";
                }, $class);

                return join(' ', $res);
        });

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
        $show = new Show(ProfessionalSkill::findOrFail($id));

        $show->field('id', __('Id'));
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
        $form = new Form(new ProfessionalSkill());
        $form->text('name', '技能'.__('Name'));
        $form->hasMany('classes',__('professionalClasses'), function (Form\NestedForm $form) {
            $form->text('name', __('Name'));
        });

        // 关闭详情和删除按钮
        $form->tools(function (Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });
        return $form;
    }



}
