<?php
declare(strict_types=1);

use DomainException; //impor da biblioteca de erros chamado DomainExeption

//Classe base para erros da regra de negócio (nome da classe tem que ser o mesmo nome do arquivo)
class ContaException extends DomainException{ //Herança da base de erros do sistema
    //declaração do construtor usando propery promotion

    #[Override]
    public function __construct(string $message = "Falha na operação bancária!")
    {
        return parent::__construct($message);
    }
}

?>