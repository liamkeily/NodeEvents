<?php
/**
 * NodeEvents Plugin Activation
 *
 * @package  Croogo
 * @version  1.5
 * @author   Liam Keily
 */

App::uses('ClassRegistry','Utility');

class NodeEventsActivation {
  
   public function beforeActivation(&$controller) {
    return true;
  }

    public function onActivation(&$controller) {
      
      $controller->Croogo->addAco('NodeEvents'); 
      $controller->Croogo->addAco('NodeEvents/index');

      $this->Type = ClassRegistry::init('Type');

      $count = $this->Type->find('count',array(
	'conditions'=>array(
		'alias'=>'event'
 	)
      ));
      if($count == 0){
	$this->Type->save(array(
		'Type' =>array(
			'alias'=>'event',
			'title'=>'Event',
			'comment_status'=>'0'
		)
	));
      }
      
      $this->_schema('create');
    }
    
    public function beforeDeactivation(&$controller) {
    return true;
  }
  
    public function onDeactivation(&$controller) {


      $this->Type = ClassRegistry::init('Type');

      $this->Type->deleteAll(
	array(
	'Type.alias'=>'event'
	)
      );

      $controller->Croogo->removeAco('NodeEvents');
      $this->_schema('drop');
  }
	
  protected function _schema($action = 'create') {
	  App::uses('File', 'Utility');
	  App::import('Model', 'CakeSchema', false);
	  App::import('Model', 'ConnectionManager');

	  $db = ConnectionManager::getDataSource('default');
	  if(!$db->isConnected()) {
		  $this->Session->setFlash(__('Could not connect to database.'), 'default', array('class' => 'error'));
	  } else {
		  CakePlugin::load('NodeEvents'); //is there a better way to do this?
		  $schema =& new CakeSchema(array('name'=>'NodeEvents', 'plugin'=>'NodeEvents'));
		  $schema = $schema->load();
		  foreach($schema->tables as $table => $fields) {
		    if($action == 'create') {
			  $sql = $db->createSchema($schema, $table);
		    } else {
		    $sql = $db->dropSchema($schema, $table);
		    }
			  $db->execute($sql);
		  }
	  }
  }
  
}
