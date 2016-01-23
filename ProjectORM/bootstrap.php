<?php
    use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;
	
	require_once "vendor/autoload.php";
	
	$isDevMode = TRUE;
	$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
	
	// the connection configuration
    /*
    $dbParams = array(
                'driver'   => 'pdo_mysql',
                'user'     => 'root',
                'password' => 'admin',
                'dbname'   => 'mailinglistmanager_db',
                'host'     => 'localhost',
                'port'     => '3306',
            );
        */
    
    $dbParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'admin',
            'dbname'   => 'doctrine_test_db',
            'host'     => 'localhost',
            'port'     => '3306',
        );
    
    
	$entityManager = EntityManager::create($dbParams, $config);
