<?php
declare(strict_types = 1);

namespace App\Modules\Base;

abstract class BasePresenter extends \Nette\Application\UI\Presenter{

	// final public function injectBase(): void{}


	/********************* change layout template files format *********************/


	public function formatLayoutTemplateFiles(): array{
			$called = static::class;
			$classes = [$called] + class_parents($called);

			$list = [];
		foreach($classes as $class){
			if(str_starts_with($class, 'Nette\\') === true){
					continue;
			}

				$presenterReflection = new \ReflectionClass($class);
				$presenterDir = dirname($presenterReflection->getFileName());

				$list[] = $presenterDir . '/@layout.latte';
				$list[] = $presenterDir . '/templates/@layout.latte';
		}

			$list = array_unique(array_merge(
				$list,
				parent::formatLayoutTemplateFiles()
			));

			return $list;
	}

	public function formatTemplateFiles(): array{
			$explodedPresenter = explode(':', $this->getName());
			$presenter = end($explodedPresenter);
			$dir = dirname((new \ReflectionClass($this))->getFileName());

			return array_merge(
				[
					"$dir/$this->view.latte",
					"$dir/$presenter.$this->view.latte",
					"$dir/templates/$this->view.latte",
					"$dir/templates/$presenter.$this->view.latte"
				],
				parent::formatTemplateFiles()
			);
	}

}
