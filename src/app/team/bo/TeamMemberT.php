<?php
namespace team\bo;

use n2n\reflection\ObjectAdapter;
use rocket\impl\ei\component\prop\translation\Translatable;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use n2n\l10n\N2nLocale;

class TeamMemberT extends ObjectAdapter implements Translatable {
	private static function _annos(AnnoInit $ai) {
		$ai->p('teamMember', new AnnoManyToOne(TeamMember::getClass()));
	}

	private $id;
	private $n2nLocale;
	private $teamMember;
	private $function;
	private $descriptionHtml;

	public function getId() {
		return $this->id;
	}

	public function setId(int $id = null) {
		$this->id = $id;
	}

	public function getN2nLocale() {
		return $this->n2nLocale;
	}

	public function setN2nLocale(N2nLocale $n2nLocale) {
		$this->n2nLocale = $n2nLocale;
	}

	public function getTeamMember() {
		return $this->teamMember;
	}

	public function setTeamMember(TeamMember $teamMember = null) {
		$this->teamMember = $teamMember;
	}

	public function getFunction() {
		return $this->function;
	}

	public function setFunction(string $function = null) {
		$this->function = $function;
	}

	public function getDescriptionHtml() {
		return $this->descriptionHtml;
	}

	public function setDescriptionHtml(string $descriptionHtml = null) {
		$this->descriptionHtml = $descriptionHtml;
	}
}