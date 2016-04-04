<?php
namespace AbstractModels;

abstract class AbstractUser {
	abstract function getEmail();
	abstract function getName();
	abstract function getPassword();
	abstract function setEmail($email);
	abstract function setName($name);
	abstract function setPassword($password);
	abstract function addUser($user);
	abstract function removeUser($user);
	abstract function getChild($userid);
	abstract function save(array $params);
	abstract function fetch($params);
	abstract function toArray();
}
