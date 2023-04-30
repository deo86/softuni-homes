<?php


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