<?php

namespace App\Admin\Controllers\Fault;

use App\Dao\District\AreaStandDao;
use App\Models\Fault\NetworkFaultNature;
use App\Models\Fault\NetworkFaultSource;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NatureController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '故障性质';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NetworkFaultNature());

        $grid->column('id', __('Id'));
        $grid->column('source.name', '故障'.__('Source'));
        $grid->column('name', __('Name'));
        $grid->column('times',__('Times'))->display(function ($class) {
            $res = array_map(function ($class) {
                return "<span class='label label-success'>{$class['hour']}小时</span>";
            }, $class);

            return join(' ', $res);
        });
        $grid->column('created_at', __('Created at'));

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new NetworkFaultNature());
        $areaStandDao  = new AreaStandDao;
        $stands = $areaStandDao->getAreaStandOption();
        $form->select('area_stand_id', __('Stand'))->options($stands)
            ->load('source_id','/api/fault/getSourceByStandId', 'id', 'name');
        $form->select('source_id', '故障'.__('Source'))->options(function ($id) {
            return NetworkFaultSource::where('id', $id)->pluck('name', 'id'); // 回显
        });
        $form->text('name', '性质'.__('Name'));
        $form->hasMany('times',__('Times'), function (Form\NestedForm $form) {
            $form->number('hour', __('Hour'));
        });

        return $form;
    }
}
