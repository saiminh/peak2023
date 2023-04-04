<?php 
/**
 * Add Custom post types and their taxonomies
 *
 * @package peak2021
 */

function create_posttype() {
  register_post_type( 'teammember',
  // CPT Options
    array(
      'labels' => array(
        'name' => __( 'Team members' ),
        'singular_name' => __( 'Team member' ),
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_rest' => true,
      'has_archive' => 'teammembers',
      'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'permalinks' ),
    )
  );
  register_post_type( 'founders',
  // CPT Options
    array(
      'labels' => array(
        'name' => __( 'Founders' ),
        'singular_name' => __( 'Founder' ),
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_rest' => true,
      'has_archive' => 'founders-archive',
      //'rewrite' => array('slug' => 'founders/%exercisetypes%', 'with_front' => false),
      'taxonomies' => array('businessmodel', 'founders-tag'),
      'template' => array(
        array( 'core/group', array( 'className' => 'founder-block' ), array(
          array( 'core/columns', array(), array(
            array( 'core/column', array(), array(
              array('core/image', array(
                'lock' => array(
                  'move'   => false,
                  'remove' => false,
                ),
                'className' => 'founder-coin'
              ) ),
              array( 'core/column', array(), array(
                array('core/image', array(
                  'lock' => array(
                    'move'   => false,
                    'remove' => false,
                  ),
                  'className' => 'size-full founder-photograph'
                ))
              )),
            )),
          )),
        )),
      ),
      'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'permalinks', 'featured_image' ),
    )
  );
  flush_rewrite_rules(); 
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype', 0 );

function create_businessmodel_hierarchical_taxonomy() {
  // Add new taxonomy, make it hierarchical like categories
  //first do the translations part for GUI
    $labels = array(
      'name' => _x( 'Business models', 'taxonomy general name' ),
      'singular_name' => _x( 'Business model', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Business models' ),
      'all_items' => __( 'All Business models' ),
      'parent_item' => __( 'Parent Business model' ),
      'parent_item_colon' => __( 'Parent Business model:' ),
      'edit_item' => __( 'Edit Business model' ), 
      'update_item' => __( 'Update Business model' ),
      'add_new_item' => __( 'Add New Business model' ),
      'new_item_name' => __( 'New Business model Name' ),
      'menu_name' => __( 'Business models' )
    );    
    $args = array(
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array( 'slug' => 'business-model', 'with_front' => false ),
      'public' => true,
      'has_archive' => true,
      'show_in_rest' => true // Needed for tax to appear in Gutenberg editor
    );
  // Now register the taxonomy
    register_taxonomy('businessmodel', 'founders', $args);
  }
  //hook into the init action and call create_businessmodel_hierarchical_taxonomy when it fires
  add_action( 'init', 'create_businessmodel_hierarchical_taxonomy', 0 );