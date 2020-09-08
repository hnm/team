<?php
namespace team\bo;

use page\bo\PageController;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoManyToMany;
use team\controller\TeamController;
use team\model\TeamDao;
use page\annotation\AnnoPage;
use page\annotation\AnnoPageCiPanels;

class TeamMemberPageController extends PageController {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->m('employees', new AnnoPage(), new AnnoPageCiPanels('top', 'main'));
		$ai->p('teamMembers', new AnnoManyToMany(TeamMember::getClass()));
	}

	private $teamMembers;

	public function employees(TeamController $teamController, TeamDao $teamDao, array $r = null) {
		$teamController->setTeamMembers(count($this->teamMembers) > 0 ? $this->teamMembers : $teamDao->getTeamMembers());
		$this->delegate($teamController);
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
}