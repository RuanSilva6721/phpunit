<?php

namespace Alura\Leilao\Tests\Service;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase {

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDescrescente
     * @dataProvider leilaoEmOrdemAleatoria
     * 
     */
    public function test_Avaliador_pegar_maior(Leilao $leilao){
        //$leilao = $this->leilaoEmOrdemCrescente();

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiorValor = $leiloeiro->getBiggerValeu();

        echo $maiorValor;

        self::assertEquals(2500, $maiorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDescrescente
     * @dataProvider leilaoEmOrdemAleatoria
     * 
     */
    public function test_Avaliador_pegar_menor(Leilao $leilao){
        
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $menorValor = $leiloeiro->getMenorValor();

        echo $menorValor;

        self::assertEquals(1500, $menorValor);
    }
        /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDescrescente
     * @dataProvider leilaoEmOrdemAleatoria
     * 
     */
    public function test_avaliador_buscar_3_maiores_valores(Leilao $leilao){

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maioresValores = $leiloeiro->getMaioresLances();

        static::assertCount(3, $maioresValores);
        static::assertEquals(2500, $maioresValores[0]->getValor());
        static::assertEquals(2300, $maioresValores[1]->getValor());
        static::assertEquals(2000, $maioresValores[2]->getValor());

    }

    public function leilaoEmOrdemCrescente(){
        $leilao = new Leilao('Fiat 147 0KM');
        $ruan = new Usuario('Ruan');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($ana, 1500));
        $leilao->recebeLance(new Lance($maria, 2000));
        $leilao->recebeLance(new Lance($ruan, 2300));
        $leilao->recebeLance(new Lance($jorge, 2500));

        return [
            [$leilao]
        ];
        
    }
        public function leilaoEmOrdemDescrescente(){
        $leilao = new Leilao('Fiat 147 0KM');
        $ruan = new Usuario('Ruan');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($ana, 2500));
        $leilao->recebeLance(new Lance($maria, 2300));
        $leilao->recebeLance(new Lance($ruan, 2000));
        $leilao->recebeLance(new Lance($jorge, 1500));

        return [
            [$leilao]
        ];
        
    }
        public function leilaoEmOrdemAleatoria(){
        $leilao = new Leilao('Fiat 147 0KM');
        $ruan = new Usuario('Ruan');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($ana, 1500));
        $leilao->recebeLance(new Lance($maria, 2000));
        $leilao->recebeLance(new Lance($ruan, 2500));
        $leilao->recebeLance(new Lance($jorge, 2300));

        return [
            [$leilao]
        ];
        
    }
    // public function entregaLeiloes(){
    //     return [
    //         [$this->leilaoEmOrdemCrescente()],
    //         [$this->leilaoEmOrdemDescrescente()],
    //         [$this->leilaoEmOrdemAleatoria()],
    //     ];
    // }
    
}