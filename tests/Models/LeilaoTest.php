<?php

namespace Alura\Leilao\Tests\Models;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase{

    /**
     * @dataProvider geraLances
     */
    public function test_leilao_deve_recebe_lances(int $qtdLances, Leilao $leilao, array $valores){

        static::assertCount($qtdLances, $leilao->getLances());

        foreach ($valores as $i=> $valoesEsperados){
            static::assertEquals($valoesEsperados, $leilao->getLances()[$i]->getValor());
        }

    }
    public function geraLances(){
        $ruan = new Usuario('Ruan');
        $jorge = new Usuario('Jorge');

        $leilaoCom2Lances = new Leilao('Fiat 147 0KM');
        $leilaoCom2Lances->recebeLance(new Lance($ruan, 2000));
        $leilaoCom2Lances->recebeLance(new Lance($jorge, 2500));


        $leilaoCom1Lances = new Leilao('Fusca 147 0KM');
        $leilaoCom1Lances->recebeLance(new Lance($ruan, 2000));


        return [
           '2-lances' => [2, $leilaoCom2Lances, [2000, 2500]],
            '1-lance' => [1, $leilaoCom1Lances, [2000]]
        ];
    }
    public function test_leilao_nao_dev_ter_2_lances_repetidos(){
        $jorge = new Usuario('Jorge');

        $leilao = new Leilao('Fiat 147 0KM');
        $leilao->recebeLance(new Lance($jorge, 2000));
        $leilao->recebeLance(new Lance($jorge, 2500));

        static::assertCount(1, $leilao->getLances());
        static::assertEquals(2000, $leilao->getLances()[0]->getValor());
    }
    public function test_leilao_com_mais_5_lances_user_por_usuario(){
        $jorge = new Usuario('Jorge');
        $ruan = new Usuario('Ruan');

        $leilao = new Leilao('Fiat 147 0KM');
        $leilao->recebeLance(new Lance($jorge, 2000));
        $leilao->recebeLance(new Lance($ruan, 2500));
        $leilao->recebeLance(new Lance($jorge, 3000));
        $leilao->recebeLance(new Lance($ruan, 3500));
        $leilao->recebeLance(new Lance($jorge, 4000));
        $leilao->recebeLance(new Lance($ruan, 5500));
        $leilao->recebeLance(new Lance($jorge, 6000));
        $leilao->recebeLance(new Lance($ruan, 6500));
        $leilao->recebeLance(new Lance($jorge, 7000));
        $leilao->recebeLance(new Lance($ruan, 7500));

        $leilao->recebeLance(new Lance($jorge, 8000));

        static::assertCount(10, $leilao->getLances());
        static::assertEquals(7500, $leilao->getLances()[array_key_last($leilao->getLances())]->getValor());

    }

}