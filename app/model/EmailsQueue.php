<?php

namespace App;

use Kdyby;
use Nette;
use PhpAmqpLib\Message\AMQPMessage;



class EmailsQueue extends Nette\Object implements Kdyby\RabbitMq\IConsumer
{

	/**
	 * @var Kdyby\RabbitMq\Connection
	 */
	private $rabbitmq;



	public function __construct(Kdyby\RabbitMq\Connection $rabbitmq)
	{
		$this->rabbitmq = $rabbitmq;
	}



	public function append($email)
	{
		$this->rabbitmq
			->getProducer('emails')
			->publish(serialize($email));
	}



	public function process(AMQPMessage $message)
	{
		$email = unserialize($message->body);

		usleep(500);
		echo $email['to'] . ': ' . $email['subject'], "\n";

		return TRUE;
	}

}
