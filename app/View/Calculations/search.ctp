<div class="col-md-12">
<h1><?php echo __('Journaal');?></h1>
	<table class="table table-striped table-bordered table-condensed">
	<tr>
			<th class="number"><?php echo $this->Paginator->sort('grootboek_id');?></th>
			<th><?php echo $this->Paginator->sort('omschrijving');?></th>
			<th><?php echo $this->Paginator->sort('boekdatum');?></th>
			<th class="currency"><?php echo $this->Paginator->sort('debet');?></th>
			<th class="currency"><?php echo $this->Paginator->sort('credit');?></th>
	</tr>
	<tr>
			<th><input id="Grootboek-nummer" class="searchfilters col-md-12" onkeypress="setfilter(event)" type="text"> </th>
			<th><input id="Calculation-omschrijving" class="searchfilters col-md-12" onkeypress="setfilter(event)" type="text"></th>
			<th></th>
			<th><input id="Calculation-debet" class="searchfilters col-md-12 currency" onkeypress="setfilter(event)" type="text"></th>
			<th><input id="Calculation-credit" class="searchfilters col-md-12 currency" onkeypress="setfilter(event)" type="text"></th>
	</tr>
	<?php
	$i = 0;
	foreach ($calculations as $calculation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="number"><?php echo $calculation['Grootboek']['nummer']; ?></td>
		<td><?php echo $calculation['Calculation']['omschrijving']; ?>&nbsp;</td>
		<td><?php echo $calculation['Calculation']['boekdatum']; ?>&nbsp;</td>
		<td class="currency"><?php echo $calculation['Calculation']['debet']; ?>&nbsp;</td>
		<td class="currency"><?php echo $calculation['Calculation']['credit']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>

</div>
<script>

$( "#Grootboek-omschrijving" ).autocomplete({
	source: "/search/journaal.json?fields[]=omschrijving&value=omschrijving&label=omschrijving&termfield=omschrijving",
    minLength: 1,
 });
	

$( "#Grootboek-nummer" ).autocomplete({
    source: "/search/grootboek.json?fields[]=nummer&fields[]=id&value=nummer&label=nummer&termfield=nummer",
    minLength: 1,
 });

$( "#Calculation-omschrijving" ).autocomplete({
    source: "/search/journaal.json?fields[]=omschrijving&fields[]=id&value=omschrijving&label=omschrijving&termfield=omschrijving",
    minLength: 1,
 }); 
 
function retrieveGetValues() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
 
$(function() {
	var get = retrieveGetValues();

	if("Grootboek.nummer" in get){
		$('#Grootboek-nummer').val(get["Grootboek.nummer" ])
	}

	if("Calculation.omschrijving" in get){
		$('#Calculation-omschrijving').val(get["Calculation.omschrijving" ].replace(/%20/g, " "))
	}

	if("Calculation.debet" in get){
		$('#Calculation-debet').val(get["Calculation.debet" ])
	}

	if("Calculation.credit" in get){
		$('#Calculation-credit').val(get["Calculation.credit" ])
	}
});

function setfilter(e){
	var code = (e.keyCode ? e.keyCode : e.which);
	var filter='?';
	
	if($('#Grootboek-nummer').val().length > 0){
		filter = '?Grootboek.nummer='+$('#Grootboek-nummer').val();
	}

	if($('#Calculation-omschrijving').val().length > 0){

		if(filter.length > 3){
			filter =  filter + '&Calculation.omschrijving='+$('#Calculation-omschrijving').val();
		}else{
			filter = '?Calculation.omschrijving='+$('#Calculation-omschrijving').val();
		}
	}

	if($('#Calculation-debet').val().length > 0){

		if(filter.length > 3){
			filter =  filter + '&Calculation.debet='+$('#Calculation-debet').val();
		}else{
			filter = '?Calculation.debet='+$('#Calculation-debet').val();
		}
	}

	if($('#Calculation-credit').val().length > 0){

		if(filter.length > 3){
			filter =  filter + '&Calculation.credit='+$('#Calculation-credit').val();
		}else{
			filter = '?Calculation.credit='+$('#Calculation-credit').val();
		}
	}	
	
	if(code == 13) { //Enter keycode
		window.location = filter;
	}	
	
}
</script>