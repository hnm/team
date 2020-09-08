<?php
namespace team\controller;

use team\model\TeamDao;
use n2n\web\http\controller\ControllerAdapter;
use n2n\web\http\PageNotFoundException;
use n2n\reflection\annotation\AnnoInit;
use n2n\web\http\annotation\AnnoPath;

class TeamController extends ControllerAdapter {
	private static function _annos(AnnoInit $ai) {
		$ai->m('detail', new AnnoPath('/teamMemberId:*'));
	}
	
	private $teamDao;
	
	private $teams;
	private $teamMembers;
	private $detailViewEnabled = false;
	
	private function _init(TeamDao $teamDao) {
		$this->teamDao = $teamDao;
	}
	
	public function getTeams() {
		return $this->teams;
	}

	public function setTeams($teams = null) {
		$this->teams = $teams;
	}

	public function getTeamMembers() {
		return $this->teamMembers;
	}

	public function setTeamMembers($teamMembers = null) {
		$this->teamMembers = $teamMembers;
	}

	public function isDetailViewEnabled() {
		return $this->detailViewEnabled;
	}

	public function setDetailViewEnabled(bool $detailViewEnabled) {
		$this->detailViewEnabled = $detailViewEnabled;
	}
	
	public function prepare() {
		$this->assignHttpCacheControl(new \DateInterval('PT30M'));
		$this->assignResponseCacheControl(new \DateInterval('P1D'));
	}

	public function index() {
		if (null !== $this->teams) {
			$this->teams();
			return;
		}
		
		if (null !== $this->teamMembers) {
			$this->teamMembers();
			return;
		}
		
		throw new PageNotFoundException('Invalid team controller execution.');
	}
	
	private function teams() {
		$this->forward('..\view\teamOverview.html', array('teams' => $this->teams,
				'detailLinkAvailable' => $this->detailViewEnabled));
	}
	
	private function teamMembers() {
		$this->forward('..\view\teamMemberOverview.html', array('teamMembers' => $this->teamMembers, 
				'detailLinkAvailable' => $this->detailViewEnabled));
	}
	
	public function detail($teamMemberId) {
		if (!$this->detailViewEnabled) {
			throw new PageNotFoundException('Detail view is disabled.');
		}
		
		$teamMember = $this->teamDao->getTeamMemberById($teamMemberId);
		
		if (!$teamMember) {
			throw new PageNotFoundException('invalid id for team member given: ' . $teamMemberId);
		}
		
		$this->forward('..\view\teamMemberDetail.html', array('teamMember' => $teamMember));
	}
}
