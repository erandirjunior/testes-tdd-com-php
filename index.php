<?php

require 'Usuario.php';
require 'Lance.php';
require 'Leilao.php';
require 'Avaliador.php';

$leilao = new Leilao('Playstation 4');

$renan = new Usuario('Renan');
$caio = new Usuario('Caio');
$felipe = new Usuario('Felipe');

$leilao->propoe(new Lance($renan, 400));
$leilao->propoe(new Lance($caio, 350));
$leilao->propoe(new Lance($felipe, 250));

$leiloeiro = new Avaliador();
$leiloeiro->avalia($leilao);

$maiorEsperado = 400;
$menorEsperado = 250;

var_dump($leiloeiro->getMaiorLance() === $maiorEsperado);
var_dump($leiloeiro->getMenorLance() === $menorEsperado);