<?php
namespace team\bo;

use n2n\reflection\annotation\AnnoInit;
use page\bo\PageController;
use n2n\persistence\orm\annotation\AnnoManyToMany;
use page\annotation\AnnoPageCiPanels;
use team\controller\TeamController;
use team\model\TeamDao;
use page\annotation\AnnoPage;

class TeamPageController extends PageController {
	private static function _annos(AnnoInit $ai) {
		$ai->p('teams', new AnnoManyToMany(Team::getClass()));
		$ai->m('teams', new AnnoPage(), new AnnoPageCiPanels('top', 'main'));
	}
	
	private $teams;
	
	public function __construct() {
		$this->teams = new \ArrayObject();
	}
	
	public function getTeams() {
		return $this->teams;
	}

	public function setTeams($teams) {
		$this->teams = $teams;
	}
	
	public function teams(TeamController $teamController, TeamDao $teamDao, array $r = null) {
 		$teamController->setTeams(count($this->teams) > 0 ? $this->teams : $teamDao->getTeams());
		
		$this->delegate($teamController);
	}
}