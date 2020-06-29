<?php


namespace App\Http\Controllers\Api\District;


use App\Dao\District\DepartmentDao;
use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    /**
     * @param Request $request
     * @return array
     */
    public function getDepartmentByStandId(Request $request) {
        $standId = $request->get('q');
        $dao = new DepartmentDao();
        return $dao->getDepartmentsByStandId($standId);
    }
}
