<?php

    namespace LogForm\Utils;

    class Data {
        public static function isEmpty(): bool {
            return empty($_POST);
        }

        public static function has(string $key): bool {
            return !empty($_POST[$key]);
        }

        public static function get(string $key): mixed {
            return $_POST[$key] ?? null;
        }
    }
