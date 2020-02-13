<?php
/**
 * Created by PhpStorm.
 * User: Sander
 * Date: 13/02/2020
 * Time: 19:02
 */

namespace App\Controller;


use App\Exception\TeamAlreadyExistsException;
use App\Service\TeamService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{

	/** @var TeamService */
	protected $teamService;

	public function __construct(TeamService $teamService)
	{
		$this->teamService = $teamService;
	}

	/**
	 * @Route("/add_team", methods={"POST"})
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 */
	public function add_team(Request $request)
	{
		$data = json_decode($request->getContent(), true);
		$name = $data['name'];

		try {
			$this->teamService->add_team($name);
		} catch (TeamAlreadyExistsException $e) {
			return $this->json([
				'created' => false,
				'message' => $e->getMessage(),
			], Response::HTTP_CONFLICT);
		}

		return $this->json([
			"created" => true,
			"status" => 200
		]);
	}
}