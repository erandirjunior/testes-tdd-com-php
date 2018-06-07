<?php

class Avaliador
{
	private $maiorValor = -INF;
	private $menorValor = INF;
	private $maiores;

	public function avalia(Leilao $leilao)
	{
		if (count($leilao->getLances()) === 0) {
			throw new InvalidArgumentException("Um leilão precisa ter pelo menos um lance", 1);
			
		}
		foreach ($leilao->getLances() as $lance) {
			if ($lance->getValor() > $this->maiorValor) {
				$this->maiorValor = $lance->getValor();
			}

			if ($lance->getValor() < $this->menorValor) {
				$this->menorValor = $lance->getValor();
			}
		}
		$this->pegaOsMaioresNo($leilao);
	}

	public function pegaOsMaioresNo(Leilao $leilao)
	{
		$lances = $leilao->getLances();

		usort($lances, function($a, $b) {
			if ($a->getValor() === $b->getValor()) return 0;

			return $a->getValor() < $b->getValor() ? 1 : -1;
		});

		$this->maiores = array_slice($lances, 0, 3);
	}

	public function getMaiorLance()
	{
		return $this->maiorValor;
	}

	public function getMenorLance()
	{
		return $this->menorValor;
	}

	public function getMaiores()
	{
		return $this->maiores;
	}
}