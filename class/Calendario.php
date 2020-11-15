<?php

/**
 * @ Author: Your name
 * @ Create Time: 2020-09-12 07:51:52
 * @ Modified by: Your name
 * @ Modified time: 2020-10-05 19:51:33
 * @ Description:
 */
class Calendario {

	/**
	 * Week_day_name
	 *
	 * @var array $days_of_the_week
	 */
	private $days_of_the_week = array( 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica' );

	/**
	 * Current day.
	 *
	 * @var int
	 */
	private $current_day = 0;

	/**
	 * Current week.
	 *
	 * @var int
	 */
	private $current_week = 0;

	/**
	 * Current_month.
	 *
	 * @var int
	 */

	private $current_month = 0;

	/**
	 * Current_year.
	 *
	 * @var int
	 */
	private $current_year = 0;

	/**
	 * Current_month_start.
	 *
	 * @var int
	 */
	private $current_month_start = null;

	/**
	 * Current_month_days_length.
	 *
	 * @var int
	 */
	private $current_month_days_length = null;

	/**
	 * Undocumented variable
	 *
	 * @var date $next_day_of_week. I giorni della settimana.
	 */
	private $next_day_of_week = null;

	/**
	 * Undocumented variable
	 *
	 * @var boolean
	 */
	private $is_weekly_view = false;


	/**
	 * Undocumented function
	 */
	public function __construct() {

		$this->current_year  = date( 'Y', time() );
		$this->current_month = date( 'm', time() );

		$dt = new DateTime();
		$dt->setISODate( $dt->format( 'o' ), $dt->format( 'W' ) );

		$this->current_week = $dt->format( 'W' );

		if ( isset($_POST[ 'year' ] ) && isset($_POST[ 'week' ] ) ) { // phpcs:ignore
			$this->is_weekly_view = true; // phpcs:ignore
			$this->current_week   = $_POST[ 'week' ]; // phpcs:ignore
			$this->current_year   = $_POST[ 'year' ]; // phpcs:ignore
		}

		if ( isset($_GET[ 'view' ] ) && empty( $_GET[ 'week' ] ) ) { // phpcs:ignore
			$this->is_weekly_view = true; // phpcs:ignore
		}

		if ( ! empty( $_POST['year'] ) ) {
			$this->current_year = $_POST['year'];
		}
		if ( ! empty( $_POST['month'] ) ) {
			$this->current_month = $_POST['month'];
		}

		$this->current_month_start       = $this->current_year . '-' . $this->current_month . '-01';
		$this->current_month_days_length = gmdate( 't', strtotime( $this->current_month_start ) );
	}

	/**
	 * Undocumented function.
	 */
	public function get_calendar_html() {

		ob_start();

		$calendar_html = '<div id="calendar-outer" class="container-fluid ">';

		$calendar_html .= '<div id="calendar-inner" class="">';

		$calendar_html .= $this->get_calendar_navigation();

		$calendar_html .= $this->get_calendar_body_html();

		$calendar_html .= '</div>';

		$calendar_html .= '</div>';

		$calendar_html .= ob_get_contents();

		ob_end_clean();

		return $calendar_html;
	}

	/**
	 * Undocumented function .
	 */
	public function get_calendar_body_html() {
		ob_start();

		$calendar_html = '<ul class="week-name-title row">' . $this->get_days_of_the_week() . '</ul>';

		if ( ( isset( $_GET['view'] ) && $_GET['view'] == 'week' ) || $this->is_weekly_view ) {

			$calendar_html .= '<div class="week-day-cell row">' . $this->get_single_week_days() . '</div>';

		} else {
			$calendar_html .= '<div class="week-day-cell row">' . $this->get_week_days() . '</div>';
		}

		$calendar_html .= '<ul class="week-name-title foot row">' . $this->get_days_of_the_week() . '</ul>';

		$calendar_html .= ob_get_contents();

		ob_end_clean();

		return $calendar_html;
	}

	/**
	 * Undocumented function
	 */
	public function get_calendar_navigation() {

		ob_start();
		$content = '';

		$prev_month_year       = gmdate( 'm,Y', strtotime( $this->current_month_start . ' -1 Month' ) );
		$prev_month_year_array = explode( ',', $prev_month_year );

		$next_month_year       = gmdate( 'm,Y', strtotime( $this->current_month_start . ' +1 Month' ) );
		$next_month_year_array = explode( ',', $next_month_year );

		set_query_var( 'prev_month', $prev_month_year_array[0] );
		set_query_var( 'prev_year', $prev_month_year_array[1] );
		set_query_var( 'current_month', $this->current_month_start );
		set_query_var( 'next_month', $next_month_year_array[0] );
		set_query_var( 'next_year', $next_month_year_array[1] );

		if ( ( isset( $_GET['view'] ) && $_GET['view'] == 'week' ) || $this->is_weekly_view ) {

			set_query_var( 'week', $this->current_week );
			set_query_var( 'year', $this->current_year );
			set_query_var( 'month', $this->current_month );

			$content .= get_template_part( 'template-parts/views/calendario', 'header-week' );

		} else {
			$content .= get_template_part( 'template-parts/views/calendario', 'header' );
		}

		$content .= ob_get_contents();

		ob_end_clean();
		return $content;
	}

	/**
	 * Undocumented function
	 *
	 * @param int $active_month mese attivo.
	 */
	public function get_months_select( $active_month ) {

		$months       = array(
			'Gennaio',
			'Febbraio',
			'Marzo',
			'Aprile',
			'Maggio',
			'Giugno',
			'Luglio',
			'Agosto',
			'Settembre',
			'Ottobre',
			'Novembre',
			'Dicembre',
		);
		$html         = '';
		$selected     = '';
		$active_month = (int) gmdate( 'm', strtotime( $active_month ) );
		$index        = 1;

		foreach ( $months as $key => $value ) {
			if ( $active_month === $index ) {
				$selected = 'selected';
			}

			$html    .= '<option value="' . str_pad( $index, 2, '0', STR_PAD_LEFT ) . '" ' . $selected . '>' . $value . '</option>';
			$selected = '';
			$index++;
		}
		return $html;
	}
	/**
	 * Undocumented function.
	 *
	 * @param [type] $active_month dd.
	 */
	public function get_years_select( $active_month ) {
		$from        = 2000;
		$to          = 2121;
		$html        = '';
		$selected    = '';
		$active_year = (int) gmdate( 'Y', strtotime( $active_month ) );

		while ( $from < $to ) {
			if ( $active_year === $from ) {
				$selected = 'selected';
			}
			$html    .= '<option value="' . $from . '" ' . $selected . '>' . $from . '</option>';
			$selected = '';
			$from++;
		}

		return $html;
	}
	/**
	 * Undocumented function
	 */
	public function get_days_of_the_week() {
		ob_start();
		$days_of_the_week = '';
		foreach ( $this->days_of_the_week as $dayname ) {
			$days_of_the_week .= '<li>' . $dayname . '</li>';
		}
		$days_of_the_week .= ob_get_contents();
		ob_end_clean();

		return $days_of_the_week;
	}
	/**
	 * Undocumented function
	 *
	 * @param [string] $string timestamp.
	 */
	public function is_timestamp( $string ) {
		try {
			new dateTime( '@' . $string );
		} catch ( Exception $e ) {
			return false;
		}
		return true;
	}
	/**
	 * Undocumented function
	 *
	 * @param [string] $start timestamp.
	 * @param [string] $end timestamp.
	 * @param string   $format timestamp.
	 */
	public function get_dates_from_range( $start, $end, $format = 'Y-m-d ' ) {
		try {
			$array = array();
			if ( ! empty( $start ) ) {
				$interval = new dateInterval( 'P1D' );

				if ( ! empty( $end ) ) {
					$real_end = new dateTime( $end );
					$real_end->add( $interval );
					$period = new datePeriod( new dateTime( $start ), $interval, $real_end );
				} else {
					$real_end = new dateTime( $start );
					$real_end->add( $interval );
					$period = new datePeriod( new dateTime( $start ), $interval, $real_end );
				}

				foreach ( $period as $date ) {
					if ( $date instanceof dateTime ) {
						$array[] = $date->format( $format );
					}
				}
			}

			return $array;
		} catch ( Exception $e ) {
			return $e->getMessage();
		}
	}
	/**
	 * Undocumented function
	 *
	 * @param array $myarr date.
	 * @return void
	 */
	public function erase_val( &$myarr ) {

		if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
			$myarr = array_map( create_function( '$n', 'return null;' ), $myarr ); // phpcs:ignore
		} else {

			$myarr = array_map(
				function ( $n ) {
					$n = null;

					return $n;
				},
				$myarr
			);
		}
	}
	/**
	 * Undocumented function
	 */
	public function get_week_days() {
		ob_start();

		$weeks_in_month        = $this->get_weeks_in_month();
		$first_day_of_the_week = gmdate( 'N', strtotime( $this->current_month_start ) );
		$last_day_of_the_month = gmdate( 't', strtotime( $this->current_month_start ) );
		$week_days             = '';
		$last_month            = false;
		$next_month            = false;
		$counter_last_month    = 0;
		$counter_next_month    = 1;
		$all                   = $this->get_all_events_by_month();

		for ( $i = 0; $i < $weeks_in_month; $i++ ) {
			for ( $j = 1; $j <= 7; $j++ ) {
				$extra      = '';
				$cell_index = $i * 7 + $j;

				$cell_value = null;

				if ( $cell_index === (int) $first_day_of_the_week ) {
					$this->current_day = 1;
				}

				if ( $this->current_day >= 1 ) {
					$data = $this->current_year . $this->current_month . str_pad( $this->current_day, 2, '0', STR_PAD_LEFT );
				}

				// Mese dopo.
				if ( $this->current_day > (int) $this->current_month_days_length ) {

					$end_of_month    = gmdate( 'Y-m-t', strtotime( $this->current_month_start ) );
					$next_sunday     = gmdate( 'Y-m-d', strtotime( 'first sunday of +1 month', strtotime( $this->current_month_start ) ) );
					$next_month_days = $this->get_dates_from_range( $end_of_month, $next_sunday );
					$next_month      = true;

					if ( $next_month && ( $counter_next_month < count( $next_month_days ) ) ) {
						$cell_value = gmdate( 'd', strtotime( $next_month_days[ $counter_next_month ] ) );
						$data       = gmdate( 'Ymd', strtotime( $next_month_days[ $counter_next_month ] ) );
					}

					if ( count( $next_month_days ) === $counter_next_month ) {
						$next_month = false;
					}

					$extra = 'extra';
					$counter_next_month++;
				}

				if ( ! empty( $this->current_day ) && $this->current_day <= (int) $this->current_month_days_length ) {

					$cell_value = $this->current_day;
					$this->current_day++;
				}

				// Mese prima.
				if ( $cell_index < intval( $first_day_of_the_week ) ) {

					$start_of_month  = gmdate( 'Y-m-d', strtotime( $this->current_month_start ) );
					$past_monday     = gmdate( 'Y-m-d', strtotime( 'last monday of -1 month', strtotime( $this->current_month_start ) ) );
					$last_month_days = $this->get_dates_from_range( $past_monday, $start_of_month );
					$last_month      = true;

					if ( $last_month && ( $counter_last_month < count( $last_month_days ) ) ) {
						$cell_value = gmdate( 'd', strtotime( $last_month_days [ $counter_last_month ] ) );
						$data       = gmdate( 'Ymd', strtotime( $last_month_days [ $counter_last_month ] ) );
					}

					if ( count( $last_month_days ) === $counter_last_month ) {
						$counter_last_month = false;
					}

					$extra = 'extra';

					$counter_last_month++;
				}

				set_query_var( 'extra', $extra );
				set_query_var( 'day', $cell_value );
				set_query_var( 'eventi', $all[ $data ] );

				$week_days .= get_template_part( 'template-parts/views/calendario', 'day' );
			}
		}
		$week_days .= ob_get_contents();
		ob_end_clean();

		return $week_days;
	}


