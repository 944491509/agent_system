<?php

namespace App\Imports\Automobile;

use App\Dao\District\AutomobileDao;
use App\Models\District\Automobile;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\HeadingRowImport;

class ImportAutomobile implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        // TODO 验证标题行
//        $headings = (new HeadingRowImport)->toArray();
//
        $dao = new AutomobileDao();
        return $dao->addExcel($row);

    }


    /**
     * 从第几行开始处理数据 就是不处理标题
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
