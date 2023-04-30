<?php

/**
 * Display time ago string
 *
 * @param [type] $type
 * @return string
 */
function softuni_time_ago( $type = 'post' ) {
    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';

    return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');

}

/**
 * Display a single post term
 *
 * @param integer $post_id
 * @param [type] $taxonomy
 * @return void
 */
function softuni_display_single_term( $post_id, $taxonomy ) {

    if ( empty( $post_id ) || empty( $taxonomy ) ) {
        return;
    }

    $terms = get_the_terms( $post_id, $taxonomy );

    $output = '';
    if ( ! empty( $terms ) && is_array( $terms ) ) {
        foreach( $terms as $term ) {
            $output .= $term->name . ', ' ;
        }
    }

    return $output;
}


/**
 * This function updates the homes post meta for the views count
 *
 * @param [type] $home_id
 * @return void
 */
function softuni_update_home_views_count( $home_id ) {
    if ( empty( $home_id ) ) {
        return;
    }
    // if ( ! is_single( 'home' ) ) {
    //     return;
    // }

    $view_count = get_post_meta( $home_id, 'views_count', true );

    if ( ! empty( $view_count ) ) {
        $view_count = $view_count + 1;
    } else {
        $view_count = 1;
    }
    update_post_meta( $home_id, 'views_count', $view_count );

}

/**
 * Properties Enqueue
 */
function softuni_enqueue_scripts() {
	wp_enqueue_script( 'softuni-script', plugins_url( 'assets/scripts/scripts.js', __FILE__ ), array( 'jquery' ), 1.1 );
	wp_localize_script( 'softuni-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

}
add_action( 'wp_enqueue_scripts', 'softuni_enqueue_scripts' );

/**
 * Functions takes care of the like of the home
 *
 * @return void
 */
function softuni_home_like() {
	$home_id = esc_attr( $_POST['home_id'] );

	$like_number = get_post_meta( $home_id, 'likes', true );

    if ( empty( $like_number ) ) {
        update_post_meta( $home_id, 'likes', 1 );
    } else {
        $like_number = $like_number + 1;
        update_post_meta( $home_id, 'likes', $like_number );
    }

    wp_die();
}
add_action( 'wp_ajax_nopriv_softuni_home_like', 'softuni_home_like' );
add_action( 'wp_ajax_softuni_home_like', 'softuni_home_like' );

/**
 * Displays the property details - name, image and URL
 *
 * @return void
 */
function softuni_display_details() {
    $output = '';
	var_dump('Hello from the details shortcode');
	$home_id = get_the_ID();
	$output = 'Details: ID-' . $home_id . ', name-' . get_the_title() . ', image-' . get_the_post_thumbnail_url() . ', URL-' . get_permalink();

    return $output;
}
add_shortcode( 'display_details', 'softuni_display_details' );

/**
 * Updates the post meta visits_count
 *
 * @return void
 */

function softuni_update_home_visit_count( $post_id = 0 ) {
    if ( empty( $post_id ) ) {
        return;
    }

    $visit_count = get_post_meta( $post_id, 'visits_count', true );

    if ( ! empty( $visit_count ) ) {
        $visit_count = $visit_count + 1;

        update_post_meta( $post_id, 'visits_count', $visit_count );
    } else {
        update_post_meta( $post_id, 'visits_count', 1 );
    }
}

// Old code from the initial sessions
 /**
  * Undocumented function
  *
  * @param [type] $title
  * @return void
  */
  function change_title_text( $title ) {

    var_dump( $title );

    return $title . ' 1st function' ;
}
// add_filter( 'the_title', 'change_title_text', 10 );