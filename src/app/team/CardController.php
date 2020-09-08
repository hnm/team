<?php

namespace team\controller;

use n2n\web\http\controller\ControllerAdapter;
use n2n\reflection\annotation\AnnoInit;
use n2n\web\http\annotation\AnnoPath;
use team\model\TeamDao;
use n2n\web\http\PageNotFoundException;
use JeroenDesloovere\VCard\VCard;
use team\bo\TeamMember;

class CardController extends ControllerAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->m('detail', new AnnoPath('pathPart:*/code:*'));
	}
	
	private $teamDao;
	
	private function _init(TeamDao $teamDao) {
		$this->teamDao = $teamDao;
	}
	
	public function detail($pathPart, $code) {
		$teamMember = $this->getTeamMember($pathPart, $code);
		
		$this->forward('..\view\contact.html', ['teamMember' => $teamMember]);
	}
	
	public function doVcard($pathPart, $code) {
		$teamMember = $this->getTeamMember($pathPart, $code);
		
		$vcard = new VCard();
		$vcard->addName($teamMember->getLastname(), $teamMember->getFirstname());
		$vcard->addCompany('Hofmänner New Media GmbH');
		$vcard->addJobtitle($teamMember->getFunction());
		$vcard->addEmail($teamMember->getEmail());
		if (null !== $phone = $teamMember->getPhone()) {
			$vcard->addPhoneNumber(TeamMember::formatPhoneLink($phone), 'WORK');
		}
		if (null !== $mobile = $teamMember->getMobile()) {
			$vcard->addPhoneNumber(TeamMember::formatPhoneLink($mobile), 'CELL');
		}
		$vcard->addAddress(null, null, 'Stadthausstrasse 65', 'Winterthur', 'ZH', '8400', 'Schweiz');
		$vcard->addURL('https://www.hnm.ch');
// 		if (null !== $foto = $teamMember->getFileImage()) {
// 			$vcard->addPhoto($this->getRequest()->getHostUrl() . $foto->toUrl()->__toString());
// 		}
		
		$vcard->download();
	}
	
	
	public function doContactLinks() {
		$teamMembers = $this->teamDao->getTeamMembers();
		
		$this->forward('..\view\contactLinks.html', ['teamMembers' => $teamMembers]);
	}
	
	/**
	 * @param string $pathPart
	 * @param string $code
	 * @throws PageNotFoundException
	 * @return \team\bo\TeamMember
	 */
	private function getTeamMember($pathPart, $code) {
		$teamMember = $this->teamDao->getMemberByPathPart($pathPart);
		if (!$teamMember) {
			throw new PageNotFoundException('invalid pathpart. no teammember found');
		}
		if ($teamMember->getCode() !== $code) {
			throw new PageNotFoundException('invalid code');
		}
		if (!$teamMember->isOnline()) {
			throw new PageNotFoundException('teammember is not online!');
		}
		return $teamMember;
	}
}

