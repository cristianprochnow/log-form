<?php

    const FILE_LOG_OPT = 3;

    session_start();
    info('Usuário conectado ao sistema.');

    if (!empty($_POST)) {
        info('Requisição para formulário.');

        try {
            if (empty($_POST['github_user'])) {
                throw new Exception('Usuário do GitHub é obrigatório.');
            }

            info("Buscando avatar do usuário {$_POST['github_user']}");

            $path = "https://github.com/{$_POST['github_user']}.png";
            $avatar = file_get_contents($path);

            if (!isBinary($avatar)) {
                warning("Conteúdo do avatar de {$_POST['github_user']} está em formato inválido.");
            }

            if (empty($avatar)) {
                throw new Exception("Avatar não encontrado para o usuário {$_POST['github_user']}.");
            }

            $_SESSION['github_avatar'] = $path;
            $_SESSION['github_user'] = $_POST['github_user'];
            $_SESSION['error'] = null;
        } catch (Exception $exception) {
            error($exception->getMessage());

            $_SESSION['error'] = $exception->getMessage();
        }
    }

    function info(string $message): void {
        error_log(
            $message,
                FILE_LOG_OPT,
            __DIR__.'/log/info.log'
        );
    }

    function error(string $message): void {
        error_log(
            $message,
            FILE_LOG_OPT,
            __DIR__.'/log/info.log'
        );
    }

    function warning(string $message): void {
        error_log(
            $message,
            FILE_LOG_OPT,
            __DIR__.'/log/warning.log'
        );
    }

    function isBinary(string $str): bool {
        return preg_match('~[^\x20-\x7E\t\r\n]~', $str) > 0;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log Form</title>
    </head>
    <body>
        <header>
            <?= $_SESSION['error'] ?? '' ?>
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
                    src="<?= $_SESSION['github_avatar'] ?? '' ?>"
                    alt="<?= $_SESSION['github_user'] ?? '' ?>">
        </footer>
    </body>
</html>
