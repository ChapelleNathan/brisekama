<?php

namespace App\Services;

use App\Entity\Statistic;
use App\Repository\RuneRepository;
use Doctrine\ORM\EntityManagerInterface;

class StatisticService
{
    private $stats = [
        'Intelligence',
        'Dommages Terre',
        'Force',
        'Vitalité',
        'Sagesse',
        'PA'
    ];
    private $manager;
    private $runes;

    public function __construct(EntityManagerInterface $manager, RuneRepository $runeRepository) {
        $this->manager = $manager;
        $this->runes = $runeRepository->findAll();
    }

    public function createStatistics() {
        foreach ($this->stats as $stat) {
                $newStat = new Statistic();
                $newStat->setName($stat);
                foreach ($this->runes as $rune) {
                    if ($stat === $rune->getStatistic()) {
                        $newStat->setRune($rune);
                    }
                }
            $this->manager->persist($newStat);
        }
        $this->manager->flush();
    }
}