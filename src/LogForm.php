<?php

    namespace LogForm;

    use Exception;
    use LogForm\Utils\{Data, Log, Session, Util, Viewer};

    class LogForm {
        public function start(): void {
            Session::start();
            Log::info('Usuário conectado ao sistema.');

            if (!Data::isEmpty()) {
                Log::info('Requisição para formulário.');

                try {
                    if (!Data::has('github_user')) {
                        throw new Exception('Usuário do GitHub é obrigatório.');
                    }

                    Log::info("Buscando avatar do usuário {$_POST['github_user']}");

                    $userName = Data::get('github_user');
                    $path = "https://github.com/{$userName}.png";
                    $avatar = file_get_contents($path);

                    if (!($avatar)) {
                        Log::warning("Conteúdo do avatar de {$_POST['github_user']} está em formato inválido.");
                    }

                    if (empty($avatar)) {
                        throw new Exception("Avatar não encontrado para o usuário {$_POST['github_user']}.");
                    }

                    Session::set('github_avatar', $path);
                    Session::set('github_user', Data::get('github_user'));
                    Session::set('error', null);
                } catch (Exception $exception) {
                    Log::error($exception->getMessage());
                    Session::set('error', $exception->getMessage());
                }
            }

            echo Viewer::form();
        }
    }
