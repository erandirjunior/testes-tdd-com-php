<?php

class Leilao
{
	private $descricao;
	private $lances;

	function __construct($descricao)
	{
		$this->descricao = $descricao;
		$this->lances = array();
	}

	public function propoe(Lance $lance)
	{
		if (count($this->lances) === 0 || $this->pegaUltimoLance()->getUsuario() !== $lance->getUsuario())
			$this->lances[] = $lance;
	}

	public function pegaUltimoLance()
	{
		return $this->lances[count($this->lances) -1];
	}

	public function getDescricao()
	{
		return $this->descricao;
	}

	public function getLances()
	{
		return $this->lances;
	}
}