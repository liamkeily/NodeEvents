<div id="cal">

</div>

<script>
// declare freeDays global
var events = new Object();
events.eventDays = [];
events.calendar = $("#cal");

function fetchEventDays(year, month)
{
    $.ajax({
	url:'<?php echo $this->Html->url(array('plugin'=>'node_events','controller'=>'events','action'=>'jsonevents')); ?>/' + month + '/' + year,
	success:function(response){
		var dates = $.parseJSON(response);
		events.eventDays = [];
		for(var i in dates){
		    events.eventDays.push(dates[i]); // add this date to the freeDays array
		}
		events.calendar.datepicker("refresh");		
	}
    });

}
 
 
// runs for every day displayed in datepicker, adds class and tooltip if matched to days in freeDays array
function highlightDays(date)
{
    if(events.init != true){
	console.log('init');
	<?php if(!$date) $date = date('Y-m-d',time()); ?>
	var currentDate = new Date('<?php echo $date; ?>');
	fetchEventDays(currentDate.getFullYear(),currentDate.getMonth()+1);
	events.init = true;	
    }

    for (var i = 0; i < events.eventDays.length; i++) {
      if (new Date(events.eventDays[i]).getDate() == date.getDate() && new Date(events.eventDays[i]).getMonth() == date.getMonth()) {
		return [true, 'event-day', 'no to-do items due']; 
		// [0] = true | false if this day is selectable, [1] = class to add, [2] = tooltip to display
      }
    }
    return [true, ''];

}

$(function(){
	events.calendar.datepicker({
		inline:true,
		defaultDate:"<?php echo $date; ?>",
		dateFormat:"yy-mm-dd",
		onSelect: function(dateText, inst) { 
		    window.location = '<?php echo $this->Html->url(array('plugin'=>'node_events','controller'=>'events','action'=>'index')); ?>?date=' + dateText;
		},
		changeMonth: true,
		changeYear: true,
		showOtherMonths: true,
		selectOtherMonths: true,
		altField: '#date',
		altFormat: 'yy-mm-dd',
		beforeShowDay: highlightDays,
		onChangeMonthYear: fetchEventDays,
		firstDay: 1, // rows starts on Monday
	});


});
</script>
<style>
.ui-datepicker {
width:250px;
margin-bottom:15px;
}

.event-day a {
background:red;
}
</style>
