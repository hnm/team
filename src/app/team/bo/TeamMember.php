<?php
namespace team\bo;

use n2n\reflection\ObjectAdapter;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoManyToMany;
use n2n\persistence\orm\annotation\AnnoOneToMany;
use n2n\l10n\N2nLocale;
use rocket\impl\ei\component\prop\translation\Translator;
use n2n\io\managed\File;
use n2n\persistence\orm\annotation\AnnoManagedFile;
use n2n\core\N2N;
use JeroenDesloovere\VCard\VCard;
use n2n\persistence\orm\annotation\AnnoManyToOne;

class TeamMember extends ObjectAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->p('fileImage', new AnnoManagedFile());
		$ai->p('teamMemberTs', new AnnoOneToMany(TeamMemberT::getClass(), 'teamMember', \n2n\persistence\orm\CascadeType::ALL, null, true));
		$ai->p('teams', new AnnoManyToMany(Team::getClass(), null, \n2n\persistence\orm\CascadeType::PERSIST));
		$ai->p('location', new AnnoManyToOne(Location::getClass()));
	}

	const COMPANY_NAME = 'Hofmänner New Media';
	const COMPANY_STREET = 'Stadthausstrasse 65';
	const COMPANY_ZIP = '8400';
	const COMPANY_CITY = 'Winterthur';
	const COMPANY_COUNTRY = 'Schweiz';
	const COMPANY_WEBSITE = 'https://www.hnm.ch';

	private $id;
	private $firstName;
	private $lastName;
	private $teamMemberTs;
	private $email;
	private $pathPart;
	private $phone;
	private $mobile;
	private $fileImage;
	private $location;
	private $teams;
	private $orderIndex;
	private $online = true;

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
	public function setOnline(bool $online) {
		$this->online = (bool) $online;
	}

	/**
	 * @return TeamMemberT[]
	 */
	public function getTeamMemberTs() {
		return $this->teamMemberTs;
	}

	public function setTeamMemberTs($teamMemberTs) {
		$this->teamMemberTs = $teamMemberTs;
	}

	/**
	 * @return Team[]
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

	public function getPathPart() {
		return $this->pathPart;
	}

	public function setPathPart(string $pathPart = null) {
		$this->pathPart = $pathPart;
	}

	public function getCode() {
		return substr(md5($this->getFullName() . N2N::getAppConfig()->general()->getApplicationName()), 20, 7);
	}

	public function getMobile() {
		return $this->mobile;
	}

	public function setMobile(string $mobile = null) {
		$this->mobile = $mobile;
	}

	/**
	 * @return \JeroenDesloovere\VCard\VCard
	 */
	public function getVcard(N2nLocale $locale) {
		$vcard = new VCard();
		$vcard->addName($this->getLastname(), $this->getFirstname());
		$vcard->addJobtitle($this->t($locale)->getFunction());
		if (null != $email = $this->getEmailOfMemberOrLocation()) {
			$vcard->addEmail($email);
		}
		if (null !== $phone = $this->getPhoneOfMemberOrLocation()) {
			$vcard->addPhoneNumber(TeamMember::formatPhoneLink($phone), 'WORK');
		}
		if (null !== $mobile = $this->getMobile()) {
			$vcard->addPhoneNumber(TeamMember::formatPhoneLink($mobile), 'CELL');
		}
		
		if (null !== $location = $this->getLocation()) {
			$vcard->addCompany($location->getName());
			$vcard->addAddress(null, null, $location->getStreet(), $location->getCity(), null, $location->getZip(), $location->getCountry());
			$vcard->addURL($location->getHomepage());
		}
		
		// 		if (null !== $foto = $this->getFileImage()) {
		// 			$vcard->addPhoto($this->getRequest()->getHostUrl() . $foto->toUrl()->__toString());
		// 		}
		
		return $vcard;
	}

	public static function formatPhoneLink($phone) {
		$phone = str_replace(' ', '', $phone);
		if (substr($phone, 0, 1) == '0') {
			$phone = '+41' . substr($phone, 1, strlen($phone) - 1);
		}
		return $phone;
	}

	public function getLocation() {
		return $this->location;
	}

	public function setLocation(Location $location) {
		$this->location = $location;
	}
	
	public function getPhoneOfMemberOrLocation() {
		if ($this->phone) {
			return $this->phone;
		}
		if (!$this->location) {
			return null;
		}
		return $this->location->getPhone();
	}
	
	public function getEmailOfMemberOrLocation() {
		if ($this->email) {
			return $this->email;
		}
		if (!$this->location) {
			return null;
		}
		return $this->location->getEmail();
	}
}