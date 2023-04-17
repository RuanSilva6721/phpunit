<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Leilao;

class Avaliador
{
    protected $biggerValue;
    public function avalia(Leilao $leilao){
        $lances = $leilao->getLances();
        $lastBid = $lances[count($lances) -1];
        $this->biggerValue = $lastBid->getValor();
        
    }
    public function getBiggerValeu(){
        return $this->biggerValue;
    }
}
