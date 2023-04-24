<?php

namespace Alura\Leilao\Tests\Service;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase {

    private $leiloeiro;
    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDescrescente
     * @dataProvider leilaoEmOrdemAleatoria
     * 
     */
    public function test_Avaliador_pegar_maior(Leilao $leilao){

        $this->leiloeiro->avalia($leilao);

        $maiorValor = $this->leiloeiro->getBiggerValeu();

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
        
        $this->leiloeiro->avalia($leilao);

        $menorValor = $this->leiloeiro->getMenorValor();

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

        $this->leiloeiro->avalia($leilao);

        $maioresValores = $this->leiloeiro->getMaioresLances();

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
            'Ordem Crescente' => [$leilao]
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
            'Ordem Descrescente' =>[$leilao]
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
            'Ordem Aleatória' => [$leilao]
        ];
        
    }
    protected function setUp(): void
    {
        $this->leiloeiro = new Avaliador();
    }
    protected function tearDown(): void
    {

    }
    public function test_leilao_nao_pode_ser_vazio(){
        // try{

        //     static::fail();

        // }catch(\DomainException $exception){
        //     static::assertEquals('não é possivel avaliar leilão vazio', $exception->getMessage());
        // }
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('não é possivel avaliar leilão vazio');

        $leilao = new Leilao('Fusca Azul');
        $this->leiloeiro->avalia($leilao);

    }
    // public function entregaLeiloes(){
    //     return [
    //         [$this->leilaoEmOrdemCrescente()],
    //         [$this->leilaoEmOrdemDescrescente()],
    //         [$this->leilaoEmOrdemAleatoria()],
    //     ];
    // }
    
}