	public function get_single_week_days() {
		ob_start();

		// $ts = strtotime(date('Y-m-d'));
		// $settimana_corrente = (date('w', $ts) == 0) ? $ts : strtotime('last monday', $ts);
		// $start_date = date('Y-m-d', $settimana_corrente);
		// $end_date = date('Y-m-d', strtotime('next sunday', $settimana_corrente));

		// $ts                   = date( 'Y-m-d', strtotime( $this->current_week ));
		// $d                    = date( 'w', $ts );
		// $settimana_corrente   = ( date( 'w', $ts ) == 1 ) ? $ts : strtotime( 'last monday', $ts );
		// $start_date           = date( 'Ymd', $settimana_corrente );
		// $end_date             = date( 'Ymd', strtotime( 'next sunday', $settimana_corrente ) );
		// $last_week            = false;
		// $next_week            = false;
		// $counter_last_week    = 0;
		// $counter_next_week    = 1;
		$all       = $this->get_all_events_by_week();
		$week_days = '';

		// $this->next_day_of_week = $start_date;

		$dt = new DateTime();
		$dt->setISODate( $this->current_year, $this->current_week );
		$year = $dt->format( 'o' );
		$week = $dt->format( 'W' );

		do {
			// echo "<td>" . $dt->format('l') . "<br>" . $dt->format('d M') . "</td>\n";

			set_query_var( 'eventi', $all[ $dt->format( 'Ymd' ) ] );
			set_query_var( 'day', date( 'd', strtotime( $dt->format( 'Ymd' ) ) ) );

			$week_days .= get_template_part( 'template-parts/views/calendario', 'day' );

			$dt->modify( '+1 day' );

		} while ( $week == $dt->format( 'W' ) );

		$week_days .= ob_get_contents();
		ob_end_clean();

		return $week_days;
	}

