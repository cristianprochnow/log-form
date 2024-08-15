<?php

    namespace LogForm\Utils;

    class Viewer {
        public static function form(): string {
            ob_start();
            ?>
            <!DOCTYPE html>
            <html lang="pt-br">
                <head>
                    <title>Log Form</title>
                </head>
                <body>
                    <header>
                        <?= Session::get('error') ?: '' ?>
                    </header>
                    <form method="post">
                        <div>
                            <label for="github_user">Nome de Usuário do GitHub</label>
                            <input type="text" id="github_user" name="github_user">
                        </div>
                        <button type="submit">Enviar</button>
                    </form>
                    <footer>
                        <img
                            src="<?= Session::get('github_avatar') ?: '' ?>"
                            alt="<?= Session::get('github_user') ?: '' ?>">
                    </footer>
                </body>
            </html>
            <?php
            return ob_get_clean();
        }
    }
