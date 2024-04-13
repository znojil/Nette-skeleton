<?php
declare(strict_types = 1);

//require __DIR__ . '/../App/.maintenance.php';

require __DIR__ . '/../App/Bootstrap.php';

\App\Bootstrap::bootWeb()
	->createContainer()
	->getByType(\Nette\Application\Application::class)
	->run();
