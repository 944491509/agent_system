<?php

namespace App\Imports\Automobile;

use App\Models\District\Automobile;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportAutomobile implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd($row);
        return new Automobile([
            //
        ]);
    }
}
