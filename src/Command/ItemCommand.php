<?php

namespace App\Command;

use App\Repository\ItemRepository;
use App\Services\ItemService;
use App\Services\StatisticService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'push:items',
    description: 'fetch all items from dofApi, treat them, and push them in the database',
)]
class ItemCommand extends Command
{
    private  $itemService;
    private $statisticService; 

    public function __construct(ItemService $itemService, StatisticService $statisticService) {
        parent::__construct();
        $this->itemService = $itemService;
        $this->statisticService = $statisticService;
    }
    protected function configure(): void
    {}

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $this->statisticService->createStatistics();
        $this->itemService->dbConverter();

        $io->success('All data from DofApi are pushed in the database !');

        return Command::SUCCESS;
    }
}
