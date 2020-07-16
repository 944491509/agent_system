<?php


namespace App\Http\Controllers\Api\Fault;


use App\Dao\Fault\SourceDao;
use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

class SourceController extends Controller
{

    public function getSourceByStandId(Request $request) {
        $standId = $request->get('q');
        $dao = new SourceDao();
        $result = $dao->getSourcesByAreaStandId($standId);
        return response()->json($result);
    }
}
