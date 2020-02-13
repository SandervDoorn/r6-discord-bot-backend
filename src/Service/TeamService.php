<?php
/**
 * Created by PhpStorm.
 * User: Sander
 * Date: 13/02/2020
 * Time: 19:16
 */

namespace App\Service;


use App\Entity\Team;
use App\Exception\TeamAlreadyExistsException;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class TeamService
{

	/** @var TeamRepository */
	protected $teamRepository;

	/** @var EntityManagerInterface */
	private $entityManager;

	public function __construct(TeamRepository $teamRepository, EntityManagerInterface $entityManager)
	{
		$this->teamRepository = $teamRepository;
		$this->entityManager = $entityManager;
	}

	/**
	 * @param string $teamname
	 * @throws TeamAlreadyExistsException
	 */
	public function add_team(string $teamname)
	{
		$exist = $this->teamRepository->findOneByTeamname($teamname);
		if ($exist === null) {
			$team = (new Team)
				->setTeamname($teamname);
			$this->entityManager->persist($team);
			$this->entityManager->flush();
		} else {
			throw TeamAlreadyExistsException::forTeamname($teamname);
		}
	}
}