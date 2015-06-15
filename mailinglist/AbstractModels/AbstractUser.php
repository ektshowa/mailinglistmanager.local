<?php
namespace AbstractModels;

abstract class AbstractUser {
	abstract function getEmail();
	abstract function getName();
	abstract function getPassword();
	abstract function setEmail($email);
	abstract function setName($name);
	abstract function setPassword($password);
	abstract function addUser(AbtractUser $user);
	abstract function removeUser(AbtractUser $user);
	abstract function getChild($userid);
	abstract function save(array $params);
	abstract function fetch($params);
	abstract function toArray();
}
