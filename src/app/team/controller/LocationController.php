<?php

namespace team\controller;

use n2n\web\http\controller\ControllerAdapter;
use team\model\TeamDao;

class LocationController extends ControllerAdapter {
	public function index(TeamDao $teamDao) {
		$locations = $teamDao->getLocations();
		$this->forward('..\view\locations.html', ['locations' => $locations]);
	}
}

