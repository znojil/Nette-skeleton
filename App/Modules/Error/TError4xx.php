<?php
declare(strict_types = 1);

namespace App\Modules\Error;

use Nette\Application\BadRequestException;
use Nette\Http\IResponse;

trait TError4xx{

	private ?BadRequestException $exception;

	public function actionDefault(): void{
			$exception = $this->request->getParameter('exception');

			$this->exception = $exception instanceof BadRequestException
				? $exception
				: new BadRequestException('', IResponse::S404_NotFound);

			$this->getHttpResponse()->setCode($this->exception->getHttpCode()); // need if $exception is null
	}

	public function renderDefault(): void{
			$this->template->code = $this->exception->getHttpCode();
			$this->template->title = $this->getTitle();
			$this->template->message = $this->getMessage();
	}

	private function getTitle(): string{
			return match($this->exception->getCode()){
				IResponse::S404_NotFound => 'Page Not Found',
				default => IResponse::ReasonPhrases[$this->exception->getCode()],
			};
	}

	private function getMessage(): string{
			$exceptionMessage = $this->exception->getMessage();

			return match($this->exception->getCode()){
				IResponse::S400_BadRequest => $exceptionMessage,
				IResponse::S404_NotFound => (
					(
						mb_strlen($exceptionMessage) > 0
							AND
						str_starts_with(mb_strtolower($exceptionMessage), 'cannot load presenter') === false
							AND
						str_starts_with(mb_strtolower($exceptionMessage), 'page not found') === false
					)
						? $exceptionMessage
						: 'The page you requested could not be found.'),
				default => 'Your browser sent a request that this server could not understand or process.',
			};
	}

}
