<?php
declare(strict_types=1);

// Criar a classe responsável por fornecer uma instãncia única de conexão com o Banco de Dados (Singleton)

final class ConexaoBanco{
    // atributos => são as características do objeto
    private static ?PDO $instancia = null; // muda de acrodo com a conexão. Iicialmente é nulo, mas depois pode mudar para conectado

    // métodos (ações que o objeto pode fazer)

    // construtor
    private function __construct(){} // construtor vazio e privado (técnica singleton)

    // para garantia de segurança // bloqueio de clonagem // desserialização
    private function __clone(): void {}
    public function __wakeup(): void {throw new \Exception("desserialização não permitida no Singleton");}

    // Fazer a técnica de obterConexao PDO
    public static function obterConexao(string $caminhoConfig):PDO {
        // só vou criar uma nova conexão se não existir outra
        if(self::$instancia === null){
            // vou criar uma conexão
            $config = self::carregarArquivoConfig
            ($caminhoConfig);
            self::$instancia = self::estabelecerConexao($config);
        }
        return self::$instancia;
    }

    // Le e valida os parãmetros do arquivo de configuração, dados envelopados .in ou .env 
    private static function carregarArquivoConfig(string $caminho):array{
        if(!file_exists($caminho)){
            throw new \RuntimeException("Arquivo de configuração não encontrado em: {$caminho}");
        }
        $dados = parse_ini_file($caminho, true);
        if($dados === false || !isset($dados["database"])){
            throw new \RuntimeException("Seção [database] ausente no arquivo de configuração");
        }
        return $dados["database"];
    }

    // Criar a instancia nativa do PDO aplicando as flags de Segurança do PDO
    private static function estabelecerConexao(array $cfg) : PDO{
        $dsn = sprintf(
            "%s:host=%s;port=%s;dbname=%s",
            $cfg["db_driver"],
            $cfg["db_host"],
            $cfg["db_port"],
            $cfg["db_name"],
        );
        // Colocar a Flag do PDO
                $opcoes = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_TIMEOUT            => 5
        ];

        return new PDO($dsn, $cfg["db_user"], $cfg["db_pass"], $opcoes);
    }

}
?>