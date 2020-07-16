<?php


namespace App\Dao\Trouble;


use App\Models\Trouble\TroubleData;

class TroubleDataDao
{

    public function getTroubleDataByNetWork($id)
    {
        return TroubleData::where('p_id', $id)->get();
    }

}
