<?php
declare(strict_types = 1);

namespace App\Model;

use Nette\Application\Routers\RouteList;

final class RouterFactory{

	public function createRouter(): RouteList{
			return (new RouteList)
				/*->withModule('Admin')
					->withPath('admin')
						->addRoute(..)
					->end()
					->addRoute('admin[/<presenter>[/<action>]]', 'Dashboard:default')
				->end()*/
				->withModule('Front')
					->addRoute('<presenter>[/<action>]', 'Home:default')
				->end();
	}

}
