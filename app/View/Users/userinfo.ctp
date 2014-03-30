<div class="users">
<h2>Serverside detectie</h2>
	<table class="table table-striped table-bordered table-condensed">

		<tr>
			<td><strong>Uw IP adres</strong></td>
			<td><?php echo $userIP; ?></td>
		</tr>
	
		<tr>
			<td><strong>Besturingsysteem</strong></td>
			<td><?php echo $systemInfo['os']['fullName']; ?></td>
		</tr>
		
		<tr>
			<td><strong>Webbrowser</strong></td>
			<td><?php echo $systemInfo['browser']['fullname']; ?></td>
		</tr>

		<tr>
			<td><strong>Useragent</strong></td>
			<td><?php echo $userAgent; ?></td>
		</tr>
				
	</table>

	<h2>Clientside detectie</h2>
	<table class="table table-striped table-bordered table-condensed">

		<tr>
			<td><strong>Uw vensterformaat</strong></td>
			<td><span class="windowsize">N/A</span></td>
		</tr>

		<tr>
			<td><strong>Uw schermresolutie</strong></td>
			<td><span class="screensize">N/A</span></td>
		</tr>		
	</table>	
	
	<h2>Locatie bepaling</h2>
	<table class="table table-striped table-bordered table-condensed">

		<tr>
			<td><strong>Uw land</strong></td>
			<td><?php echo $locationInfo['country']; ?></td>		
		
			<td><strong>Uw provincie / regio</strong></td>
			<td><?php echo $locationInfo['regionName']; ?></td>
			
			<td><strong>Uw stad</strong></td>
			<td><?php echo $locationInfo['city']; ?></td>		
			
			<td><strong>Uw tijdzone</strong></td>
			<td><?php echo $locationInfo['timezone']; ?></td>	
			
			<td><strong>Uw ISP</strong></td>
			<td><?php echo $locationInfo['isp']; ?> / <?php echo $locationInfo['org']; ?></td>							
		</tr>

		<tr>
			<td><strong>Uw schermresolutie</strong></td>
			<td><span class="screensize">N/A</span></td>
		</tr>		
	</table>		
	
</div>


<script>
var width = $(window).width(), height = $(window).height();
$('.windowsize').text(width+' X '+height);

$('.screensize').text(screen.width+' X '+screen.height);
</script>