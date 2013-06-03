<?php

echo $this->Form->input('NodeEvent.id');
echo '<div class="datepicker"></div>';
echo $this->Form->input('NodeEvent.event_date',array('type'=>'hidden','class'=>'datevalue'));
$this->Form->unlockField('NodeEvent.event_date');
?>
<script>
$(function(){
   $(".datepicker").datepicker({
    dateFormat:"yy-mm-dd",
    defaultDate:"<?php echo $this->data['NodeEvent']['event_date'];?>",
    onSelect: function(dateText,inst){
        $(".datevalue").val(dateText);
    }
    }); 
});
</script>