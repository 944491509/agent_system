<?php

namespace App\Admin\Controllers\District;

use App\Dao\ChinaAreaDao;
use App\Dao\District\FacilitatorDao;
use App\Models\ChinaArea;
use App\Models\District\AreaStand;
use DemeterChain\A;
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
        $areaStand = new AreaStand();
        $grid = new Grid(new AreaStand());
        $grid->filter(function($filter) use($areaStand) {

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->column(1/2, function ($filter) use ($areaStand){
                $filter->like('name', '项目部'.__('Name'));
                $filter->like('explain', '项目部'.__('Explain'))->select($areaStand->getAllExplain());
                $filter->distpicker('province_id', 'city_id', 'district_id','项目部区域');
            });

            $filter->column(1/2, function ($filter) use ($areaStand){
                $filter->equal('level','项目部'.__('Level'))->select($areaStand->getAllLevel());
                $filter->like('type','项目部'.__('Type'))->select($areaStand->getAllType());
            });



        });
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

        $grid->column('remark', __('Remark'));
        $grid->column('created_at', __('Created at'));
        $grid->actions(function ($actions) {
            // 去掉查看
            $actions->disableView();
        });
        return $grid;
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
                    )->load('city_id','/api/area/get-areas');

                $form->select('city_id', __('City'))->options(function ($id) {
                        return ChinaArea::where('id', $id)->pluck('name', 'code'); // 回显
                    });

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
