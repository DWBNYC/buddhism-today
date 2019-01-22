<?php

function buddhismToday_resources() {
 
  wp_enqueue_style('style', get_stylesheet_uri());

}

add_action('wp_enqueue_scripts', 'buddhismToday_resources');

// Customize excerpt word count lenght
function custom_excerpt_length() {
 
  return 55;

}

add_filter('excerpt_length', 'custom_excerpt_length');


if ( function_exists( 'coauthors_posts_links' ) ) {
    coauthors_posts_links();
} else {
    the_author_posts_link();
}


// Theme setup
function buddhismToday_setup() {

// Navigations Menus
register_nav_menus(array(
  'primary' => __( 'Primary Menu'),
  'footer' => __('Footer Menu'),

  ));

// Add featured image support
  add_theme_support('post-thumbnails');
  add_image_size('small-thumbnail', 180, 120, true);
  add_image_size('bio-thumbnail', 210, 260, true);
  add_image_size('featured-image',1200, 750, true);
  add_image_size('mag-thumbnail', 250, 330, true);
  add_image_size('teacher-thumbnail', 300, 450, true);

// Add post format support
  add_theme_support('post-formats',  array('aside', 'gallery', 'link'));
}

add_action('after_setup_theme', 'buddhismToday_setup');

// Add Widget Locations
function ourWidgetsInit() {

register_sidebar( array(
    'name' => 'Sidebar',
    'id' => 'sidebar1',
    'before_widget' => '<div id="%1$s" class="widget-item">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="my-special-class">',
    'after_title' => '</h4>'

  ));

register_sidebar( array(
    'name' => 'Header Area',
    'id' => 'header1',
    'before_widget' => '<div class="widget-item">',
    'after_widget' => '</div>',
  ));

}

add_action('widgets_init', 'ourWidgetsInit');

//Add JavaScript
function bt_theme_script() {
  wp_enqueue_script( 'menu-drop-down', get_template_directory_uri() . '/js/script.js' );
}
add_action( 'wp_enqueue_scripts', 'bt_theme_script');


add_action( 'init', 'create_issue_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_issue_taxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x( 'Issues', 'taxonomy general name', 'textdomain' ),
    'singular_name'     => _x( 'Issue', 'taxonomy singular name', 'textdomain' ),
    'search_items'      => __( 'Search Issues', 'textdomain' ),
    'all_items'         => __( 'All Issues', 'textdomain' ),
    'parent_item'       => __( 'Parent Issue', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Issue:', 'textdomain' ),
    'edit_item'         => __( 'Edit Issue', 'textdomain' ),
    'update_item'       => __( 'Update Issue', 'textdomain' ),
    'add_new_item'      => __( 'Add New Issue', 'textdomain' ),
    'new_item_name'     => __( 'New Issue Name', 'textdomain' ),
    'menu_name'         => __( 'Issue', 'textdomain' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'issue' ),
  );

  register_taxonomy( 'issue', array('post', 'page'), $args );

}

function your_columns_head($defaults) {  

    $new = array();
    $tags = $defaults['taxonomy-issue'];  // save the tags column
    unset($defaults['taxonomy-issue']);   // remove it from the columns list

    foreach($defaults as $key=>$value) {
        if($key=='categories') {  // when we find the date column
           $new['taxonomy-issue'] = $tags;  // put the tags column before it
        }    
        $new[$key]=$value;
    }  

    return $new;  
} 
add_filter('manage_posts_columns', 'your_columns_head'); 

// Search only posts
function SearchFilter($query) {
  if ($query->is_search) {
    $query->set('post_type', 'post');
    }
  return $query;
  }
 
add_filter('pre_get_posts','SearchFilter');

function search_excerpt() {


// Configuration
$max_length = 400; // Max length in characters
$min_padding = 30; // Min length in characters of the context to place around found search terms
 
// Load content as plain text
global $wp_query, $post;
$content = (!post_password_required($post) ? strip_tags(preg_replace(array("/\r?\n/", '@<\s*(p|br\s*/?)\s*>@'), array(' ', "\n"), apply_filters('the_content', $post->post_content))) : '');
 
// Search content for terms
$terms = $wp_query->query_vars['search_terms'];
if ( preg_match_all('/'.str_replace('/', '\/', join('|', $terms)).'/i', $content, $matches, PREG_OFFSET_CAPTURE) ) {
    $padding = max($min_padding, $max_length / (2*count($matches[0])));
 
  // Construct extract containing context for each term
  $output = '';
  $last_offset = 0;
  foreach ( $matches[0] as $match ) {
    list($string, $offset) = $match;
    $start  = $offset-$padding;
    $end = $offset+strlen($string)+$padding;
    // Preserve whole words
    while ( $start > 1 && preg_match('/[A-Za-z0-9\'"-]/', $content{$start-1}) ) $start--;
    while ( $end < strlen($content)-1 && preg_match('/[A-Za-z0-9\'"-]/', $content{$end}) ) $end++;
    $start = max($start, $last_offset);
    $context = substr($content, $start, $end-$start);
    if ( $start > $last_offset ) $context = '... '.$context;
    $output .= $context;
    $last_offset = $end;
  }
 
  if ( $last_offset != strlen($content)-1 ) $output .= '... ';
} else {
  $output = $content;
}
 
if ( strlen($output) > $max_length ) {
  $end = $max_length-3;
  while ( $end > 1 && preg_match('/[A-Za-z0-9\'"-]/', $output{$end-1}) ) $end--;
  $output = substr($output, 0, $end) . '... ';
}
 
// Highlight matches
$context = nl2br(preg_replace('/'.str_replace('/', '\/', join('|', $terms)).'/i', '<strong>$0</strong>', $output));

return $context;
}