	public function get_all_events_by_week() {

		$dt = new DateTime();
		$dt->setISODate( $this->current_year, $this->current_week );
		$year = $dt->format( 'o' );
		$week = $dt->format( 'W' );

		$start = gmdate( 'Ymd', strtotime( 'monday this week', strtotime( $dt->format( 'Ymd' ) ) ) );
		$end   = gmdate( 'Ymd', strtotime( 'sunday this week', strtotime( $dt->format( 'Ymd' ) ) ) );

		$range = $this->get_dates_from_range( $start, $end, $format = 'Ymd' );
		$array = array_flip( $range );
		$this->erase_val( $array );

		$eventi = get_posts(
			array(
				'post_type'      => array( 'evento' ),
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'data_inizio',
				'order'          => 'ASC',
				'meta_query'     => array(
					'relation' => 'AND',
					array(
						'key'     => 'data_inizio',
						'value'   => array( $start, $end ),
						'compare' => 'BETWEEN',
						'type'    => 'date',
					),
					array(
						'key'     => 'evento_ripetibile_evento_ripetibile_toggle',
						'value'   => '0',
						'compare' => '==', // not really needed, this is the default.
					),
				),
			)
		);

		$eventi_ripetibili = get_posts(
			array(
				'post_type'      => array( 'evento' ),
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'data_inizio',
				'order'          => 'ASC',
				'meta_query'     => array(
					'relation' => 'AND',
					array(
						'key'     => 'evento_ripetibile_evento_ripetibile_toggle',
						'value'   => '1',
						'compare' => '==', // not really needed, this is the default.
					),
				),
			)
		);

		// $merge = array_merge( $eventi, $post );

		foreach ( $eventi as $evento ) {

			if ( 'post' === $evento->post_type ) {
				$start_date = $evento->post_date;
				$end_date   = $evento->post_date;
			}

			if ( in_array( $evento->post_type, array( 'evento', 'event' ), true ) ) {
				$start_date = ( null !== $evento->data_inizio ) ? $evento->data_inizio : $evento->_event_start_date;
				$end_date   = ( null !== $evento->data_fine ) ? $evento->data_fine : $evento->_event_end_date;
			}

			$range_data = $this->get_dates_from_range( $start_date, $end_date, $format = 'Ymd' );
			foreach ( $range_data as $data ) {
				$array[ $data ][] = $evento;
			}
		}

		foreach ( $eventi_ripetibili as $evento ) {

			if ( in_array( $evento->post_type, array( 'evento' ), true ) ) {
				$start_date = ( null !== $evento->data_inizio ) ? $evento->data_inizio : $evento->_event_start_date;
				$end_date   = ( null !== $evento->evento_ripetibile_evento_ripetibile_fine ) ? $evento->evento_ripetibile_evento_ripetibile_fine : $evento->evento_ripetibile_evento_ripetibile_fine;
				$giorno_ripetizione = date( 'N', strtotime( $start_date ) );
			}

			$range_data = $this->get_dates_from_range( $start_date, $end_date, $format = 'Ymd' );
			foreach ( $range_data as $data ) {
				$questa_data = date( 'N', strtotime( $data ) );
				if ( $questa_data === $giorno_ripetizione ) {
					$array[ $data ][] = $evento;
				}
			}
		}

		$array = $array;
		return $array;
	}

