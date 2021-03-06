<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServerThresholdParamNames extends Model
{
    protected $table = 'server_threshold_param_names';

    public $param_name = "";
    public $param_num = 0;
    public $param_label = "";

    public function get()
    {
        $paramNames = DB::table($this->table)
            ->select('*')
            ->orderBy('param_num', 'asc')
            ->get();

        return $paramNames;
    }
}
