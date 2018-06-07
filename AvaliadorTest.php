<?php

require_once 'Avaliador.php';
require_once 'ConstrutorDeLeilao.php';

class AvaliadorTest extends PHPUnit_Framework_TestCase
{
	private $leiloeiro;

	public function SetUp()
	{
		$this->leiloeiro = new Avaliador();
	}

	public function testDeveAceitarLancesEmOrdemDecrescente()
	{
		$leilao = new Leilao('Playstation 4');

		$renan = new Usuario('Renan');
		$caio = new Usuario('Caio');
		$felipe = new Usuario('Felipe');

		$leilao->propoe(new Lance($renan, 400));
		$leilao->propoe(new Lance($caio, 350));
		$leilao->propoe(new Lance($felipe, 250));

		$this->leiloeiro->avalia($leilao);

		$maiorEsperado = 400;
		$menorEsperado = 250;

		$this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance());
		$this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance());
	}

	public function testDeveAceitarLancesEmOrdemCrescente()
	{
		$leilao = new Leilao('Playstation 4');

		$renan = new Usuario('Renan');
		$caio = new Usuario('Caio');
		$felipe = new Usuario('Felipe');

		$leilao->propoe(new Lance($renan, 250));
		$leilao->propoe(new Lance($caio, 350));
		$leilao->propoe(new Lance($felipe, 400));

		$this->leiloeiro->avalia($leilao);

		$maiorEsperado = 400;
		$menorEsperado = 250;

		$this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance());
		$this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance());
	}

	public function testDeveAceitarApenasUmLance()
	{
		$leilao = new Leilao('Playstation 4');

		$renan = new Usuario('Renan');

		$leilao->propoe(new Lance($renan, 2000));

		$this->leiloeiro->avalia($leilao);

		$maiorEsperado = 2000;
		$menorEsperado = 2000;

		$this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance());
		$this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance());
	}

	public function testDevePegarOsTresMaiores()
	{
		//$leilao = new Leilao('Playstation 4');

		$renan = new Usuario('Renan');
		$caio = new Usuario('Caio');

		$construtor = new ConstrutorDeLeilao();
		$leilao = $construtor->para('Playstation 4')
		->lance($renan, 200)
		->lance($caio, 300)
		->lance($renan, 400)
		->lance($caio, 500)
		->constroi();

		/*$leilao->propoe(new Lance($renan, 200));
		$leilao->propoe(new Lance($caio, 300));
		$leilao->propoe(new Lance($renan, 400));
		$leilao->propoe(new Lance($caio, 500));*/

		$this->leiloeiro->avalia($leilao);

		$this->assertEquals(3, count($this->leiloeiro->getMaiores()));
		$this->assertEquals(500, $this->leiloeiro->getMaiores()[0]->getValor());
		$this->assertEquals(400, $this->leiloeiro->getMaiores()[1]->getValor());
		$this->assertEquals(300, $this->leiloeiro->getMaiores()[2]->getValor());
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testDeveRecusarLeilaoSemLances()
	{
		$construtor = new ConstrutorDeLeilao();
		$leilao = $construtor->para('Playstation 4')->constroi();
		$this->leiloeiro->avalia($leilao);
	}
}