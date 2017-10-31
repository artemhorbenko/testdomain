<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

// For rtl suuport
wp_enqueue_style( 'themeslug-style', get_stylesheet_uri() );
wp_style_add_data( 'themeslug-style', 'rtl', 'replace' );

/** woocommerce: change positions of elements on single product **/
// Add to cart button
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 10 );
// Meta tags like Category
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// Single raiting
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 30 );

// Create custom post type 'books'
function create_post_type() {
  register_post_type( 'books',
    array(
      'labels' => array(
        'name' => __( 'Books' ),
        'singular_name' => __( 'Books' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-book-alt'
    )
  );
}
add_action( 'init', 'create_post_type' );
// Create taxomy 'genre' for custom post type 'books'
function themes_taxonomy() {  
    register_taxonomy(  
        'genre',
        'books',
        array(  
            'hierarchical' => true,  
            'label' => 'Genre',
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'genre'
            )
        )  
    );  
}  
add_action( 'init', 'themes_taxonomy');