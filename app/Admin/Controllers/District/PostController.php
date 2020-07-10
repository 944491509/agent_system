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
    protected $title = '岗位管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('name', '岗位' . __('Name'));
        $grid->column('explain', __('Explain'));
        $grid->column('require', __('Require'));
        $grid->column('level', __('Level'));
        $grid->column('belong_to', __('BelongTo'))->display(function () {
            return $this->belongToText();
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->disableFilter(); // 去掉筛选

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
        $belongTo = $post->getAllBelongTo();

        $form->text('name', __('Name'))->required();
        $form->multipleSelect('belong_to', __('BelongTo'))->options($belongTo)->required();
        $form->textarea('require', __('Require'));
        $form->textarea('explain', __('Explain'));
        $form->number('level', __('Level'))->default(1)->required();
        return $form;
    }
}
