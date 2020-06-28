<?php


namespace App\Http\Controllers\Api\District;


use App\Http\Controllers\Api\Controller;
use App\Models\District\AreaStand;
use Illuminate\Http\Request;

class AreaStandController extends Controller
{

    public function getParentStand(Request $request) {
        $code = $request->get('q');
        $map = ['province_id' => $code];
        $field = ['id', 'name as text'];
        return AreaStand::where($map)->select($field)->get();
    }
}
