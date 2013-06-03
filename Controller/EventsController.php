<?php

app::uses('AppController','Controller');

class EventsController extends AppController {
    
    public $uses = array('Nodes.Node');
    
    public function index(){
        
        if($this->request->query['date']){
            $date = $this->request->query['date'];
        }
        else
        {
            $date = date('Y-m-d',time());
            $today = true;
        }
        
        
        $timestamp = strtotime($date);
        $month = date('m',$timestamp);
        
            $dayevents = $this->Node->find('all',array('conditions'=>array('NodeEvent.event_date'=>$date,'Node.status'=>1)));
            
            $monthevents = $this->Node->find('all',array('conditions'=>array('MONTH(NodeEvent.event_date)'=>$month,'Node.status'=>1)));  

            $upcomingevents = $this->Node->find('all',array('limit'=>10,'order'=>'NodeEvent.event_date asc','conditions'=>array('NodeEvent.event_date >'=>date('Y-m-d',time()),'Node.status'=>1 )));
        
        
            $this->set(compact('today','timestamp','date','title','dayevents','monthevents','upcomingevents'));
        
    }
    
}
