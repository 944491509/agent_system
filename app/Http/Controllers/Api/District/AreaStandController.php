<?php


namespace App\Http\Controllers\Api\District;


use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

class AreaStandController extends Controller
{

    public function getParentStand(Request $request) {
        $code = $request->get('q');
        dd($code);
    }
}
