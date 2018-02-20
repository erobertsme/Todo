<? php
/*

Tasks
	-Name
	-Description
	-Status (default: incomplete)
	-Created_at

todo:
updated_at

*/
class Tasks
{
	require_once('db.php')
	protected $name;
	protected $description;
	protected $status;

	function __construct($name,$description)
	{
		$this->name = "$name";
		$this->description = "$description";
		$this->status = incomplete;
		$this->created_at = date('Y-m-d H:i:s');

		db->newTask();
	}

	function __get($attribute)
	{
		if ($attribute = "name") {
			db->get('name');
			return $this->$name;
		}
		elseif ($attribute = "description") {
			db->get('description');
			return $this->$description;
		}
		elseif ($attribute = "status") {
			db->get('status');
			return $this->$status;
		}
	}
	
	function __set($attribute)
	{

	}

}



?>