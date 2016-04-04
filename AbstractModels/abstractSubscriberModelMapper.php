<?php
namespace AbstractModels;

abstract class AbstractSubscriberModelMapper {
	
	abstract function addUser($user);
	abstract function removeUser($user);
	abstract function updateUser($user);
	abstract function fetchUser($params);
	abstract function fetchAllUsers($params);
	abstract function fetchSomeUsers($params);
	//abstract function getChild($userid);
	//abstract function save(array $params);
	
}
