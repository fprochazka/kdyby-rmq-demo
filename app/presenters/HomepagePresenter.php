<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Tracy\Debugger;



class HomepagePresenter extends BasePresenter
{

	/**
	 * @var \App\OrderProcess
	 * @inject
	 */
	public $orderProcess;



	/**
	 * @return Form
	 */
	protected function createComponentSendEmail()
	{
		$form = new Form();
		$form->addText('email', 'Email')->setDefaultValue('filip@prochazka.su');
		$form->addTextarea('order', 'Objednávka')->setDefaultValue('Jednoho Dishe prosím!');

	    $form->addSubmit("send", "Odeslat");
		$form->onSuccess[] = function (Form $form) {

			$this->orderProcess->order($form->getValues(TRUE));

			$this->redirect('this');
		};

		return $form;
	}

}
