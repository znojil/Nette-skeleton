<?php
declare(strict_types = 1);

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use Nette\Bootstrap\Configurator;

class Bootstrap{

	public static function boot(bool|string|array $debugMode = false): Configurator{
			$configurator = new Configurator;
			$configurator->setDebugMode($debugMode);

			$logDir = __DIR__ . '/../log';
			\Nette\Utils\FileSystem::createDir($logDir, 0750);
			$configurator->enableTracy($logDir);

			$configurator->setTempDirectory(__DIR__ . '/../temp');

			$configurator->setTimeZone('Europe/Prague');
			$configurator->createRobotLoader()
				->addDirectory(__DIR__)
				->register();

			$configurator->addStaticParameters([
				'rootDir' => realpath(__DIR__ . '/..'),
				'appDir' => __DIR__,
				'logDir' => realpath($logDir),
				'wwwDir' => realpath(__DIR__ . '/../www'),
			]);

			$configurator->addConfig(__DIR__ . '/config/common.neon');

			return $configurator;
	}

	public static function bootWeb(): Configurator{
			$configurator = self::boot(getenv('_DEBUG') !== false);

		if($configurator->isDebugMode() === true){
				$configurator->addConfig(__DIR__ . '/config/local.neon');
		}

			return $configurator;
	}

	public static function bootCron(bool $production = true): Configurator{
			$configurator = self::boot(true);

		if($production === false){
				$configurator->addConfig(__DIR__ . '/config/local.neon');
		}

			return $configurator;
	}

}
