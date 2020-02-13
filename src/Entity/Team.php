<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $teamname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamname(): ?string
    {
        return $this->teamname;
    }

    public function setTeamname(string $teamname): self
    {
        $this->teamname = $teamname;

        return $this;
    }
}
