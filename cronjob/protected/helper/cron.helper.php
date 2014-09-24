<?php
define('LOCK_DIR', __DIR__);
define('LOCK_SUFFIX', '.lock');

class cronHelper {

        private static $pid;

        function __construct() {}

        function __clone() {}

        private static function isrunning() {
                $pids = explode(PHP_EOL, `ps -e | awk '{print $1}'`);
                if(in_array(self::$pid, $pids))
                        return TRUE;
                return FALSE;
        }

        public static function lock() {
                global $argv;

                $lock_file = LOCK_DIR.$argv[0].LOCK_SUFFIX;

                if(file_exists($lock_file)) {
                        //return FALSE;

                        // Is running?
                        self::$pid = file_get_contents($lock_file);
                        if(self::isrunning()) {
                                error_log("==".self::$pid."== Already in progress...");
                                return FALSE;
                        }
                        else {
                                error_log("==".self::$pid."== Previous job died abruptly...");
                        }
                }

                self::$pid = getmypid();
                file_put_contents($lock_file, self::$pid);
                error_log("==".self::$pid."== Lock acquired, processing the job...");
                return self::$pid;
        }

        public static function unlock() {
                global $argv;

                $lock_file = LOCK_DIR.$argv[0].LOCK_SUFFIX;

                if(file_exists($lock_file))
                        unlink($lock_file);

                error_log("==".self::$pid."== Releasing lock...");
                return TRUE;
        }

}