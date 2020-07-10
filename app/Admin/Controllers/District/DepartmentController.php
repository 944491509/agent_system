<?php

namespace App\Admin\Controllers\District;

use App\Dao\District\AreaStandDao;
use App\Models\District\AreaStand;
use App\Models\District\Department;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DepartmentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '部门管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Department());
        $grid->disableFilter();

        $grid->quickSearch('name')->placeholder('搜索 部门名称');
        $grid->column('area_stand_id', '所属项目部')->display(function ($id) {
            return AreaStand::find($id)->name;
        });
        $grid->column('name','维护部门名称');
        $grid->column('rank', '等级');

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
        $show = new Show(Department::findOrFail($id));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Department());
        $areaStandDao  = new AreaStandDao;
        $data = $areaStandDao->getAllAreaStand();
        $areaStand = [];
        foreach ($data as $key => $val) {
            $areaStand[$val['id']] = $val['name'];
        }
        $form->select('area_stand_id', '所属项目部')->options($areaStand);
        $form->text('name', '维护部门名称')->required();
        $form->number('rank', '等级')->rules('required|min:0|integer')->default(0);

        return $form;
    }
}
