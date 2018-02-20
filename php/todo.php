<? php
/*

Note: This is a Work In Progress at the moment

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
	}

}

?>