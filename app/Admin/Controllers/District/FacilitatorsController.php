<?php

namespace App\Admin\Controllers\District;

use App\Models\District\Facilitators;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FacilitatorsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '服务商';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Facilitators());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('status_text', __('Status'))->display(function () {
            return $this->statusText();
        });

        $grid->column('created_at', __('Created at'));
        $grid->actions(function ($actions) {
            // 去掉查看
            $actions->disableView();
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
        $show = new Show(Facilitators::findOrFail($id));
        $model = new Facilitators();
        $status = $model->getAllStatus();
        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->status(__('Status'))->using($status);
        $show->field('created_at', __('Created at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Facilitators());

        $form->text('name', __('Name'));
        $form->switch('status', __('Status'))->default(1);

        return $form;
    }
}
