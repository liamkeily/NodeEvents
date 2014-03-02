	<div class="grid_4">
		<?php echo $this->element('side'); ?>

	</div>
	
	<div class="grid_8">

		<?php
		$month = '';
		$year = '';
		foreach($listevents as $event){
			$y = date('Y',strtotime($event['NodeEvent']['event_date']));
			$m = date('F',strtotime($event['NodeEvent']['event_date']));
			$d = date('dS',strtotime($event['NodeEvent']['event_date']));
			if($y != $year){
				$year = $y;
				echo '<h1>Upcoming Events in '.$year.'</h1>';
			}

			if($m != $month){
				$month = $m;
				echo '<h2>'.$month.'</h2>';
			}

			echo '<p>'.$this->Html->link('<span class="day">'.$d.'</span> '.$event['Node']['title'],array('plugin'=>'nodes','controller'=>'nodes','action'=>'view','type'=>$event['Node']['type'],'slug'=>$event['Node']['slug']),array('escape'=>false)).'</p>';	

		}
		?>

	</div>
