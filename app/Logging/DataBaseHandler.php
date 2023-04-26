<?php

namespace App\Logging;

use Illuminate\Support\Facades\DB;
use Monolog\Handler\AbstractProcessingHandler;

class DataBaseHandler extends AbstractProcessingHandler
{
    /**
     * @inheritDoc
     */
    protected function write(array $record):void{
        DB::table('log_messages')->insert([
            'level_name'=>$record['level_name'],
            'message'=>$record['message'],
            'context'=>json_encode($record['context']),
            // 'created_at'=>$record['created_at']->format('Y-m-d H:i:s')
        ]);
    }

}
