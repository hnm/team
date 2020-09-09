<?php
namespace team\bo;

use n2n\web\http\orm\ResponseCacheClearer;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\reflection\ObjectAdapter;
use n2n\persistence\orm\annotation\AnnoOneToMany;

class Location extends ObjectAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('team_location'));
		$ai->p('teamMembers', new AnnoOneToMany(TeamMember::getClass(), 'location'));
	}

	private $id;
	private $teamMembers;
	private $name;
	private $street;
	private $zip;
	private $city;
	private $country;
	private $phone;
	private $email;
	private $homepage;
	private $orderIndex;

	public function getId() {
		return $this->id;
	}

	public function setId(int $id) {
		$this->id = $id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName(string $name = null) {
		$this->name = $name;
	}

	public function getStreet() {
		return $this->street;
	}

	public function setStreet(string $street = null) {
		$this->street = $street;
	}

	public function getZip() {
		return $this->zip;
	}

	public function setZip(string $zip = null) {
		$this->zip = $zip;
	}

	public function getCity() {
		return $this->city;
	}

	public function setCity(string $city = null) {
		$this->city = $city;
	}

	public function getCountry() {
		return $this->country;
	}

	public function setCountry(string $country = null) {
		$this->country = $country;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function setPhone(string $phone = null) {
		$this->phone = $phone;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail(string $email = null) {
		$this->email = $email;
	}

	public function getHomepage() {
		return $this->homepage;
	}

	public function setHomepage(string $homepage = null) {
		$this->homepage = $homepage;
	}

	public function getOrderIndex() {
		return $this->orderIndex;
	}

	public function setOrderIndex(int $orderIndex = null) {
		$this->orderIndex = $orderIndex;
	}

	/**
	 * @return TeamMember[]
	 */
	public function getTeamMembers() {
		return $this->teamMembers;
	}

	public function setTeamMembers($teamMembers) {
		$this->teamMembers = $teamMembers;
	}
	
	/**
	 * @return string[]|
	 */
	public function getAddressArr() {
		$data = [];
		$data['name'] = $this->getName();
		$data['street'] = $this->getStreet();
		$data['city'] = $this->getZip() . ' ' . $this->getCity();
		$data['country'] = $this->getCountry();
		return $data;
	}
	
	/**
	 * @param string $separator
	 * @return string
	 */
	public function getAddressStr(string $separator = "\n") {
		$data = $this->getAddressArr();
		foreach ($data as $key => $value) {
			if (empty($value)) {
				unset($data[$key]);
			}
		}
		return implode($separator, $data);
	}
}