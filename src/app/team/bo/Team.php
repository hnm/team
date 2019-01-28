<?php
namespace team\bo;

use n2n\reflection\annotation\AnnoInit;
use n2n\reflection\ObjectAdapter;
use n2n\persistence\orm\annotation\AnnoOrderBy;
use n2n\persistence\orm\annotation\AnnoManyToMany;
use n2n\l10n\N2nLocale;
use rocket\impl\ei\component\prop\translation\Translator;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\persistence\orm\CascadeType;

class Team extends ObjectAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->p('teamMembers', new AnnoManyToMany(TeamMember::getClass(), 'teams', CascadeType::PERSIST), 
				new AnnoOrderBy(array('orderIndex' => 'ASC')));
		$ai->p('teamTs', new AnnoOneToMany(TeamT::getClass(), 'team', CascadeType::ALL, null, true));
	}
	
	private $id;
	private $orderIndex;
	private $online = true;
	private $teamTs;
	private $teamMembers;
	
	public function __construct() {
		$this->teamTs = new \ArrayObject();
	}
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}
	
	public function getOrderIndex() {
		return $this->orderIndex;
	}

	public function setOrderIndex($orderIndex) {
		$this->orderIndex = $orderIndex;
	}

	public function getOnline() {
		return $this->online;
	}

	public function setOnline($online) {
		$this->online = $online;
	}

	public function getTeamTs() {
		return $this->teamTs;
	}

	public function setTeamTs($teamTs) {
		$this->teamTs = $teamTs;
	}

	public function getTeamMembers() {
		return $this->teamMembers;
	}

	public function setTeamMembers($teamMembers) {
		$this->teamMembers = $teamMembers;
	}
	
	/**
	 * @param N2nLocale ...$n2nLocales
	 * @return TeamT []
	 */
	public function t(N2nLocale ...$n2nLocales) {
		return Translator::findAny($this->teamTs, ... $n2nLocales);
	}
}