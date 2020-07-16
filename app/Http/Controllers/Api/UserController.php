<?php


namespace App\Http\Controllers\Api;

use App\Dao\District\UserProfileDao;
use App\Dao\Trouble\TroubleDataDao;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 根据项目部获取人员
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $id = $request->get('q');
        $dao = new UserProfileDao;
        $data = $dao->getAllPersonnelByStandId($id);
        $result = [];
        foreach ($data as $val) {
            $result[] = [
                'id' => $val->user_id,
                'name' => $val->user->name,
                'mobile' => $val->user->mobile
            ];
        }
        return response()->json($result);
    }

    /**
     * 网络类别
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function category(Request $request)
    {
        $id = $request->get('q');
        $dao = new TroubleDataDao;
        $result = $dao->getTroubleDataByNetWork($id);

        return response()->json($result);
    }
}
