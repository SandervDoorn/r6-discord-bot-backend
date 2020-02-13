<?php
/**
 * Created by PhpStorm.
 * User: Sander
 * Date: 13/02/2020
 * Time: 19:35
 */

namespace App\Exception;


use Exception;

class TeamAlreadyExistsException extends Exception
{
	public static function forTeamname(string $teamname)
	{
		return new self("Team '$teamname' already exists!");
	}
}