<?php

namespace Openska\AliceBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AliceImportCommand extends ContainerAwareCommand
{
    /** @var EntityManager */
    protected $em;

    /**
     * AliceImportCommand constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setName('alice:import')
            ->setDescription('Import Alice Fixtures')
            ->addArgument('yamlPath', InputArgument::REQUIRED, 'Path to YAML Fixtures')
         //   ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $yamlPath = $input->getArgument('yamlPath');

        $kernel = $this->getContainer()->get('kernel');
        $projectDir = $kernel->getProjectDir(); // SF 3.3
        $entities = \Nelmio\Alice\Fixtures::load($projectDir . '/' . $yamlPath, $this->em);

        $output->writeln(count($entities) . ' entities inserted.');
    }

}
