<?php

namespace Alura\Leilao\Tests\Service;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase {

    public function test_Avaliador_pegar_ultimo_ordem_crescente(){

        $leilão = new Leilao('Celta 147 0KM');

        $ruan = new Usuario('Ruan');
        $carlos = new Usuario('Carlos');

        $leilão->recebeLance( new Lance($ruan, 2000));
        $leilão->recebeLance( new Lance($carlos, 2500));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilão);

        $maiorValor = $leiloeiro->getBiggerValeu();

        echo $maiorValor;

        self::assertEquals(2500, $maiorValor);
    }
    public function test_Avaliador_pegar_ultimo_ordem_descrescente(){

        $leilão = new Leilao('Celta 147 0KM');

        $ruan = new Usuario('Ruan');
        $carlos = new Usuario('Carlos');

        $leilão->recebeLance( new Lance($ruan, 2500));
        $leilão->recebeLance( new Lance($carlos, 2000));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilão);

        $maiorValor = $leiloeiro->getBiggerValeu();

        echo $maiorValor;

        self::assertEquals(2500, $maiorValor);
    }
    
}