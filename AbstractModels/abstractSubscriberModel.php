<?php

namespace AbstractModels;

require_once 'abstractUserModel.php';

abstract class AbstractSubscriberModel extends AbstractUserModel {
	abstract function getMimetype();
	abstract function getRole();
	abstract function setMimetype($mimetype);
	abstract function setRole($role);
}
