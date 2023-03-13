<?php
/*
Plugin Name: Auto Bulk Update New
Plugin URI: https://eshtrak.com/
Description: This plugin adds a new feature to Bulk Post Update Date plugin that allows you to update post date on your own for each post.
Version: 1.0.0
Author: Moh Adel
Author URI: https://eshtrak.com/
*/

function wp_bpd_modify_column( $columns ) {
  $columns['cb'] = '<input type="checkbox" />';
  $columns['bulk-post-update-date'] = 'تحديث بشكل يدوي';
  return $columns;
}

function wp_bpd_modify_column_content( $column_name, $post_id ) {
  if ($column_name == 'bulk-post-update-date') {
    $bulk_post_update_date = get_post_meta( $post_id, 'bulk_post_update_date', true );
    echo '<input type="text" class="bulk-post-update-date" name="bulk_post_update_date" value="'.$bulk_post_update_date.'" />';
  }
}

function wp_bpd_save_bulk_post_update_date( $post_id ) {
  if (isset( $_POST['bulk_post_update_date'] )) {
    $bulk_post_update_date = sanitize_text_field( $_POST['bulk_post_update_date'] );
    update_post_meta( $post_id, 'bulk_post_update_date', $bulk_post_update_date );
  }
}

add_filter( 'manage_posts_columns', 'wp_bpd_modify_column' );
add_action( 'manage_posts_custom_column', 'wp_bpd_modify_column_content', 10, 2 );
add_action( 'save_post', 'wp_bpd_save_bulk_post_update_date' );
