<?php

    namespace LogForm\Utils;

    use Monolog\Handler\StreamHandler;
    use Monolog\Level;
    use Monolog\Logger;

    class Log {
        private static Logger $logger;

        public static function error(string $message): void {
            self::getLogger()->error($message);
        }

        public static function info(string $message): void {
            self::getLogger()->info($message);
        }

        private static function getLogger(): Logger {
            if (empty(self::$logger)) {
                self::$logger = new Logger('log');
                $logStream = new StreamHandler(self::getLogPath(), Level::Debug);

                self::$logger->pushHandler($logStream);
            }

            return self::$logger;
        }

        private static function getLogPath(): string {
            return __DIR__ . "/../../log/log.log";
        }
    }
