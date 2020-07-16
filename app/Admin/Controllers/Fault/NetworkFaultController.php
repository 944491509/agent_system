<?php

namespace App\Admin\Controllers\Fault;

use App\Dao\District\AreaStandDao;
use App\Models\Fault\NetworkFault;
use App\Models\Fault\NetworkFaultNature;
use App\Models\Fault\NetworkFaultSource;
use App\Models\Fault\NetworkFaultTime;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NetworkFaultController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '故障';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new NetworkFault());

        $grid->column('id', __('Id'));
        $grid->column('stand.name', __('Stand'));
        $grid->column('source.name', __('Source'));
        $grid->column('nature.name', __('Nature'));
        $grid->column('time.hour', __('Times'));
        $grid->column('kind', __('Kind'))->display(function () {
            return $this->kindText();
        });
        $grid->column('happen_time', __('HappenTime'));
        $grid->column('accept_time', __('AcceptTime'));
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
        $model = new NetworkFault();
        $form = new Form($model);
        $kinds = $model->allKind();
        $areaStandDao  = new AreaStandDao;
        $stands = $areaStandDao->getAreaStandOption();
        $form->select('area_stand_id', __('Stand'))->options($stands)
            ->load('source_id','/api/fault/getSourceByStandId', 'id', 'name');
        $form->select('source_id', __('Source'))->options(function ($id) {
            return NetworkFaultSource::where('id', $id)->pluck('name', 'id'); // 回显
        })->load('nature_id', '/api/fault/getNatureBySourceId', 'id', 'name');
        $form->select('nature_id', '故障'.__('Nature'))->options(function ($id) {
            return NetworkFaultNature::where('id', $id)->pluck('name', 'id'); // 回显
        })->load('time_id', '/api/fault/getTimesByNatureId', 'id', 'hour');

        $form->select('time_id', __('Times'))->options(function ($id) {
            return NetworkFaultTime::where('id', $id)->pluck('hour', 'id');
        });
        $form->select('kind', __('Kind'))->options($kinds);
        $form->date('happen_time', __('HappenTime'))->default(date('Y-m-d'));
        $form->datetime('accept_time', __('AcceptTime'))->default(date('Y-m-d H:i:s'));
        $form->textarea('business', '故障'.__('Business'));
        $form->textarea('message', '故障'.__('Message'));

        return $form;
    }
}
