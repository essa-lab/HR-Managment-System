<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\LogMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogsController extends BaseController
{
    public function showLog($date){
        $LogsMessages = DB::table('log_messages')->select('*')->whereDate('logged_at','=',date($date))->paginate(10);

        if(is_null($LogsMessages)){
            return $this->sendError('Date Not Found!');
        }
        return $this->sendResponse($LogsMessages,'Logs Retrive Successfully.');
    }
}
