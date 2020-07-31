<?php

namespace App\Admin\Controllers\District;

use App\Dao\District\AreaStandDao;
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
    protected $title = '仪器管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Instrument());
        $grid->disableFilter(); // 去掉筛选
        $grid->quickSearch('name')->placeholder('搜索 仪器名称');
        $grid->column('area_stand_id', '项目部')->display(function () {
            return $this->areaStand->name;
        });

        $grid->column('name', '仪器名称');
        $grid->column('model', '型号');
        $grid->column('number', '数量');
        $grid->column('unit', '仪器单位');
        $grid->column('factory', '生产厂家');
        $grid->column('serial_number', '资产序列号');
        $grid->column('attributes', '资产属性')->using(Instrument::buyAttribute());
        $grid->column('purchase_time', '购买时间');

        $grid->column('money', '购买金额')->display(function () {
            if (empty($this->money)) {
                return '0 元';
            } else {
                return $this->money . '  元';
            }
        });
        $grid->column('tag', '标签');
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
        $dao = new AreaStandDao;
        $areaDao = $dao->getAllAreaStand();
        $area = $areaDao->pluck('name', 'id');

        $form->column(1 / 2, function ($form) use ($area) {
            $form->select('area_stand_id', '所属项目部')->options($area)->required();
            $form->text('name', '仪器名称')->required();
            $form->text('model', '仪器型号')->required();
            $form->number('number', '购买数量')->default(1)->min(1);
            $form->text('unit', '维护仪器单位');
            $form->text('factory', '生产厂家');
        });
        $form->column(1 / 2, function ($form) use ($area) {
            $form->text('serial_number', '资产序列号')->required();
            $form->radio('attributes', '资产属性')->options(Instrument::buyAttribute())->default(Instrument::PURCHASE)
                ->when('in', [Instrument::PURCHASE, Instrument::TAKEOVER], function (Form $form) {
                    $form->currency('money', '购买金额')->symbol('￥');
                    $form->date('purchase_time', '购买时间');
                })->when(Instrument::LEASE, function (Form $form) {
                    $form->currency('money', '租赁价格')->symbol('￥');
                    $form->date('purchase_time', '租赁起始时间');
                })->required();

            $form->text('tag', '资产标签')->required();
            $form->multipleImage('images', '资产图片')
                ->pathColumn('path')
                ->move('instrument')
                ->help('上传多张图片 请在选择图片时按住 ctrl ')
                ->removable();
        });
        return $form;
    }
}
