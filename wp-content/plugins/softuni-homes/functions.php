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
 * This functions update the homes post meta for the views count
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
 * Homes Enqueue
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
 * Displays the current user name if the user is logged in
 *
 * @return void
 */
function softuni_display_username() {
    $output = '';

    if ( is_user_logged_in() == true ) {
        $current_user = wp_get_current_user();
        $user_display_name = $current_user->data->display_name;
        $output = 'Hello, ' . $user_display_name . ', enjoy the article!';
    }

    return $output;
}
add_shortcode( 'display_username', 'softuni_display_username' );

/**
 * It gets the content and counts the number of words
 *
 * @return void
 */
function softunit_display_post_word_count( $atts ) {
    $output = '';
    $word_count = 0;
    $post_id = '';

    $attributes = shortcode_atts( array(
		'post_id' => '',
	), $atts );

    if ( ! empty( $attributes['post_id'] ) ) {
        $post_id = $attributes['post_id'];

        $post = get_post( $attributes['post_id'] );
        if ( ! empty( $post ) ) {
            // @TODO: we have to strip the markup and Gutenberg items so we have a better result.
            $post_content = $post->post_content;
            $word_count = str_word_count( $post_content );
        }

    } else {
        $output = 'You must add a post_id as an attribute.';
    }

    if ( ! empty( $word_count ) ) {
        $output = 'The number of words for the Post ID ' . $post_id . ' is ' . $word_count;
    }

    return $output;
}
add_shortcode( 'display_post_word_count', 'softunit_display_post_word_count' );

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