<?php
// This class seems kind of unnecessary
class Task
{

	protected $description;
	protected $status;
	protected $createdTime;
	protected $updatedTime;

	function __construct($description)
	{
		$this->description = "$description";
		$this->status = incomplete;
		$this->createdTime = date('Y-m-d H:i:s');

		$newTask = new db;
		$newTask->addTask($description);
	}

}
