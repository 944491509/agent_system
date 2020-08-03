<?php

namespace App\Admin\Controllers;

use Admin;
use App\Dao\Admin\AdminRoleUserDao;
use App\Dao\District\AreaStandDao;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $userId = Admin::user()->getAuthIdentifier();

        $dao = new AdminRoleUserDao;
        $areaDao = new AreaStandDao;
        $userRole = $dao->getUserRoleByUserId($userId);
        $data = [];
        if ($userRole == 1) {
            $data = $areaDao->getAllAreaStand();
        }

        return view("index", ["data" => $data]);
    }

    public function setIndex(Request $request)
    {
        session(['area_id' => $request->get('area_id')]);
        redirect()->to('home');
    }


    public function home(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Description.....')
            ->row(Dashboard::title())
            ->row(function (Row $row) {
                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
    }

}
