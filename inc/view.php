<?php

class View {
	private $tpl;
	protected $fields=array();
	
	function __construct($tpl) {
		$this->tpl=$tpl;
	}

	public function __set($name, $value) {
		$this->fields[$name]=$value;
        //echo "Setting '$name' to '$value'<br>";
    }
	
	public function __unset($name) {
		if(isset($this->name)) return;
		unset($this->fields[$name]);
		//echo "Unsetting '$name'\n";
    }
    
    public function display() {
		$data=$this->fields;
		include($this->tpl);
	}
    
}

?>