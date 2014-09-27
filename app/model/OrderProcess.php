<?php

namespace App;

use Kdyby;
use Nette;



class OrderProcess extends Nette\Object
{

	/**
	 * @var array|Kdyby\Events\Event
	 */
	public $onFinished = [];



	public function order($info)
	{
		// logika
		$this->onFinished($this, $info);
		$this->onFinished->dispatch([$this, $info]);
		// logika
	}

}
