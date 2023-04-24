<?php

namespace Alura\Leilao\Model;

class Leilao
{
    /** @var Lance[] */
    private $lances;
    /** @var string */
    private $descricao;

    
    private $finalizado = false;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    public function recebeLance(Lance $lance)
    {
        if(!empty($this->lances) && $this->ehDoUltimoUsuario($lance)){
            throw new \DomainException('Usuário não pode propor 2 lances repetidos');
        }
        $usuario = $lance->getUsuario();
        $totalLancesUsuario = $this->qtdLancesPorUser($usuario);
        if($totalLancesUsuario >= 5){
            throw new \DomainException('Usuário não pode propor mais de 5 lances por leilão');
        }

        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }
    public function finaliza(){
        $this->finalizado =  true;
    }

    private function ehDoUltimoUsuario(Lance $lance){
        $lance1 = $this->lances[count($this->lances) -1];
        return $lance->getUsuario() == $lance1->getUsuario();
    }

    private function qtdLancesPorUser(Usuario $usuario){
        $totalLancesUsuario = array_reduce($this->lances, function($totalAcumulado, Lance $lanceAtual) use ($usuario){
            if($lanceAtual->getUsuario() == $usuario){
                return $totalAcumulado + 1;
            }
            return $totalAcumulado;

        }, 0);
        return $totalLancesUsuario;
    }
    public function estaFinalizado(){
        return $this->finalizado;
    }
}