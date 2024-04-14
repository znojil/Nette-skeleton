<?php
declare(strict_types = 1);

namespace App\Modules\Error\Modules\Error5xx;

use Nette\Application;
use Nette\Application\Responses\CallbackResponse;
use Tracy\ILogger;

final class Error5xxPresenter implements Application\IPresenter{

	public function __construct(
		private ILogger $logger
	){}

	public function run(Application\Request $request): CallbackResponse{
		$this->logger->log($request->getParameter('exception'), ILogger::EXCEPTION);

		return new CallbackResponse(function (): void{
			require __DIR__ . '/500.html';
		});
	}

}
