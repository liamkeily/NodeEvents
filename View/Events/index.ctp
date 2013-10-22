<div class="grid-4">
	<?php
	echo $this->Layout->sessionFlash();
	?>

	<?php if($date){ ?>

		<?php if($today){?>
		<h2>Todays Events</h2>
		<?php }else{ ?>
		<h2>Events on <?php echo date('jS F',$timestamp); ?></h2>
		<?php } ?>
		
		<?php
		if(count($dayevents) > 0){
		
			foreach($dayevents as $event){
			?>
				<p><b><?php echo $this->Html->link($event['Node']['title'],array('plugin'=>'nodes','controller'=>'nodes','action'=>'view','type'=>$event['Node']['type'],'slug'=>$event['Node']['slug'])); ?></b> - <?php echo $event['NodeEvent']['event_date']; ?></p>
				
				<?php if($event['Node']['excerpt']){ ?>
					<p>
					<?php echo $event['Node']['excerpt']; ?>
					</p>
				<?php } ?>
			<?php
			}
		}
		else
		{
		?>
			<p>There are no events on this date.</p>
		<?php
		}
		?>
		
		
	<?php } else { ?>
	
		<h2>Upcoming Events</h2>
		
		<?php
		if(count($upcomingevents) > 0){
		
			foreach($upcomingevents as $event){
			?>
				<p><b><?php echo $this->Html->link($event['Node']['title'],array('plugin'=>'nodes','controller'=>'nodes','action'=>'view','type'=>$event['Node']['type'],'slug'=>$event['Node']['slug'])); ?></b> - <?php echo $event['NodeEvent']['event_date']; ?></p>
				
				<?php if($event['Node']['excerpt']){ ?>
					<p>
					<?php echo $event['Node']['excerpt']; ?>
					</p>
				<?php } ?>
			<?php
			}
		}
		else
		{
		?>
			<p>There are no upcoming events</p>
		<?php
		}
		?>
		
	<?php } ?>
	
	
	
	
	
</div>
	
<div class="grid-4">

	<h2>Calendar</h2>

	<?php echo $this->element('cal'); ?>

	<p style="text-align:center;font-weight:bold;"><?php echo $this->Html->link('Show todays events',array('action'=>'index')); ?></p>
</div>

<div class="clear"></div>


