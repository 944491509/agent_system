<?php

namespace App\Admin\Controllers\Trouble;

use App\Dao\District\AreaStandDao;
use App\Models\District\User;
use App\Models\Trouble\TroubleForm;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TroubleFormController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '网络隐患申报';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TroubleForm());

        $grid->column('id', __('Id'));
        $grid->column('area_stand_id', __('Area stand id'));
        $grid->column('network_type', __('Network type'));
        $grid->column('category', __('Category'));
        $grid->column('network_name', __('Network name'));
        $grid->column('name', __('Name'));
        $grid->column('position', __('Position'));
        $grid->column('distance', __('Distance'));
        $grid->column('reason', __('Reason'));
        $grid->column('unit', __('Unit'));
        $grid->column('person', __('Person'));
        $grid->column('mobile', __('Mobile'));
        $grid->column('influence', __('Influence'));
        $grid->column('deal_with', __('Deal with'));
        $grid->column('suggest', __('Suggest'));
        $grid->column('status', __('Status'));
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
        $show = new Show(TroubleForm::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('area_stand_id', __('Area stand id'));
        $show->field('network_type', __('Network type'));
        $show->field('category', __('Category'));
        $show->field('network_name', __('Network name'));
        $show->field('name', __('Name'));
        $show->field('position', __('Position'));
        $show->field('distance', __('Distance'));
        $show->field('reason', __('Reason'));
        $show->field('unit', __('Unit'));
        $show->field('person', __('Person'));
        $show->field('mobile', __('Mobile'));
        $show->field('influence', __('Influence'));
        $show->field('deal_with', __('Deal with'));
        $show->field('suggest', __('Suggest'));
        $show->field('status', __('Status'));
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
        $form = new Form(new TroubleForm());

        $dao = new AreaStandDao;
        $areaDao = $dao->getAllAreaStand();
        $area = $areaDao->pluck('name', 'id');

        $form->select('profile.area_stand_id', '所属项目部')
            ->options($area)->load('user_id', '/api/trouble/get-personnel', 'id', 'name')
            ->required();
        $form->select('user_id', '隐患申报人员')->options(function ($id) {
            return User::where('id', $id)->pluck('name', 'id');
        })->required();

        $form->select('network_type', '网络类型')->options(TroubleForm::getAllNetworkType())
            ->load('category', '/api/trouble/get-category', 'id', 'name')
            ->required();

        $form->select('category', '网络专业类别')->options(function ($key) {

//            return TroubleForm::getNetWorkMajor($key)[0];
        })->required();
        $form->text('network_name', '网络专业名称')->required();

        $form->text('name', '业务名称')->required();
        $form->text('position', '隐患地点')->required();
        $form->text('distance', '至机房距离')->required();
        $form->text('reason', '隐患原因')->required();
        $form->text('unit', '外力施工单位')->required();
        $form->text('person', '施工联系人')->required();
        $form->mobile('mobile', '施工单位电话')->required();
        $form->switch('influence', '隐患影响等级')->required();
        $form->switch('deal_with', '隐患处理等级')->required();
        $form->switch('suggest', '建议处理方式')->required();
        $form->switch('status', '状态')->required();

        return $form;
    }
}
