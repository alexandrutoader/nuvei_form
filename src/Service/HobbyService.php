<?php
namespace App\Service;

use App\Entity\Hobby;
use App\Repository\HobbyRepository;

class HobbyService
{
    private HobbyRepository $hobbyRepository;

    public function __construct(HobbyRepository $hobbyRepository)
    {
        $this->hobbyRepository = $hobbyRepository;
    }

    public function getActiveHobbiesByPriority(int $priority): array
    {
        return $this->hobbyRepository->findBy(
            [
                "status" => Hobby::STATUS_ACTIVE,
                "priority" => Hobby::MAX_PRIORITY
            ]
        );
    }

    public function getHobbiesForChoices(): array
    {
        $hobbiesChoices = [];
        /** @var Hobby $hobbies */
        $hobbies = $this->hobbyRepository->findBy(['status' => Hobby::STATUS_ACTIVE, 'priority' => Hobby::MAX_PRIORITY]);

        foreach ($hobbies as $hobby) {
            $hobbiesChoices[$hobby->getName()] = $hobby->getId();
        }

        return $hobbiesChoices;
    }
}