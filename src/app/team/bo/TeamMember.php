<?php
namespace team\bo;

use n2n\reflection\ObjectAdapter;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoManyToMany;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\l10n\N2nLocale;
use rocket\impl\ei\component\prop\translation\Translator;
use n2n\persistence\orm\CascadeType;
use n2n\io\managed\File;
use team\bo\TeamMemberT;
use team\bo\Team;
use n2n\persistence\orm\annotation\AnnoManagedFile;

class TeamMember extends ObjectAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->p('fileImage', new AnnoManagedFile());
		$ai->p('teamMemberTs', new AnnoOneToMany(TeamMemberT::getClass(), 'teamMember', CascadeType::ALL, null, true));
		$ai->p('teams', new AnnoManyToMany(Team::getClass(), null, CascadeType::PERSIST));
	}

	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $phone;
	private $fileImage;
	private $orderIndex;
	private $online = true;
	private $teamMemberTs;
	private $teams;

	/**
	 * @param N2nLocale ...$n2nLocales
	 * @return TeamMemberT []
	 */
	public function t(N2nLocale ...$n2nLocales) {
		return Translator::findAny($this->teamMemberTs, ...$n2nLocales);
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id = null) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @param string $firstName
	 */
	public function setFirstName(string $firstName = null) {
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @param string $lastName
	 */
	public function setLastName(string $lastName = null) {
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail(string $email = null) {
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @param string $phone
	 */
	public function setPhone(string $phone = null) {
		$this->phone = $phone;
	}

	/**
	 * @return File
	 */
	public function getFileImage() {
		return $this->fileImage;
	}

	/**
	 * @param File $fileImage
	 */
	public function setFileImage(File $fileImage = null) {
		$this->fileImage = $fileImage;
	}

	/**
	 * @return int
	 */
	public function getOrderIndex() {
		return $this->orderIndex;
	}

	/**
	 * @param int $orderIndex
	 */
	public function setOrderIndex(int $orderIndex = null) {
		$this->orderIndex = $orderIndex;
	}

	/**
	 * @return bool
	 */
	public function isOnline() {
		return $this->online;
	}

	/**
	 * @param bool $online
	 */
	public function setOnline(bool $online = null) {
		$this->online = (bool) $online;
	}

	/**
	 * @return TeamMemberT []
	 */
	public function getTeamMemberTs() {
		return $this->teamMemberTs;
	}

	public function setTeamMemberTs($teamMemberTs) {
		$this->teamMemberTs = $teamMemberTs;
	}

	/**
	 * @return Team []
	 */
	public function getTeams() {
		return $this->teams;
	}

	public function setTeams($teams) {
		$this->teams = $teams;
	}
	
	public function getFullName() {
		return $this->firstName . ' ' . $this->lastName;
	}
}