<?php

$prev_month = get_query_var('prev_month');
$prev_year = get_query_var('prev_year');
$current_month = get_query_var('current_month');
$next_month = get_query_var('next_month');
$next_year = get_query_var('next_year');
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
                <a class="button button--icon button--simple prev" href="#" 
                    data-prev-month="<?php echo $prev_month; ?>"
                    data-prev-year="<?php echo $prev_year; ?>">
                    <i class="fa fa-chevron-left"></i>
                </a>
                <h2 class="">
                    <select name="month" id="month" class="border-0 text-capitalize section color__standard">
                        <?php echo $calendario->get_months_select($current_month); ?>
                    </select>
                    <select name="year" id="year" class="border-0 text-capitalize section color__standard">
                        <?php echo $calendario->get_years_select($current_month); ?>
                    </select>
                </h2>
                <!-- le frecce di navigazione non mi servono su eventi -->
                <a class="button button--icon button--simple next" href="#" data-next-month="<?php echo $next_month; ?>"
                    data-next-year="<?php echo $next_year; ?>">
                    <i class="fa fa-chevron-right"></i>
                </a>
            </div>
            <a href="#" id="today" class="col-12 color__primary text-center d-block"
                name="today"><small>Oggi</small></a>
        </div>
        <div class="col-12">
            <hr class="hr--calendar">
        </div>
    </div>
</div>