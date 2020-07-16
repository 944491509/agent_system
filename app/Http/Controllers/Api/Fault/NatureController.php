<?php


namespace App\Http\Controllers\Api\Fault;


use App\Dao\Fault\NatureDao;
use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

class NatureController extends Controller
{

    /**
     * 根据故障来源查询性质
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNatureBySourceId(Request $request) {
        $sourceId = $request->get('q');
        $dao = new NatureDao();
        $result = $dao->getNatureBySourceId($sourceId);
        return response()->json($result);
    }


    /**
     * 根据性质id查询时限
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTimesByNatureId(Request $request) {
        $natureId = $request->get('q');
        $dao = new NatureDao();
        $result = $dao->getTimesByNatureId($natureId);
        return response()->json($result);
    }
}
