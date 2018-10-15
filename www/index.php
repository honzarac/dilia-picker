<?php

$container = require __DIR__ . '/../DiliaPicker/bootstrap.php';

$container->getByType(Nette\Application\Application::class)
	->run();
