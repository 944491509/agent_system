<?php


namespace App\Http\Controllers\Api\District;


use App\Dao\District\AreaStandDao;
use App\Dao\District\DepartmentDao;
use App\Dao\District\MajorDao;
use App\Dao\District\PostDao;
use App\Dao\District\TaskGroupDao;
use App\Http\Controllers\Api\Controller;
use App\Models\District\AreaStand;
use App\Models\District\Department;
use App\Models\District\Post;
use App\Models\InitialValue\ProfessionalClass;
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
     * 获取城市下的项目部
     * @param Request $request
     * @return mixed
     */
    public function getCityStand(Request $request)
    {
        $code = $request->get('q');
        $map = ['city_id' => $code];
        return AreaStand::where($map)->get();

    }

    /**
     * 获取所有项目部
     * @return \Illuminate\Http\JsonResponse|Response
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

    /**
     * 根据部门 获取 班组
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGroup(Request $request)
    {
        $id = $request->get('q');

        $dao = new TaskGroupDao;
        $data = $dao->getGroupByDepartmentId($id);

        return response()->json($data);
    }

    /**
     * 根据岗位 获取 专业
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMajor(Request $request)
    {
        $id = $request->get('q');
        $dao = new MajorDao;
        $data = $dao->getMajorByPostId($id);
        return response()->json($data);
    }

    /**
     * 专业的等级
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfessionalClasses(Request $request)
    {
        $id = $request->get('q');
        $data = ProfessionalClass::where('skill_id', $id)->get();
        return response()->json($data);
    }
}
