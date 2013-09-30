<div class="grid_8">
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
	
<div class="grid_4">

	<h2>Calendar</h2>

	<div id="cal">

	</div>
	
	<p style="text-align:center;font-weight:bold;"><?php echo $this->Html->link('Show todays events',array('action'=>'index')); ?></p>
</div>

<div class="clear"></div>

<script>
// declare freeDays global
var freeDays = [];
 
// perform initial json request for free days
fetchFreeDays();

function fetchFreeDays(year, month)
{
	console.log('test');
 
    $.getJSON('<?php echo $this->Html->url(array('action'=>'jsonevents')); ?>/' + month + '/' + year, function(data){
         $.each(data, function(index, value) {
            freeDays.push(value.freeDate); // add this date to the freeDays array
        });
    });
}
 
 
// runs for every day displayed in datepicker, adds class and tooltip if matched to days in freeDays array
function highlightDays(date)
{
    for (var i = 0; i < freeDays.length; i++) {
      if (new Date(freeDays[i]).toString() == date.toString()) {
         return [true, 'free-day', 'no to-do items due']; // [0] = true | false if this day is selectable, [1] = class to add, [2] = tooltip to display
      }
    }
 
    return [true, ''];
}

$(function(){
	$('#cal').datepicker({
		inline:true,
		defaultDate:"<?php echo $date; ?>",
		dateFormat:"yy-mm-dd",
		onSelect: function(dateText, inst) { 
		    window.location = '?date=' + dateText;
		},
		changeMonth: true,
		changeYear: true,
		showOtherMonths: true,
		selectOtherMonths: true,
		altField: '#date',
		altFormat: 'yy-mm-dd',
		beforeShowDay: highlightDays,
		onChangeMonthYear: fetchFreeDays,
		firstDay: 1 // rows starts on Monday
	});
});
</script>
