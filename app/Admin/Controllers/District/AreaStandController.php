<?php

namespace App\Admin\Controllers\District;

use App\Dao\ChinaAreaDao;
use App\Dao\District\FacilitatorDao;
use App\Models\ChinaArea;
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
        $grid->column('name', '项目部'.__('Name'));
        $grid->column('level', '项目部'.__('Level'))->display(function () {
            return $this->levelText();
        });
        $grid->column('operator', '项目部'.__('Operator'))->display(function () {
            return $this->operatorText();
        });
        $grid->column('type', '项目部'.__('Type'))->display(function () {
            return $this->typeText();
        });
        $grid->column('explain', '项目部'.__('Explain'))->display(function () {
            return $this->explainText();
        }) ;
//        $grid->column('area_id', '项目部'.__('Area'));

        $grid->column('remark', __('Remark'));
        $grid->column('created_at', __('Created at'));
        $grid->actions(function ($actions) {
            // 去掉查看
            $actions->disableView();
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
//    protected function detail($id)
//    {
//
//        $show = new Show(AreaStand::findOrFail($id));
//        $areaStand = new AreaStand();
//        $explain = $areaStand->getAllExplain();
//        $show->field('id', __('Id'));
//        $show->explain(__('Explain'))->using($explain);
//        $show->field('remark', __('Remark'));
//        return $show;
//    }

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
        $types = $areaStand->getAllType();
        $form->text('name','项目部'.__('Name'));


        $form->select('level','项目部'.__('Level'))->options($level)
            ->when(AreaStand::PROVINCE_LEVEL,function (Form $form )  {
                $form->select('province_id', __('Province'))
                    ->options(
                        ChinaArea::where('parent_id', ChinaArea::CHINA)->pluck('name', 'code') // 回显
                    );
            })->when(AreaStand::CITY_LEVEL,function (Form $form) {

                $form->select('province_id', __('Province'))
                    ->options(
                        ChinaArea::where('parent_id', ChinaArea::CHINA)->pluck( 'name', 'code') // 回显
                    )->loads(['city_id','parent_id'],['/api/area/get-areas','api/stand/get-parent-stand']);

                $form->select('city_id', __('City'))->options(function ($id) {
                        return ChinaArea::where('id', $id)->pluck('name', 'code'); // 回显
                    });
//                $form->select('parent_id','上级项目部')->options(function ($id) {
//                    dump($id);
//                });

            })->when(AreaStand::DISTRICT_LEVEL,function (Form $form) {
                $form->select('province_id', __('Province'))
                    ->options(
                        ChinaArea::where('parent_id', ChinaArea::CHINA)->pluck( 'name', 'code') // 回显
                    )->load('city_id','/api/area/get-areas');

                $form->select('city_id', __('City'))->options(function ($id) {
                    return ChinaArea::where('id', $id)->pluck('name', 'code'); // 回显
                })->load('district_id','/api/area/get-areas');

                $form->select('district_id', __('District'))->options(function ($id) {
                    return ChinaArea::where('id', $id)->pluck('name', 'code'); // 回显
                });

            });

        $form->multipleSelect('type', '项目部'.__('Type'))->options($types);
        $form->multipleSelect('operator', '项目部'.__('Operator'))->options($facilitators);
        $form->multipleSelect('explain', '项目部'.__('Explain'))->options($explain);
        $form->textarea('remark', '项目部'.__('Remark'));
        return $form;
    }
}
