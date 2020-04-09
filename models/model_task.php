<?php
Class Model_Task Extends Model_Base {

	public $id;
	public $user_name;
	public $e_mail;
	public $task;
	public $date_create;
	public $active_task;
	
	public function fieldsTable(){
		return array(
			'id' => 'Id',
			'user_name' => 'User Name',
			'e_mail' => 'E Mail',
			'task' => 'Task',
			'updata_admin' => 'Updata Admin',
			'date_create' => 'Date Create',
			'active_task' => 'Active Task',
		);
	}  
}

















 