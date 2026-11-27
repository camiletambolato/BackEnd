<?php
declare(strict_types=1);

namespace App\Core;

use Throwable;

class Roteador
{
    /** @var array<string, array<string, array{handler: callable|array, guards: array}>> */
    private array $rotas = [];

    public function registrar(string $metodo, string $caminho, callable|array $handler, array $guards = []): void
    {
        $metodo = strtoupper(trim($metodo));
        $caminho = $this->normalizarCaminho($caminho);

        $this->rotas[$metodo][$caminho] = [
            'handler' => $handler,
            'guards'  => $guards,
        ];
    }

    public function despachar(string $metodo, string $uri): void
    {
        $metodo = strtoupper(trim($metodo));
        $caminho = $this->normalizarCaminho($uri);

        if (!isset($this->rotas[$metodo][$caminho])) {
            $metodoExisteEmOutraRota = false;
            foreach ($this->rotas as $verbo => $rotasDoVerbo) {
                if (isset($rotasDoVerbo[$caminho])) {
                    $metodoExisteEmOutraRota = true;
                    break;
                }
            }

            if ($metodoExisteEmOutraRota) {
                http_response_code(405);
                echo '405 - Method Not Allowed';
                return;
            }

            http_response_code(404);
            echo '404 - Not Found (' . htmlspecialchars($metodo . ' ' . $caminho, ENT_QUOTES, 'UTF-8') . ')';
            return;
        }

        $rota = $this->rotas[$metodo][$caminho];

        foreach ($rota['guards'] as $guardItem) {
            if (!$this->executarGuard($guardItem)) {
                return;
            }
        }

        $this->chamarHandler($rota['handler']);
    }

    private function normalizarCaminho(string $uri): string
    {
        $caminho = parse_url($uri, PHP_URL_PATH);
        if (!is_string($caminho) || $caminho === '') {
            return '/';
        }

        $scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
        if ($scriptDir !== '' && $scriptDir !== '/' && str_starts_with($caminho, $scriptDir)) {
            $caminho = substr($caminho, strlen($scriptDir));
        }

        $caminho = '/' . trim($caminho, '/');
        return $caminho === '//' ? '/' : $caminho;
    }

    private function executarGuard(mixed $guardItem): bool
    {
        if (is_array($guardItem) && isset($guardItem[0])) {
            $classe = $guardItem[0];
            $parametros = $guardItem[1] ?? [];
            $instancia = is_object($classe) ? $classe : new $classe();

            if (method_exists($instancia, 'verificar')) {
                return (bool) $instancia->verificar($parametros);
            }

            if (is_callable($instancia)) {
                return (bool) $instancia($parametros);
            }
        }

        if (is_callable($guardItem)) {
            return (bool) $guardItem();
        }

        return true;
    }

    private function chamarHandler(callable|array $handler): void
    {
        try {
            if (is_array($handler) && count($handler) === 2) {
                [$classeOuObjeto, $metodo] = $handler;
                $instancia = is_object($classeOuObjeto) ? $classeOuObjeto : new $classeOuObjeto();
                $instancia->$metodo();
                return;
            }

            if (is_callable($handler)) {
                $handler();
            }
        } catch (Throwable $e) {
            http_response_code(500);
            echo '500 - Erro interno: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
        }
    }
}