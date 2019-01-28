<?php
namespace team\model;

use n2n\persistence\orm\EntityManager;
use team\bo\Team;
use n2n\context\RequestScoped;
use team\bo\TeamMember;

class TeamDao implements RequestScoped {
	private $em;
	
	private function _init(EntityManager $em) {
		$this->em = $em;
	}
	
	/**
	 * @return Team[]
	 */
	public function getTeams() {
		return $this->em->createSimpleCriteria(Team::getClass(), null, 
				array('orderIndex' => 'ASC', 'online' => true))->toQuery()->fetchArray();
	}
	
	/**
	 * @param Team $team
	 * @return TeamMember []
	 */
	public function getTeamMembers(Team $team = null) {
		$criteria = $this->em->createCriteria();
		$criteria->from(TeamMember::getClass(), 'm');
		$criteria->select('m');
		$criteria->where(array('m.online' => true));
		if (null !== $team) {
			$criteria->where()->andMatch('m.teams', 'CONTAINS', $team);
		}
		$criteria->order('m.orderIndex', 'ASC');
		return $criteria->toQuery()->fetchArray();
	}
	
	/**
	 * @param int $id
	 * @return TeamMember
	 */
	public function getTeamMemberById(int $id) {
		return $this->em->createNqlCriteria('SELECT m FROM team\bo\TeamMember t 
				WHERE t.id = :id AND t.online = :online', array('id' => $id, 'online' => true))->toQuery()->fetchSingle();
	}
}