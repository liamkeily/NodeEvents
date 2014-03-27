<?php

app::uses('AppController','Controller');

class EventsController extends AppController {
    
    public $uses = array('Nodes.Node');
    
    public function index(){
        if(isset($this->request->query['date'])){
            $date = $this->request->query['date'];
        }
        else
        {
            $date = date('Y-m-d',time());
            $today = true;
        }
        
        
        $timestamp = strtotime($date);
        $month = date('m',$timestamp);
	$year = date('Y',$timestamp);
        
            $dayevents = $this->Node->find('all',array('conditions'=>array('NodeEvent.event_date'=>$date,'Node.status'=>1)));
            
            $monthevents = $this->Node->find('all',array('conditions'=>array('YEAR(NodeEvent.event_date)'=>$year,'MONTH(NodeEvent.event_date)'=>$month,'Node.status'=>1)));  

            $upcomingevents = $this->Node->find('all',array('limit'=>10,'order'=>'NodeEvent.event_date asc','conditions'=>array('NodeEvent.event_date >'=>date('Y-m-d',time()),'Node.status'=>1 )));
        
        
            $this->set(compact('today','timestamp','date','title','dayevents','monthevents','upcomingevents'));
		$listevents = $this->Node->find('all',array(
			'limit'=>200,
			'conditions'=>array(
				'Node.type'=>'event',
				'NodeEvent.event_date >='=>date('Y-m-d',time())
			),
			'order'=>'NodeEvent.event_date asc'
		));

		$this->set(compact('listevents'));

        
    }

    public function jsonevents($month=NULL,$year=NULL){
	if(!isset($month) || !isset($year)){
        	$month = date('m',time());
		$year = date('Y',time());
	}

        $monthevents = $this->Node->find('all',array('fields'=>array('NodeEvent.event_date','Node.id','Node.title'),'conditions'=>array('YEAR(NodeEvent.event_date)'=>$year,'MONTH(NodeEvent.event_date)'=>$month,'Node.status'=>1))); 
	
	$dates = array();

	foreach($monthevents as $event){
		$dates[] = $event['NodeEvent']['event_date'];
	}

	
	$this->set(compact('dates'));
	$this->layout = 'json/default';
    }
}
