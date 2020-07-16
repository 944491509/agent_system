<?php

namespace App\Admin\Controllers\Trouble;

use App\Dao\District\AreaStandDao;
use App\Models\District\User;
use App\Models\Trouble\TroubleData;
use App\Models\Trouble\TroubleForm;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
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

        $grid->column('area_stand_id', '项目部')->display(function () {
            return $this->stand->name;
        });
        $grid->column('user_id', '隐患申报人员')->display(function () {
            return $this->user->name;
        });
        $grid->column('network_type', '网络类型')->display(function () {
            return $this->type->name;
        });
        $grid->column('category', '网络专业类别')->display(function () {
            return $this->network_category->name;
        });
        $grid->column('network_name', '网络专业名称')->display(function () {
            return $this->network->name;
        });
        $grid->column('name', '业务名称');
        $grid->column('position', '隐患地点');
        $grid->column('distance', '距离');
        $grid->column('reason', '隐患原因');
        $grid->column('unit', '施工单位');
        $grid->column('person', '施工联系人');
        $grid->column('mobile', '施工单位电话');
        $grid->column('influence', '隐患影响等级');
        $grid->column('deal_with', '隐患处理等级');
        $grid->column('suggest', '建议处理方式');
        $grid->column('status', '状态')->using([
            TroubleData::STATUS_1 => '暂存',
            TroubleData::STATUS_2 => '已提交'
        ]);
        $grid->column('created_at', __('Created at'));

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

        $form->select('area_stand_id', '所属项目部')
            ->options($area)
            ->load('user_id', '/api/trouble/get-personnel', 'id', 'name')
            ->required();

        $form->select('user_id', '隐患申报人员')->options(function ($id) {
            return User::where('id', $id)->pluck('name', 'id');
        })->required();

        $form->select('network_type', '网络类型')->options(function () {
            return TroubleData::where('p_id', 0)->pluck('name', 'id');
        })->load('category', '/api/trouble/get-category', 'id', 'name')->required();

        $form->select('category', '网络专业类别')->options(function ($id) {
            return TroubleData::where('id', $id)->pluck('name', 'id');
        })->load('network_name', '/api/trouble/get-category', 'id', 'name')->required();

        $form->select('network_name', '网络专业名称')->options(function ($id) {
            return TroubleData::where('id', $id)->pluck('name', 'id');
        })->required();

        $form->text('name', '业务名称')->required();
        $form->text('position', '隐患地点')->required();
        $form->text('distance', '至机房距离')->required();
        $form->text('reason', '隐患原因')->required();
        $form->text('unit', '外力施工单位')->required();
        $form->text('person', '施工联系人')->required();
        $form->mobile('mobile', '施工单位电话')->required();
        $form->select('influence', '隐患影响等级')->options(TroubleData::getAllImpactLevel())->required();
        $form->select('deal_with', '隐患处理等级')->options(TroubleData::getAllDealWith())->required();
        $form->select('suggest', '建议处理方式')->options(TroubleData::getAllSuggest())->required();
        $form->radio('status', '状态')->options([
            TroubleData::STATUS_1 => '暂存',
            TroubleData::STATUS_2 => '提交'
        ])->help('注意: 提交给管理员后不可以修改')->default(TroubleData::STATUS_1)->required();

        return $form;
    }
}
