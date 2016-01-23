<?php
namespace AbstractControllers;

abstract class AbstractSubscriberController {
	abstract function createAction();
	abstract function readAction();
	abstract function updateAction();
	abstract function deleteAction();
}
