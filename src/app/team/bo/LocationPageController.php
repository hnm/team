<?php
namespace team\bo;

use n2n\web\http\orm\ResponseCacheClearer;
use n2n\reflection\annotation\AnnoInit;
use n2n\persistence\orm\annotation\AnnoEntityListeners;
use n2n\persistence\orm\annotation\AnnoTable;
use page\bo\PageController;
use team\controller\LocationController;
use page\annotation\AnnoPage;
use page\annotation\AnnoPageCiPanels;

class LocationPageController extends PageController {
	private static function _annos(AnnoInit $ai) {
		$ai->c(new AnnoEntityListeners(ResponseCacheClearer::getClass()), new AnnoTable('team_location_page_controller'));
		$ai->m('locationPage', new AnnoPage(), new AnnoPageCiPanels('main'));
	}
	
	public function locationPage(LocationController $lc, array $args = null) {
		$this->delegate($lc);
	}

}