<?php  defined('C5_EXECUTE') or die("Access Denied.");
?>

<?php
	$path = getcwd() . '/blocks/events_calendar/events.json';
	$string = file_get_contents($path);
	$json_a = json_decode($string, true);

	$data = [];
	foreach($json_a as $event){
		if(!array_key_exists($event['Month'], $data)){
			$data[$event['Month']] = [];
		}
		$data[$event['Month']][] = $event;
	}
	
	foreach($data as $month => $events){
		?>
	<header class="section-header">
		<h1 class="section-header_title"><?php echo $month ?></h1>
		<hr class="section-header_line">
	</header>
	<div class="events-table_container">
		<table class="events-table">
			<tr><th>Date</th><th>Event</th><th>Info</th></tr>
			
			<?php foreach($events as $event){ ?>
			
			<tr>
				<td><?php echo $event['Days'] ?></td>
				<td><?php echo $event['Event'] ?></td>
				<td>
				<?php if(!is_numeric(substr($event['Site'], 0, 1))){ ?>
						<a href="<?php echo $event['Site']?>" target="_blank"><?php echo $event['Site']?></a>
				<?php } else { ?>
				<?php echo $event['Site']; } ?>
				</td>
			</tr>

			<?php } ?>
		</table>
	</div>
		<?php
	}
?>


