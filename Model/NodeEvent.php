<?php

App::uses('NodeEventsAppModel', 'NodeEvents.Model');

class NodeEvent extends NodeEventsAppModel {
 
	public $primaryKey = 'user_id';
	public $belongsTo = array(
	'Node' => array(
		'className' => 'Node',
                'foreignKey' => 'node_id'		  
	));

}
