<?php

namespace App;

use Kdyby;
use Nette;



class OrderEmailsListener extends Nette\Object implements Kdyby\Events\Subscriber
{

	/**
	 * @var EmailsQueue
	 */
	private $emailsQueue;



	public function __construct(EmailsQueue $emailsQueue)
	{
		$this->emailsQueue = $emailsQueue;
	}



	public function getSubscribedEvents()
	{
		return ['App\OrderProcess::onFinished'];
	}



	public function onFinished(OrderProcess $orders, $orderInfo)
	{
		// logic
		$this->emailsQueue->append([
			'to' => $orderInfo['email'],
			'subject' => 'Nová objednávka #123',
			'text' => 'Vaše objednávka "' . $orderInfo['order'] . '" se vyřizuje',
		]);
	}

}
