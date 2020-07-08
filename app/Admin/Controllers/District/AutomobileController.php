<?php

namespace App\Admin\Controllers\District;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Models\District\User;
use App\Dao\District\AreaStandDao;
use App\Models\District\AreaStand;
use App\Models\District\Automobile;
use Encore\Admin\Controllers\AdminController;

class AutomobileController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '维护车辆';

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
        $grid->column('type', __('Type'))->display(function () {
            return $this->typeText();
        });
        $grid->column('bought_company', __('Bought company'));
        $grid->column('car_owner', __('Car owner'));
        $grid->column('city.name', __('City'));
        $grid->column('stand.name', __('Stand'));
        $grid->column('driver.name', __('Driver'));
        $grid->column('nature', __('Nature'))->display(function () {
            return $this->natureText();
        });
        $grid->column('use', __('Use'))->display(function () {
            return $this->useText();
        });
        $grid->column('bought_at', __('Bought at'));
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
        $automobile = new Automobile();
        $areaStandDao = new AreaStandDao();
        $area = $areaStandDao->getAreaStandCity();
        $nature = $automobile->allNature();
        $use= $automobile->allUse();
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
        $form->currency('price', '购买'.__('Price'))->symbol('￥');
        $form->text('oil_wear', __('Oil wear'));
        $form->text('engine_num', __('Engine num'));
        $form->text('vin', __('Vin'));
        $form->text('loads', __('Loads'));
        $form->select('city_id', __('City'))->options($area)
            ->load('stand_id','/api/stand/get-city-stand','id', 'name');
        $form->select('stand_id', __('Stand'))->options(function ($id) {
            return AreaStand::where('id', $id)->pluck('name', 'id'); // 回显
        })->load('user_id', '/api/stand/get-driver-stand', 'id', 'name');
        $form->select('user_id', __('Driver'))->options(function ($id) {
            return User::where('id', $id)->pluck('name', 'id'); // 回显
        });
        $form->select('nature', __('Nature'))->options($nature);
        $form->select('use', __('Use'))->options($use);
        $form->date('bought_at', __('Bought at'))->default(date('Y-m-d'));

        return $form;
    }
}
