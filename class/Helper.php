<?php
/**
 *
 */
class Helper {

	/**
	 * return the labels for taxonomies and postypes configuration
	 */
	public static function generate_labels( $name, $gender = 'm' ) {
		return array(
			'name' => ucfirst( $name ), // Rename these to suit
			'singular_name' => $name,
			'add_new' => 'Aggiungi ' . $name,
			'add_new_item' => 'Aggiungi ' . $name,
			'edit' => 'Modifica',
			'edit_item' => 'Modifica ' . $name,
			'new_item' => ( ( $gender == 'm' ) ? 'Nuovo ' : 'Nuova ' ) . $name,
			'view' => 'Vedi',
			'view_item' => 'Vedi ' . $name,
			'search_items' => 'Cerca ' . $name,
			'not_found' => ( ( $gender == 'm' ) ? 'Nessun ' : 'Nessuna ' ) . $name . ' ' . ( ( $gender == 'm' ) ? 'trovato ' : 'trovata ' ),
			'not_found_in_trash' => ( ( $gender == 'm' ) ? 'Nessun ' : 'Nessuna ' ) . $name . ' ' . ( ( $gender == 'm' ) ? 'trovato ' : 'trovata ' ) . ' nel cestino',
		);
	}

	/**
	 * create_post_types
	 */
	public static function create_page( $page ) {

		if ( get_page_by_title( $page ) == null ) {
			// Insert the post into the database
			wp_insert_post(
				array(
					'post_title'   => $page,
					'post_content' => 'Starter content',
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_type'    => 'page',
					'post_name'    => $page,
				)
			);
		}

	}


	/**
	 * Returns the images sizes
	 *
	 * @param post_type useful to get the sizes of every attachment
	 */
	public static function get_image_thumb_sizes( $post_id, $post_type = 'post' ) {

		if ( 'attachment' !== $post_type ) {
			$post_id = get_post_thumbnail_id( $post_id );
		}

		return array(
			'small'     => wp_get_attachment_image_url( $post_id, 'thumbnail' ),
			'medium'    => wp_get_attachment_image_url( $post_id, 'medium' ),
			'large'     => wp_get_attachment_image_url( $post_id, 'large' ),
			'square'    => wp_get_attachment_image_url( $post_id, 'square' ),
			'medium_x2' => wp_get_attachment_image_url( $post_id, 'medium-x2' ),
			'large_x2'  => wp_get_attachment_image_url( $post_id, 'large-x2' ),
			'square_x2' => wp_get_attachment_image_url( $post_id, 'square-x2' ),
			'full'      => wp_get_attachment_image_url( $post_id, 'full' ),
		);
	}

	/**
	 * Replace only first occurrence.
	 */
	public static function get_category_root( $post ) {
		$category = get_the_category( $post->ID );
		$cat_root_slug = '';
		if ( $category ) {
			$category_parent_id = $category[0]->category_parent;
			if ( $category_parent_id != 0 ) {
				$category_parent = get_term( $category_parent_id, 'category' );
				$cat_root_slug = $category_parent;
			} else {
				$cat_root_slug = $category[0];
			}
		}
		return $cat_root_slug;
	}



	/**
	 * Replace only first occurrence
	 */
	public static function str_replace_first( $from, $to, $content ) {
		$from = '/' . preg_quote( $from, '/' ) . '/';

		return preg_replace( $from, $to, $content, 1 );
	}


	/**
	 * Replace only first occurrence.
	 */
	public static function get_post_record( $post ) {

		$img_id = get_post_thumbnail_id( $post );

		$terms   = wp_get_post_terms( $post->ID, 'category' );
		$label   = $terms[0] ? $terms[0]->name : '';
		$pubdate = array(
			'timestamp' => strtotime( $post->post_date_gmt ),
			'date' => date( 'd m Y', strtotime( $post->post_date_gmt ) ),
			'gmt' => $post->post_date_gmt,
		);

		$permalink = get_the_permalink( $post->ID );

		return array(
			'id'        => $post->ID,
			'title'     => $post->post_title,
			'timestamp' => strtotime( $post->post_date ),
			'link'      => get_the_permalink( $post->ID ),
			'excerpt'   => get_the_excerpt( $post->ID ),
			'category'  => $label, // cambiata in "label" ma lasciata perchè non sappiamo se richiamata da qualche parte
			'label'     => $label,
			'pubdate'   => $pubdate,
			'image'     => array(
				'title' => get_the_title( get_post_thumbnail_id( $post->ID ) ),
				'sizes' => self::get_image_thumb_sizes( $post->ID ),
			),
		);
	}

	/**
	 * Replace only first occurrence.
	 */
	public static function move_element_in_array( &$array, $a, $b ) {
		$p1    = array_splice( $array, $a, 1 );
		$p2    = array_splice( $array, 0, $b );
		$array = array_merge( $p2, $p1, $array );
		return $array;
	}

}
