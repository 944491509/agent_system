<?php


namespace App\Http\Controllers\Api\District;


use App\Dao\District\AreaStandDao;
use App\Http\Controllers\Api\Controller;
use App\Models\District\AreaStand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AreaStandController extends Controller
{

    public function getParentStand(Request $request)
    {
        $code = $request->get('q');
        $map = ['province_id' => $code];
        $field = ['id', 'name as text'];
        return AreaStand::where($map)->select($field)->get();
    }

    /**
     * 获取所有项目部
     * @return Response
     */
    public function getAllAreaStand()
    {
        $dao = new AreaStandDao;
        $data = $dao->getAllAreaStand();
        $result = [];
        foreach ($data as $key => $val) {
            $result[] = [
                'id' => $val->id,
                'text' => $val->name
            ];
        }
        return response()->json($result);
    }
}