	/**
	 * Get all events by month.
	 *
	 * @return array of events.
	 */
	public function get_all_events_by_month() {

		$start = gmdate( 'Ymd', strtotime( 'last monday of -1 month', strtotime( $this->current_month_start ) ) );
		$end   = gmdate( 'Ymd', strtotime( 'first sunday of +1 month', strtotime( $this->current_month_start ) ) );

		$start2 = gmdate( 'Y-m-d', strtotime( 'last monday of -1 month', strtotime( $this->current_month_start ) ) );
		$end2   = gmdate( 'Y-m-d', strtotime( 'first sunday of +1 month', strtotime( $this->current_month_start ) ) );

		$range = $this->get_dates_from_range( $start, $end, $format = 'Ymd' );
		$array = array_flip( $range );
		$this->erase_val( $array );

		$eventi = get_posts(
			array(
				'post_type'      => array( 'evento' ),
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'data_inizio',
				'order'          => 'ASC',
				'meta_query'     => array(
					'relation' => 'AND',
					array(
						'key'     => 'data_inizio',
						'value'   => array( $start, $end ),
						'compare' => 'BETWEEN',
						'type'    => 'date',
					),
					array(
						'key'     => 'evento_ripetibile_evento_ripetibile_toggle',
						'value'   => '0',
						'compare' => '==', // not really needed, this is the default.
					),
				),
			)
		);

		$eventi_ripetibili = get_posts(
			array(
				'post_type'      => array( 'evento' ),
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'data_inizio',
				'order'          => 'ASC',
				'meta_query'     => array(
					'relation' => 'AND',
					array(
						'key'     => 'evento_ripetibile_evento_ripetibile_toggle',
						'value'   => '1',
						'compare' => '==', // not really needed, this is the default.
					),
				),
			)
		);

		// $merge = array_merge( $eventi, $post );

		foreach ( $eventi as $evento ) {

			if ( 'post' === $evento->post_type ) {
				$start_date = $evento->post_date;
				$end_date   = $evento->post_date;
			}

			if ( in_array( $evento->post_type, array( 'evento', 'event' ), true ) ) {
				$start_date = ( null !== $evento->data_inizio ) ? $evento->data_inizio : $evento->_event_start_date;
				$end_date   = ( null !== $evento->data_fine ) ? $evento->data_fine : $evento->_event_end_date;
			}

			$range_data = $this->get_dates_from_range( $start_date, $end_date, $format = 'Ymd' );
			foreach ( $range_data as $data ) {
				$array[ $data ][] = $evento;
			}
		}

		foreach ( $eventi_ripetibili as $evento ) {

			if ( in_array( $evento->post_type, array( 'evento' ), true ) ) {
				$start_date = ( null !== $evento->data_inizio ) ? $evento->data_inizio : $evento->_event_start_date;
				$end_date   = ( null !== $evento->evento_ripetibile_evento_ripetibile_fine ) ? $evento->evento_ripetibile_evento_ripetibile_fine : $evento->evento_ripetibile_evento_ripetibile_fine;
				$giorno_ripetizione = date( 'N', strtotime( $start_date ) );
			}

			$range_data = $this->get_dates_from_range( $start_date, $end_date, $format = 'Ymd' );
			foreach ( $range_data as $data ) {
				$questa_data = date( 'N', strtotime( $data ) );
				if ( $questa_data === $giorno_ripetizione ) {
					$array[ $data ][] = $evento;
				}
			}
		}

		$array = $array;
		return $array;
	}

	/**
	 * Undocumented function
	 *
	 * @return int
	 */
	public function get_weeks_in_month() {

		$weeks_in_month   = intval( $this->current_month_days_length / 7 );
		$month_start_day  = gmdate( 'N', strtotime( $this->current_month_start ) );
		$month_ending_day = gmdate( 'N', strtotime( $this->current_year . '-' . $this->current_month . '-' . $this->current_month_days_length ) );

		if ( $this->current_month_days_length % 7 > 0 ) {
			$weeks_in_month++;
		}

		if ( $month_ending_day < $month_start_day ) {
			$weeks_in_month++;
		}

		return $weeks_in_month;
	}


}
