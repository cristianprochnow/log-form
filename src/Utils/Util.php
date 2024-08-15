<?php

    namespace LogForm\Utils;

    class Util {
        public static function isBinary(string $str): bool {
            return preg_match('~[^\x20-\x7E\t\r\n]~', $str) > 0;
        }
    }
