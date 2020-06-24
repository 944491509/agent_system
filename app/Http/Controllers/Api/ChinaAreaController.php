<?php


namespace App\Http\Controllers\Api;

use App\Dao\ChinaAreaDao;
use \Illuminate\Http\Request;

class ChinaAreaController extends Controller
{
    public function getAreas(Request $request) {
        $id = $request->get('q');
        $chinaAreaDao = new ChinaAreaDao();
        $result = $chinaAreaDao->getArea($id);
        return $result;
    }

}
