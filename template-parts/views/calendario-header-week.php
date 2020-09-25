<?php


if(isset($_GET['view']) && $_GET['view'] == 'week'){
	
	$dt = new DateTime;

	if (isset($_GET['year']) && isset($_GET['week'])) {

		$dt->setISODate($_GET['year'], $_GET['week']);

	} else {
		
		$dt->setISODate($dt->format('o'), $dt->format('W'));

	}

	
	$year = $dt->format('o');
	$week = $dt->format('W');
	$month = $dt->format('F');

}else {

	$week = get_query_var( 'week' );
	$year = get_query_var( 'year' );
	
	$dt = new DateTime;
	$dt->setISODate($year, $week);
	$month = $dt->format('F');
	
}


$calendario = new PHPCalendario();


?>


<div class="container text-right">
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="<?php echo get_bloginfo('url') ?>/eventi/" id="monthly-view" type="button" class="btn btn-primary">Mensile</a>
        <a href="<?php echo get_bloginfo('url') ?>/eventi/?view=week" id="weekly-view" type="button" class="btn btn-primary active">Settimanale</a>
    </div>
</div>


<div id="calendar-header" class="container">
	<div class="row">
		<div class="col-12">
			<div class="d-flex justify-content-between section--calendar align-items-baseline ">
				<!-- le frecce di navigazione non mi servono su eventi -->
				<a class="button button--icon button--simple prev" 
					href="<?php echo $_SERVER['PHP_SELF'].'?view=week&week='.($week-1).'&year='.$year; ?>"
					data-prev-week="<?php echo ($week-1); ?>"
					data-prev-year="<?php echo $year; ?>">
					<i class="fa fa-chevron-left"></i>
				</a>
				<h2 class="">
					<?php echo date_i18n('F', strtotime("$year$month")) ; ?>
					
				</h2>
				<!-- le frecce di navigazione non mi servono su eventi -->
				<a class="button button--icon button--simple next" href="<?php echo $_SERVER['PHP_SELF'].'?view=week&week='.($week+1).'&year='.$year; ?>" 
					data-next-week="<?php echo ($week+1); ?>"
					data-next-year="<?php echo $year; ?>">
					<i class="fa fa-chevron-right"></i>
				</a>
			</div>
			<a href="#" 
				id="today" 
				class="col-12 color__primary text-center d-block" 
				name="today" 
				data-next-week="<?php echo date('W'); ?>"
				data-next-year="<?php echo date('Y'); ?>"

				><small>Oggi</small></a>
		</div>
		<div class="col-12">
			<hr class="hr--calendar">
		</div>
	</div>
</div>
