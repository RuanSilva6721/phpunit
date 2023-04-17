<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Leilao;

class Avaliador
{
    protected $biggerValue = 0;
    public function avalia(Leilao $leilao){

        foreach($leilao->getLances() as $lance){
            if($lance->getValor() > $this->biggerValue){
                $this->biggerValue = $lance->getValor();
            }

        }
        
    }
    public function getBiggerValeu(){
        return $this->biggerValue;
    }
}
