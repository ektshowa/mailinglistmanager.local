<?php

namespace AbstractModels;

include 'AbstractUser.php';

abstract class AbstractSubscriber extends AbstractUser {
	abstract function getMimetype();
	abstract function getRole();
	abstract function setMimetype($mimetype);
	abstract function setRole($role);
}
