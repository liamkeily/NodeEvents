<?php 
class NodeEventsSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $node_events = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'node_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'event_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

}
