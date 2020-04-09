<?php
Class Model_User Extends Model_Base {
	
	public $id;
	public $name;
	public $password;
	
    public function fieldsTable(){
        return array(
			'id' => 'Id', 
			'name' => 'Name',
			'password' => 'Password'
		);
    }       
}
