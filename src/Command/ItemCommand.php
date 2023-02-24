<?php

namespace App\Command;

use App\Repository\ItemRepository;
use App\Repository\StatisticRepository;
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
    description: 'Fetch all items from dofApi, treat them, and push them in the database',
)]
class ItemCommand extends Command
{
    private  $itemService;
    private $lastItem;
    private $lastStat;

    public function __construct(ItemService $itemService, ItemRepository $itemRepository, StatisticRepository $statisticRepository) {
        parent::__construct();
        $this->itemService = $itemService;
        $this->lastItem = $itemRepository->findOneBy([],['id' => 'DESC']);
        $this->lastStat = $statisticRepository->findOneBy([],['id' => 'DESC']);
    }
    protected function configure(): void
    {}

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        if(!$this->lastStat) {
            $io->error('There is no statistic in Database, please do the command \'php bin/console push:stats\'');
            return Command::FAILURE;
        }
        if($this->lastItem) {
            $io->error('All Items are already in the Database');
            return Command::FAILURE;
        }
        $this->itemService->dbConverter();
        $io->success('All data from DofApi are pushed in the database !');
        
        return Command::SUCCESS;
    }
}
