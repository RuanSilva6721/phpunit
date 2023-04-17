<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';

$leilão = new Leilao('Celta 147 0KM');

$ruan = new Usuario('Ruan');
$carlos = new Usuario('Carlos');

$leilão->recebeLance( new Lance($ruan, 2800));
$leilão->recebeLance( new Lance($carlos, 3500));

$leiloeiro = new Avaliador();
$leiloeiro->avalia($leilão);

$maiorValor = $leiloeiro->getBiggerValeu();

echo $maiorValor;