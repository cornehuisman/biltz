<?php
// CUSTOM POST TYPE TEAM
add_action('init', 'create_redvine_team');
function create_redvine_team()
{
  $labels = array(
    'name' => _x('Team', 'team'),
    'singular_name' => _x('Team', 'team'),
    'add_new' => _x('Nieuw persoon', 'team'),
    'add_new_item' => __('Nieuwe persoon toevoegen'),
    'edit_item' => __('Bewerk persoon'),
    'new_item' => __('Nieuw persoon toevoegen'),
    'view_item' => __('Bekijk persoon'),
    'search_items' => __('Zoek naar een persoon'),
    'not_found' =>  __('Geen persoon gevonden'),
    'not_found_in_trash' => __('Geen teamleden in de prullenbak gevonden'),
    'parent_item_colon' => ''
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'has_archive' => false,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-hammer',
    'hierarchical' => false,
    'menu_position' => 50,
    'supports' => array('title','thumbnail','revisions', 'editor')
  );

  register_post_type('team',$args);
}
?>
