<?php

namespace Alura\Leilao\Tests\Service;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase {

    public function test_Avaliador_pegar_maior_ordem_crescente(){

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
    public function test_Avaliador_pegar_maior_ordem_descrescente(){

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
    public function test_Avaliador_pegar_menor_ordem_descrescente(){

        $leilão = new Leilao('Celta 147 0KM');

        $ruan = new Usuario('Ruan');
        $carlos = new Usuario('Carlos');

        $leilão->recebeLance( new Lance($ruan, 2500));
        $leilão->recebeLance( new Lance($carlos, 2000));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilão);

        $menorValor = $leiloeiro->getMenorValor();

        echo $menorValor;

        self::assertEquals(2000, $menorValor);
    }
    public function test_Avaliador_pegar_menor_ordem_crescente(){

        $leilão = new Leilao('Celta 147 0KM');

        $ruan = new Usuario('Ruan');
        $carlos = new Usuario('Carlos');

        $leilão->recebeLance( new Lance($ruan, 2000));
        $leilão->recebeLance( new Lance($carlos, 2500));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilão);

        $menorValor = $leiloeiro->getMenorValor();

        echo $menorValor;

        self::assertEquals(2000, $menorValor);
    }

    public function test_avaliador_buscar_3_maiores_valores(){
        $leilao = new Leilao('Fiat 147 0KM');
        $ruan = new Usuario('Ruan');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($ana, 1500));
        $leilao->recebeLance(new Lance($maria, 2000));
        $leilao->recebeLance(new Lance($ruan, 2500));
        $leilao->recebeLance(new Lance($jorge, 2300));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maioresValores = $leiloeiro->getMaioresLances();

        static::assertCount(3, $maioresValores);
        static::assertEquals(2500, $maioresValores[0]->getValor());
        static::assertEquals(2300, $maioresValores[1]->getValor());
        static::assertEquals(2000, $maioresValores[2]->getValor());

    }
    
}