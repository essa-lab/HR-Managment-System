<?php

namespace App;

use Monolog\Logger;


class LogDB
{
    public function __invoke(array $config)
    {
        return new Logger('Database', [
            new DataBaseHandler(),
        ]);
    }
}
