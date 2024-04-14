<?php
declare(strict_types = 1);

namespace App\Modules\Error\Modules\Error4xx;

use Nette\Application;
use Nette\Application\Responses\ForwardResponse;

final class Error4xxPresenter implements Application\IPresenter{

	public function __construct(
		private Application\IPresenterFactory $presenterFactory
	){}

	public function run(Application\Request $request): ForwardResponse{
		$requestParameter = $request->getParameter('request');

		$module = 'Front';
		$sep = ':';
		if($requestParameter !== null){
			[$module, $presenter, $sep] = Application\Helpers::splitName($requestParameter->getPresenterName());
		}

		$explodedModule = explode($sep, $module);
		for($i = count($explodedModule); $i >= 1; $i--){
			$testedErrorPresenter = implode($sep, $explodedModule) . ':Error';
			try{
				$this->presenterFactory->getPresenterClass($testedErrorPresenter);

				break;
			}catch(\Throwable){
				unset($explodedModule[$i - 1]);
			}
		}

		return new ForwardResponse($request->setPresenterName($testedErrorPresenter));
	}

}
