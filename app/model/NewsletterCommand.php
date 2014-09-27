<?php

namespace App;

use Kdyby;
use Nette;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;



class NewsletterCommand extends Command
{

	/**
	 * @var \App\EmailsQueue
	 * @inject
	 */
	public $queue;



	protected function configure()
	{
		$this->setName('app:newsletter')
			->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Počet emailů', 10000);
	}



	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$emailsCount = $input->getOption('count');

		for ($i = 0; $i <= $emailsCount ;$i++) {
			$this->queue->append([
				'to' => 'filip+' . rand(1, 10) . '@prochazka.su',
				'subject' => 'Spam ' . rand(1, 100),
				'text' => 'The cake is a lie',
			]);
		}
	}

}
