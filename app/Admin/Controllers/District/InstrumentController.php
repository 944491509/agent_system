<?php

namespace App\Admin\Controllers\District;

use App\Models\District\Instrument;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InstrumentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Instrument';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Instrument());

        $grid->column('id', __('Id'));
        $grid->column('area_stand_id', __('Area stand id'));
        $grid->column('name', __('Name'));
        $grid->column('model', __('Model'));
        $grid->column('number', __('Number'));
        $grid->column('unit', __('Unit'));
        $grid->column('factory', __('Factory'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Instrument::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('area_stand_id', __('Area stand id'));
        $show->field('name', __('Name'));
        $show->field('model', __('Model'));
        $show->field('number', __('Number'));
        $show->field('unit', __('Unit'));
        $show->field('factory', __('Factory'));
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
        $form = new Form(new Instrument());

        $form->number('area_stand_id', __('Area stand id'));
        $form->text('name', __('Name'));
        $form->text('model', __('Model'));
        $form->number('number', __('Number'))->default(1);
        $form->text('unit', __('Unit'));
        $form->text('factory', __('Factory'));

        return $form;
    }
}
