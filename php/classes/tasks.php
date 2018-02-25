<?php
// This class seems kind of unnecessary
class Task
{

	protected $description;
	protected $status;
	protected $created_at;
	protected $updated_at;

	function __construct($description)
	{
		$this->description = "$description";
		$this->status = incomplete;
		$this->created_at = date('Y-m-d H:i:s');

		$newTask = new db;
		$newTask->addTask($description);
	}

}
