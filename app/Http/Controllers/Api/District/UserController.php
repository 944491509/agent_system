<?php


namespace App\Http\Controllers\Api\District;

use App\Dao\District\UserDao;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class UserController extends Controller
{

    /**
     * 获取司机
     * @param Request $request
     * @return mixed
     */
    public function getDriverByStandId(Request $request) {
        $standId = $request->get('q');
        $userDao = new UserDao();
        return $userDao->getDriverByStandId($standId);
    }

}
