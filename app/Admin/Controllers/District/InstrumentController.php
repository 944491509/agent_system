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

        $form->select('area_stand_id', '所属项目部')->options($area)->required();
        $form->text('name', '仪器名称')->required();
        $form->text('model', __('Model'))->required();
        $form->number('number', '数量')->default(1)->min(1);
        $form->text('unit', '维护仪器单位');
        $form->text('factory', '生产厂家');

        return $form;
    }
}
