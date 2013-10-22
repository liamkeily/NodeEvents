
	<div id="cal">

	</div>
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
