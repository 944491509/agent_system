<?php

namespace App\Admin\Controllers\Fault;

use App\Dao\District\AreaStandDao;
use App\Models\Fault\NetworkFaultSource;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class SourceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '故障来源';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NetworkFaultSource());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('stand.name', __('Stand'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new NetworkFaultSource());
        $areaStandDao  = new AreaStandDao;
        $stands = $areaStandDao->getAreaStandOption();
        $form->text('name', __('Name'))->required();
        $form->select('area_stand_id', __('Stand'))->options($stands)->required();

        return $form;
    }
}
