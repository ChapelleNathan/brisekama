<?php

namespace App\Command;

use App\Services\ItemService;
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
class PushItemsCommand extends Command
{
    private  $itemService;

    public function __construct(ItemService $itemService) {
        parent::__construct();
        $this->itemService = $itemService;
    }
    protected function configure(): void
    {}

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $this->itemService->bddConverter();

        $io->success('All data from DofApi are pushed in the database !');

        return Command::SUCCESS;
    }
}
