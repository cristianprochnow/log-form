<?php

    namespace LogForm\Utils;

    class Session {
        public static function start(): void {
            if (!self::isActive()) session_start();
        }

        public static function get(string $key): mixed {
            return $_SESSION[$key] ?? null;
        }

        public static function set(string $key, mixed $value): void {
            $_SESSION[$key] = $value;
        }

        private static function isActive(): bool {
            return session_status() === PHP_SESSION_ACTIVE;
        }
    }
