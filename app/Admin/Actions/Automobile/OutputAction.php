<?php

namespace App\Admin\Actions\Automobile;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class OutputAction extends Action
{
    protected $selector = '.output-action';

    public function handle(Request $request)
    {


        return $this->response()->success('Success message...')->refresh();
    }

    public function html()
    {
        return <<<HTML
            <a href="/district/outputExcel" target="_blank"
            class="btn btn-sm btn-default output-action">下载模板</a>
HTML;
    }
}
