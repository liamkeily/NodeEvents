<?php

App::uses('Component', 'Controller');

/**
 * Note Attachments Component
 *
 * @author Liam Keily
 * @package Croogo.NodeAttachments.Controller.Component
 */
class NodeEventComponent extends Component {
	
	
	public function startup(Controller $controller){
	}
	
	public function beforeRender(Controller $controller){
		
		//$controller->NodeEvent->node_id = $controller->Node->id;
		
		if(isset($controller->viewVars['type']['Type']['alias']) &&  $controller->viewVars['type']['Type']['alias'] == 'event'){
		
			Croogo::hookAdminBox('Nodes/admin_add','Event Date','NodeEvents.NodeEvent');
			Croogo::hookAdminBox('Nodes/admin_edit','Event Date','NodeEvents.NodeEvent');
			
		}
		
		if(isset($controller->viewVars['node']['Node']['id'])){
			$node_event = $controller->Node->NodeEvent->find('first',array('conditions'=>array('node_id'=>$controller->viewVars['node']['Node']['id'])));

			$controller->set(compact('node_event'));
		}
		
	}

}
