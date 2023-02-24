<?php

namespace App\Command;

use App\Repository\StatisticRepository;
use App\Services\StatisticService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'push:stats',
    description: 'Push all Statistics of dofus in database',
)]
class StatisticCommand extends Command
{
    private  $statRepository;
    private  $statService;
    private $lastStat;

    public function __construct(StatisticService $statService, StatisticRepository $statRepository) {
        parent::__construct();
        $this->statRepository = $statRepository;
        $this->statService = $statService;
        $this->lastStat = $statRepository->findOneBy([],['id' => 'DESC']);
    }
    protected function configure(): void
    {}

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        if($this->lastStat) {
            $io->error('All Statistics are already in the database');
            return Command::FAILURE;
        }
        $this->statService->createStatistics();
        $io->success('All Statistics are now in database !');
    
        return Command::SUCCESS;
    }
}
