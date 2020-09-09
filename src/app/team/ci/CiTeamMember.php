<?php
namespace team\ci;

use n2n\impl\web\ui\view\html\HtmlView;
use rocket\impl\ei\component\prop\ci\model\ContentItem;
use n2n\web\http\orm\ResponseCacheClearer;
use n2n\persistence\orm\annotation\AnnoTable;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoManyToOne;
use team\bo\TeamMember;

class CiTeamMember extends ContentItem {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoTable('team_ci_team_member'), new AnnoEntityListeners(ResponseCacheClearer::getClass()));
		$ai->p('teamMember', new AnnoManyToOne(TeamMember::getClass()));
	}

	private $teamMember;

	public function createUiComponent(HtmlView $view) {
		return $view->getImport('\team\view\inc\teamMember.html', ['teamMember' => $this->teamMember]);
	}

	/**
	 * @return TeamMember
	 */
	public function getTeamMember() {
		return $this->teamMember;
	}

	/**
	 * @param TeamMember $teamMember
	 */
	public function setTeamMember(TeamMember $teamMember) {
		$this->teamMember = $teamMember;
	}
}