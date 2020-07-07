<?php

namespace App\Admin\Controllers\District;

use App\Dao\District\AreaStandDao;
use App\Models\ChinaArea;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\District\Automobile;
use Encore\Admin\Controllers\AdminController;

class AutomobileController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Automobile';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Automobile());
        $grid->column('id', __('Id'));
        $grid->column('number', __('Number'));
        $grid->column('explain', __('Explain'));
        $grid->column('type', __('Type'));
        $grid->column('manufacturers', __('Manufacturers'));
        $grid->column('model', __('Model'));
        $grid->column('displacement', __('Displacement'));
        $grid->column('bought_company', __('Bought company'));
        $grid->column('car_owner', __('Car owner'));
        $grid->column('price', __('Price'));
        $grid->column('oil_wear', __('Oil wear'));
        $grid->column('engine_num', __('Engine num'));
        $grid->column('vin', __('Vin'));
        $grid->column('loads', __('Load'));
        $grid->column('city_id', __('City id'));
        $grid->column('stand_id', __('Stand id'));
        $grid->column('user_id', __('User id'));
        $grid->column('nature', __('Nature'));
        $grid->column('use', __('Use'));
        $grid->column('bought_at', __('Bought at'));
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
        $automobile = new Automobile();
        $areaStandDao = new AreaStandDao();
        $area = $areaStandDao->getAreaStandCity();
        $form = new Form($automobile);
        $type = $automobile->allCatType();
        $form->text('number', __('Number'));
        $form->textarea('explain', '车辆'.__('Explain'));
        $form->select('type', __('Type'))->options($type);
        $form->text('manufacturers', __('Manufacturers'));
        $form->text('model', '车辆'.__('Model'));
        $form->text('displacement', __('Displacement'));
        $form->text('bought_company', __('Bought company'));
        $form->text('car_owner', __('Car owner'));
        $form->decimal('price', '购买'.__('Price'));
        $form->text('oil_wear', __('Oil wear'));
        $form->text('engine_num', __('Engine num'));
        $form->text('vin', __('Vin'));
        $form->text('loads', __('Loads'));
        $form->select('city_id', __('City'))->options($area)->load('stand_id','/api/stand/get-city-stand');;
        $form->select('stand_id', __('Stand'))->options(function ($id) {
            return ChinaArea::where('id', $id)->pluck('name', 'code'); // 回显
        });
        $form->number('user_id', '驾驶员');
        $form->switch('nature', __('Nature'));
        $form->switch('use', __('Use'));
        $form->date('bought_at', __('Bought at'))->default(date('Y-m-d'));

        return $form;
    }
}
