<?php

namespace Alura\Leilao\Model;

class Leilao
{
    /** @var Lance[] */
    private $lances;
    /** @var string */
    private $descricao;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    public function recebeLance(Lance $lance)
    {
        if(!empty($this->lances) && $this->ehDoUltimoUsuario($lance)){
            return;
        }
        $usuario = $lance->getUsuario();
        $totalLancesUsuario = $this->qtdLancesPorUser($usuario);
        if($totalLancesUsuario >= 5){
            return;
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
}