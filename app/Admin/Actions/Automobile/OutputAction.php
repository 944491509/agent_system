<?php

namespace App\Admin\Actions\Automobile;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class OutputAction extends Action
{
    protected $selector = '.output-action';

    public $num;

    public function __construct($num)
    {
        parent::__construct();
        $this->num = $num;
    }


    public function handle(Request $request)
    {
        return $this->response()->success('Success message...')->refresh();
    }

    public function html()
    {

        if ($this->num == 1) {
            $str = <<<HTML
            <a href="/district/outputExcel" target="_blank"
            class="btn btn-sm btn-default output-action">下载模板</a>
HTML;
        } elseif ($this->num == 2) {
            $str = <<<HTML
            <a href="/district/outputExcel" target="_blank"
            class="btn btn-sm btn-default output-action">下载模板222</a>
HTML;
        }

        return $str;
    }
}
