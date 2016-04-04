<?php
//Database Constantes
define("DATABASE_ADMIN_USERNAME", "root");
define("DATABASE_ADMIN_PASSWORD", "admin");

//Controllers Constantes
define("ABSTRACT_CONTROLLERS_FOLDER", "/var/www/html/mailinglistmanager.local/mailinglist/AbstractControllers/");
define("CONTROLLERS_FOLDER", "/var/www/html/mailinglistmanager.local/mailinglist/Controllers/");
define("SUBSCRIBERS_CONTROLLER" , "Controllers\\SubscribersController");
define("SUBSCRIBERS_CONTROLLERS_FILENAME", "subscribersController.php");

//Models Constantes
define("ABSTRACT_MODELS_FOLDER", "/var/www/html/mailinglistmanager.local/mailinglist/AbstractModels/");
define("MODELS_FOLDER", "/var/www/html/mailinglistmanager.local/mailinglist/Models/");
define("ABSTRACT_SUBSCRIBER_MODEL_FILENAME", "abstractSubscriberModel.php");
define("ABSTRACT_SUBSCRIBER_MODELMAPPER_FILENAME", "abstractSubscriberModelMapper.php");
define("SUBSCRIBER_MODEL_FILENAME", "subscriberModel.php");
define("SUBSCRIBER_MODELMAPPER_FILENAME", "subscriberModelMapper.php");
define("ABSTRACT_VALIDATIONS_FOLDER", "/var/www/html/mailinglistmanager.local/mailinglist/AbstractValidations/");
define("DOCTRINE_BOOTSTRAP_FOLDER", "/var/www/html/mailinglistmanager.local/mailinglist/ProjectORM/");
define("DOCTRINE_BOOTSTRAP_FILENAME", "doctrineBootstrap.php");

//Login Services Constantes
define("ABSTRACT_LOGIN_SERVICES_FOLDER", "/var/www/html/mailinglistmanager.local/mailinglist/AbstractLoginServices/");
define("LOGIN_SERVICES_FOLDER", "/var/www/html/mailinglistmanager.local/mailinglist/LoginServices/");
define("LOGINPROXY_SERVICES_CLASS", "LoginServices\\LoginProxy");

//Helpers Constantes
define("HELPERS_FOLDER", "/var/www/html/mailinglistmanager.local/mailinglist/Helpers/");
define("SERVICES_CONTROLLER_ACTION_MAPPER_FILE","servicesControllerActionMapper.xml");
