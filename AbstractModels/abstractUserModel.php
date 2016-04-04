<?php
namespace AbstractModels;

abstract class AbstractUserModel {
	abstract function getEmail();
	abstract function getFirstname();
	abstract function getLastname();
	abstract function getPassword();
	abstract function setEmail($email);
	abstract function setFirstname($firstname);
	abstract function setLastname($lastname);
	abstract function setPassword($password);
//	abstract function addUser($user);
//	abstract function removeUser($user);
//	abstract function getChild($userid);
//	abstract function save(array $params);
//	abstract function fetch($params);
//	abstract function toArray();
}
