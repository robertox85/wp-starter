
<?php


$extra = get_query_var('extra');
$day = get_query_var('day');
$eventi = get_query_var('eventi');
$cellName = get_query_var('cellName');


?>


<div class="card--container color__primary child">
 
 <div class="card--header ">
 <p class="card--header__event--day number "> <?php echo $cellName; ?> <?php echo $day; ?> </p>
 </div>
 
 <div class="card--body ">
  <?php 
    
    if(!empty($eventi)){
        foreach ( $eventi as $evento ) {
          $getPostCustom = get_field_objects($evento->ID); // Get all the data 
          // $color = (is_organizzato($evento->ID)) ? 'color__primary' : 'color__secondary';
          // $border_color = (is_organizzato($evento->ID)) ? 'border__color--primary' : 'border__color--secondary';
          // $text = (is_organizzato($evento->ID)) ? 'L\'evento è organizzato da Milano Luiss Hub' : 'L\'evento è ospitato da Milano Luiss Hub';
          $start_date  = (null != $evento->data_inizio) ? $evento->data_inizio :  $evento->_event_start_date;
          $end_date  = (null != $evento->data_fine) ? $evento->data_fine :        $evento->_event_end_date;
          // $is_multiple = (is_multiple_days_event($evento->ID)) ? 'true' : 'false';
          ?>
          <a href="<?php echo get_permalink($evento->ID) ?>" 
             class="card--body__event event-day event-<?php echo $evento->ID ?>" 
             data-is_multiple = "<?php //echo $is_multiple ?>"
             data-event_id = <?php echo $evento->ID ?>
             data-start_date = <?php echo date('d-m-y', strtotime($start_date)) ?>
             data-end_date = <?php echo date('d-m-y', strtotime($end_date)) ?>
             target="_blank">

              <p class="event--hours <?php //echo $color ?> label">
              
              <?php 
              
              if ( !empty(get_post_meta( $evento->ID, 'ora_inizio', true )) ){
                echo 'Ore' . date('H:i', strtotime(get_post_meta( $evento->ID, 'ora_inizio', true )));
              }

              if ( !empty(get_post_meta( $evento->ID, 'ora_fine', true )) ){
                echo ' - ' . date('H:i', strtotime(get_post_meta( $evento->ID, 'ora_fine', true )));
              }
              ?>
            </p>

            <h5 class="event--title <?php //echo $color ?>"><?php echo $evento->post_title; ?></h5>
          </a>
          <?php
            
        }
    }
    
  
  ?>
 </div>
 
</div>