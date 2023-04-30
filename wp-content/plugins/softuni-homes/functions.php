<?php

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