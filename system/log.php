<?php

/*all log will be written into the directory of data
author: linsheng.wu
date: 2014.6.25
*/
class Log {
    public static function add($msg, $log) {
        $log = $log ? $log : 'journal';

        $log_file = FRAME_ROOT . "/data/logs/{$log}.log";
        if(! file_exists($log_file)) {
            if(! file_exists(dirname($log_file))) {
                @mkdir(dirname($log_file), 0777, true);
            }
            @touch(basename($log_file));
        }

        $prefix = date('Y-m-d H:i:s');
        @file_put_contents($log_file, "{$prefix}    {$msg}" . PHP_EOL, FILE_APPEND);
    }
}
