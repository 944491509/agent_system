<?php

namespace App\Admin\Controllers\District;

use App\Dao\ChinaAreaDao;
use App\Dao\District\FacilitatorDao;
use App\Models\District\AreaStand;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class AreaStandController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '项目部管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AreaStand());
        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('province.name', __('Province'));
        $grid->column('city.name', __('City'));
        $grid->column('district.name', __('District'));
        $grid->column('operator_text', __('Operator'))->display(function () {
            return $this->operatorText();
        });
        $grid->column('explain_text', __('Explain'))->display(function () {
            return $this->explainText();
        });
        $grid->column('remark', __('Remark'));
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

        $show = new Show(AreaStand::findOrFail($id));
        $areaStand = new AreaStand();
        $operator = $areaStand->getAllOperator();
        $explain = $areaStand->getAllExplain();
        $show->field('id', __('Id'));
        $show->field('province', __('Province'))->as(function ($content) {
            return $content->name;
        });
        $show->field('city', __('City'))->as(function ($content) {
            return $content->name;
        });
        $show->field('district', __('District'))->as(function ($content) {
            return $content->name;
        });

        $show->operator(__('Operator'))->using($operator);
        $show->explain(__('Explain'))->using($explain);
        $show->field('remark', __('Remark'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $areaStand = new AreaStand();
        $form = new Form($areaStand);
        $facilitatorDao = new FacilitatorDao();
        $facilitators = $facilitatorDao->facilitators();
        $level = $areaStand->getAllLevel();
        $explain = $areaStand->getAllExplain();
        $chinaAreaDao = new ChinaAreaDao();
        $province = $chinaAreaDao->areas();

        $form->text('name','项目部'.__('Name'));

        $form->select('level','项目部'.__('Level'))->options($level)
            ->when(AreaStand::PROVINCE_LEVEL,function (Form $form ) use($province) {
                $form->select('province_id', __('Province'))->options($province);
            })->when(AreaStand::CITY_LEVEL,function (Form $form ) use($province) {

            });

        $form->multipleSelect('operator', '运营商')->options($facilitators);
        $form->multipleSelect('explain', '区域说明')->options($explain);
        $form->textarea('remark', __('Remark'));
        return $form;
    }
}
