<?php

namespace ProjectORM;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
	
require_once "vendor/autoload.php";


class DoctrineBootstrap {
	
	protected $isDevMode;
	protected $config;
	protected $dbConnectionParams;
	protected $entityManager;
	
	public function __construct() {
		$this->isDevMode = TRUE;
		
		//CREATE A FUNCTION getConfig with exception handling for this
		$this->config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $this->isDevMode);
		
		$this->dbConnectionParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'admin',
            'dbname'   => 'mailinglistmanager_db',
            'host'     => 'localhost',
            'port'     => '3306',
        );
	}
	public function getEntityManager() {
		
		//Add EXCEPTION HAMDLING HERE
		$this->entityManager = EntityManager::create($this->dbConnectionParams, $this->config);
		
		return $this->entityManager;
	}
}
	