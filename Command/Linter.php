<?php

namespace Militree\MagentoLinter\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\ObjectManagerInterface;

class Linter extends Command
{
    /**
     * @var $objectManager
     */
    protected $objectManager;


    public function __construct(
        ObjectManagerInterface $objectManager,
        \Militree\MagentoLinter\Test\Linter\Style $styleLinter,
        \Militree\MagentoLinter\Test\Linter\Syntax $syntaxLinter,
        \Militree\MagentoLinter\Test\Linter\PSR1 $psr1Linter,
        \Militree\MagentoLinter\Test\Linter\PSR2 $psr2Linter
    ) {
        $this->objectManager = $objectManager;
        $this->styleLinter = $styleLinter;
        $this->syntaxLinter = $syntaxLinter;
        $this->psr1Linter = $psr1Linter;
        $this->psr2Linter = $psr2Linter;
        return parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('militree:m2-linter');
        $this->setDescription('Test and lint custom created Magento 2 modules.');
        parent::configure();
    }

    /**
     * Execute or whatever idk this is easy
     * @param \Symfony\Component\Console\Input\InputInterface $input 
     * @param \Symfony\Component\Console\Output\OutputInterface $output 
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $ouput)
    {
        $this->syntaxLinter->lint();
        $this->psr1Linter->lint();
        $this->psr2Linter->lint();
        $this->styleLinter->lint();
    }
}