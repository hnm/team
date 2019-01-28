<?php
namespace team\bo;

use rocket\impl\ei\component\prop\translation\Translatable;
use n2n\reflection\annotation\AnnoInit;
use n2n\l10n\N2nLocale;
use n2n\reflection\ObjectAdapter;
use n2n\persistence\orm\annotation\AnnoManyToOne;

class TeamT extends ObjectAdapter implements Translatable {
	private static function _annos(AnnoInit $ai) {
		$ai->p('team', new AnnoManyToOne(Team::getClass()));
	}
	
	private $id;
	private $n2nLocale;
	private $team;
	private $name;
	private $description;
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getN2nLocale() {
		return $this->n2nLocale;
	}

	public function setN2nLocale(N2nLocale $n2nLocale) {
		$this->n2nLocale = $n2nLocale;
	}

	public function getTeam() {
		return $this->team;
	}

	public function setTeam($team) {
		$this->team = $team;
	}
	
	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}
}