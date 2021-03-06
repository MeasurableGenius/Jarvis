<?php


//
//
// Jarvis v1.1



//
//
// 1 Enqueue the Parent Theme CSS

// Enqueue Divi Parent Theme CSS
function my_theme_enqueue_styles() {

    $parent_style = 'divi';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );



//
//
// 2 Include Required Plugins

// Advanced Custom Fields
// ---

// Customize ACF Path
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/plugins/acf/';
    // return
    return $path;   
}

// Customize ACF Directory
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir( $dir ) {
    // update path
    $dir = get_stylesheet_directory_uri() . '/plugins/acf/';
    // return
    return $dir;
}

// Hide ACF from the menu
// add_filter('acf/settings/show_admin', '__return_false');

// Include ACF
include_once( get_stylesheet_directory() . '/plugins/acf/acf.php' );



//
//
// 3 Create Custom Post Types
 
function custom_post_types() {

	// Processes
	register_post_type(
		'processes', array(
			'label'               => __( 'Processes'),
        	'description'         => __( 'Processes'),
			'labels'              => array(
				'name'                => _x( 'Process' ),
				'singular_name'       => _x( 'Process' ),
        		'menu_name'           => __( 'Processes' ),
        		'all_items'           => __( 'All Processes' ),
        		'view_item'           => __( 'View Process' ),
        		'add_new_item'        => __( 'Add New Process' ),
        		'add_new'             => __( 'Add New' ),
        		'edit_item'           => __( 'Edit Process' ),
        		'update_item'         => __( 'Update Process' ),
        		'search_items'        => __( 'Search Processes' ),
        		'not_found'           => __( 'Not Found'),
        		'not_found_in_trash'  => __( 'Not found in Trash')
				),
			// Features this CPT supports in Post Editor
        	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'category', 'post_tag' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
        	'show_ui'             => true,
        	'show_in_menu'        => true,
        	'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
        	'menu_position'       => 5,
			'menu_icon'           => 'dashicons-editor-ol',
        	'can_export'          => true,
        	'has_archive'         => true,
        	'exclude_from_search' => false,
			'publicly_queryable'  => true,
        	'capability_type'     => 'post'
			)
		);

	// Policies
	register_post_type(
		'policies', array(
			'label'               => __( 'Policies'),
        	'description'         => __( 'Policies'),
			'labels'              => array(
				'name'                => _x( 'Policy' ),
				'singular_name'       => _x( 'Policy' ),
        		'menu_name'           => __( 'Policies' ),
        		'all_items'           => __( 'All Policies' ),
        		'view_item'           => __( 'View Policy' ),
        		'add_new_item'        => __( 'Add New Policy' ),
        		'add_new'             => __( 'Add New' ),
        		'edit_item'           => __( 'Edit Policy' ),
        		'update_item'         => __( 'Update Policy' ),
        		'search_items'        => __( 'Search Policies' ),
        		'not_found'           => __( 'Not Found'),
        		'not_found_in_trash'  => __( 'Not found in Trash')
				),
			// Features this CPT supports in Post Editor
        	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'category', 'post_tag' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
        	'show_ui'             => true,
        	'show_in_menu'        => true,
        	'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
        	'menu_position'       => 5,
			'menu_icon'           => 'dashicons-lock',
        	'can_export'          => true,
        	'has_archive'         => true,
        	'exclude_from_search' => false,
			'publicly_queryable'  => true,
        	'capability_type'     => 'post'
			)
		);
	

	// Knowledge Base Articles
	register_post_type(
		'kb', array(
			'label'               => __( 'Knowledge Base Articles'),
        	'description'         => __( 'Standard Forms'),
			'labels'              => array(
				'name'                => _x( 'Knowledge Base Article' ),

				'singular_name'       => _x( 'Knowledge Base Article' ),
        		'menu_name'           => __( 'Knowledge Base Articles' ),
        		'all_items'           => __( 'All Knowledge Base Articles' ),
        		'view_item'           => __( 'View Knowledge Base Article' ),
        		'add_new_item'        => __( 'Add Knowledge Base Article' ),
        		'add_new'             => __( 'Add New' ),
        		'edit_item'           => __( 'Edit Knowledge Base Article' ),
        		'update_item'         => __( 'Update Knowledge Base Article' ),
        		'search_items'        => __( 'Search Knowledge Base Articles' ),
        		'not_found'           => __( 'Not Found'),
        		'not_found_in_trash'  => __( 'Not found in Trash')
				),
			// Features this CPT supports in Post Editor
        	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'category', 'post_tag' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
        	'show_ui'             => true,
        	'show_in_menu'        => true,
        	'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
        	'menu_position'       => 5,
			'menu_icon'           => 'dashicons-analytics',
        	'can_export'          => true,
        	'has_archive'         => true,
        	'exclude_from_search' => false,
			'publicly_queryable'  => true,
        	'capability_type'     => 'post'
			)
		);

	// Client Profiles
	register_post_type(
		'client-profiles', array(
			'label'               => __( 'Client Profiles'),
        	'description'         => __( 'Client Profiles'),
			'labels'              => array(
				'name'                => _x( 'Client Profile' ),
				'singular_name'       => _x( 'Client Profile' ),
        		'menu_name'           => __( 'Client Profiles' ),
        		'all_items'           => __( 'All Client Profiles' ),
        		'view_item'           => __( 'View Client Profile' ),
        		'add_new_item'        => __( 'Add Client Profile' ),
        		'add_new'             => __( 'Add New' ),
        		'edit_item'           => __( 'Edit Client Profile' ),
        		'update_item'         => __( 'Update Client Profile' ),
        		'search_items'        => __( 'Search Client Profiles' ),
        		'not_found'           => __( 'Not Found'),
        		'not_found_in_trash'  => __( 'Not found in Trash')
				),
			// Features this CPT supports in Post Editor
        	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			//'taxonomies'          => array( '' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
        	'show_ui'             => true,
        	'show_in_menu'        => true,
        	'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
        	'menu_position'       => 5,
			'menu_icon'           => 'dashicons-heart',
        	'can_export'          => true,
        	'has_archive'         => true,
        	'exclude_from_search' => false,
			'publicly_queryable'  => true,
        	'capability_type'     => 'post'
			)
		);
	
	// Standard Forms
	register_post_type(
		'standard-forms', array(
			'label'               => __( 'Standard Forms'),
        	'description'         => __( 'Standard Forms'),
			'labels'              => array(
				'name'                => _x( 'Standard Form' ),
				'singular_name'       => _x( 'Standard Form' ),
        		'menu_name'           => __( 'Standard Forms' ),
        		'all_items'           => __( 'All Standard Forms' ),
        		'view_item'           => __( 'View Standard Form' ),
        		'add_new_item'        => __( 'Add New Standard Form' ),
        		'add_new'             => __( 'Add New' ),
        		'edit_item'           => __( 'Edit Standard Form' ),
        		'update_item'         => __( 'Update Standard Form' ),
        		'search_items'        => __( 'Search Standard Forms' ),
        		'not_found'           => __( 'Not Found'),
        		'not_found_in_trash'  => __( 'Not found in Trash')
				),
			// Features this CPT supports in Post Editor
        	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'category', 'post_tag' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
        	'show_ui'             => true,
        	'show_in_menu'        => true,
        	'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
        	'menu_position'       => 5,
			'menu_icon'           => 'dashicons-clipboard',
        	'can_export'          => true,
        	'has_archive'         => true,
        	'exclude_from_search' => false,
			'publicly_queryable'  => true,
        	'capability_type'     => 'post'
			)
		);
	
 	// Roles
	register_post_type(
		'roles', array(
			'label'               => __( 'Roles'),
        	'description'         => __( 'Roles'),
			'labels'              => array(
				'name'                => _x( 'Role' ),
				'singular_name'       => _x( 'Role' ),
        		'menu_name'           => __( 'Roles' ),
        		'all_items'           => __( 'All Roles' ),
        		'view_item'           => __( 'View Role' ),
        		'add_new_item'        => __( 'Add Role' ),
        		'add_new'             => __( 'Add New' ),
        		'edit_item'           => __( 'Edit Role' ),
        		'update_item'         => __( 'Update Role' ),
        		'search_items'        => __( 'Search Roles' ),
        		'not_found'           => __( 'Not Found'),
        		'not_found_in_trash'  => __( 'Not found in Trash')
				),
			// Features this CPT supports in Post Editor
        	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'category', 'post_tag' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
        	'show_ui'             => true,
        	'show_in_menu'        => true,
        	'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
        	'menu_position'       => 5,
			'menu_icon'           => 'dashicons-admin-users',
        	'can_export'          => true,
        	'has_archive'         => true,
        	'exclude_from_search' => false,
			'publicly_queryable'  => true,
        	'capability_type'     => 'post'
			)
		);
	
	// Campaign
	register_post_type(
		'campaign', array(
			'label'               => __( 'Campaigns'),
        	'description'         => __( 'Campaigns'),
			'labels'              => array(
				'name'                => _x( 'Campaign' ),
				'singular_name'       => _x( 'Campaign' ),
        		'menu_name'           => __( 'Campaigns' ),
        		'all_items'           => __( 'All Campaigns' ),
        		'view_item'           => __( 'View Campaign' ),
        		'add_new_item'        => __( 'Add New Campaign' ),
        		'add_new'             => __( 'Add New' ),
        		'edit_item'           => __( 'Edit Campaign' ),
        		'update_item'         => __( 'Update Campaign' ),
        		'search_items'        => __( 'Search Campaign' ),
        		'not_found'           => __( 'Not Found'),
        		'not_found_in_trash'  => __( 'Not found in Trash')
				),
			// Features this CPT supports in Post Editor
        	'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'category', 'post_tag' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
        	'show_ui'             => true,
        	'show_in_menu'        => true,
        	'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
        	'menu_position'       => 5,
			'menu_icon'           => 'dashicons-share',
        	'can_export'          => true,
        	'has_archive'         => true,
        	'exclude_from_search' => false,
			'publicly_queryable'  => true,
        	'capability_type'     => 'post'
			)
		);
	
	// KPIs
	register_post_type(
		'kpi', array(
			'label'               => __( 'KPI'),
        	'description'         => __( 'Key Performance Indicators'),
			'labels'              => array(
				'name'                => _x( 'kpi' ),
				'singular_name'       => _x( 'KPI' ),
        		'menu_name'           => __( 'KPI' ),
        		'all_items'           => __( 'All KPIs' ),
        		'view_item'           => __( 'View KPIs' ),
        		'add_new_item'        => __( 'Add New KPI' ),
        		'add_new'             => __( 'Add New' ),
        		'edit_item'           => __( 'Edit KPI' ),
        		'update_item'         => __( 'Update KPI' ),
        		'search_items'        => __( 'Search KPIs' ),
        		'not_found'           => __( 'Not Found'),
        		'not_found_in_trash'  => __( 'Not found in Trash')
				),
			// Features this CPT supports in Post Editor
        	'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'category', 'post_tag' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
        	'show_ui'             => true,
        	'show_in_menu'        => true,
        	'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
        	'menu_position'       => 5,
			'menu_icon'           => 'dashicons-dashboard',
        	'can_export'          => true,
        	'has_archive'         => true,
        	'exclude_from_search' => false,
			'publicly_queryable'  => true,
        	'capability_type'     => 'post'
			)
		);
	
	// KPIs
	register_post_type(
		'meeting_agenda', array(
			'label'               => __( 'meeting_agenda'),
        	'description'         => __( 'Meeting Agendas'),
			'labels'              => array(
				'name'                => _x( 'meeting_agenda' ),
				'singular_name'       => _x( 'Meeting Agenda' ),
        		'menu_name'           => __( 'Meeting Agenda' ),
        		'all_items'           => __( 'All Meeting Agendas' ),
        		'view_item'           => __( 'View Meeting Agendas' ),
        		'add_new_item'        => __( 'Add New Meeting Agenda' ),
        		'add_new'             => __( 'Add New' ),
        		'edit_item'           => __( 'Edit Meeting Agenda' ),
        		'update_item'         => __( 'Update Meeting Agenda' ),
        		'search_items'        => __( 'Search Meeting Agendas' ),
        		'not_found'           => __( 'Not Found'),
        		'not_found_in_trash'  => __( 'Not found in Trash')
				),
			// Features this CPT supports in Post Editor
        	'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'category', 'post_tag' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
        	'show_ui'             => true,
        	'show_in_menu'        => true,
        	'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
        	'menu_position'       => 5,
			'menu_icon'           => 'dashicons-clipboard',
        	'can_export'          => true,
        	'has_archive'         => true,
        	'exclude_from_search' => false,
			'publicly_queryable'  => true,
        	'capability_type'     => 'post'
			)
		);
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_types', 0 );


//
//
// 4 Integrations

// DIVI Custom Post Type Integration
// ---

function my_et_builder_post_types( $post_types ) {
    $post_types[] = 'process';
    $post_types[] = 'policy';
    $post_types[] = 'sfwd-courses';
    $post_types[] = 'sfwd-lessons';
 	$post_types[] = 'sfwd-topic';
    $post_types[] = 'kb';

    return $post_types;
}
add_filter( 'et_builder_post_types', 'my_et_builder_post_types' );

// wpDiscuz BuddyPress Profile URL Integration
// ---

add_filter('wpdiscuz_profile_url', 'wpdiscuz_bp_profile_url', 10, 2);
function wpdiscuz_bp_profile_url($profile_url, $user) {
    if ($user && class_exists('BuddyPress')) {
        $profile_url = bp_core_get_user_domain($user->ID);
    }
    return $profile_url;
}

// Add Layout Option Back to Page for Divi
// See: http://sundari-webdesign.com/divi-regular-sidebar-on-page-builder-pages/
// AF
// ---

add_action( 'admin_head', 'add_my_admin_styles' );
function add_my_admin_styles() {
	echo '<style>.et_pb_page_layout_settings { display: block!important;}</style>'; 
};

add_filter( 'gform_pre_render_5', 'populate_posts' );
add_filter( 'gform_pre_validation_5', 'populate_posts' );
add_filter( 'gform_pre_submission_filter_5', 'populate_posts' );
add_filter( 'gform_admin_pre_render_55', 'populate_posts' );
function populate_posts( $form ) {
 
    foreach ( $form['fields'] as &$field ) {
 
        if ( $field->type != 'select' || strpos( $field->cssClass, 'populate-posts' ) === false ) {
            continue;
        }
 
        // you can add additional parameters here to alter the posts that are retrieved
        // more info: http://codex.wordpress.org/Template_Tags/get_posts
        $posts = get_posts( 'post_type=rcno_review&numberposts=-1&post_status=publish' );
 
        $choices = array();
 
        foreach ( $posts as $post ) {
            $choices[] = array( 'text' => $post->post_title, 'value' => $post->post_title );
        }
 
        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'Select a Book';
        $field->choices = $choices;
 
    }
 
    return $form;
}

// Adds Modules to the Divi builder 
function DS_Custom_Modules(){
	if(class_exists("ET_Builder_Module")){
		
		// Include Modules Here
		include("divi-modules/custom-pb-librarybooklist-module.php");
	}
}
function Prep_DS_Custom_Modules(){
	global $pagenow;

	$is_admin = is_admin();
	$action_hook = $is_admin ? 'wp_loaded' : 'wp';
	$required_admin_pages = array( 'edit.php', 'post.php', 'post-new.php', 'admin.php', 'customize.php', 'edit-tags.php', 'admin-ajax.php', 'export.php' ); // list of admin pages where we need to load builder files
	$specific_filter_pages = array( 'edit.php', 'admin.php', 'edit-tags.php' );
	$is_edit_library_page = 'edit.php' === $pagenow && isset( $_GET['post_type'] ) && 'et_pb_layout' === $_GET['post_type'];
	$is_role_editor_page = 'admin.php' === $pagenow && isset( $_GET['page'] ) && 'et_divi_role_editor' === $_GET['page'];
	$is_import_page = 'admin.php' === $pagenow && isset( $_GET['import'] ) && 'wordpress' === $_GET['import']; 
	$is_edit_layout_category_page = 'edit-tags.php' === $pagenow && isset( $_GET['taxonomy'] ) && 'layout_category' === $_GET['taxonomy'];

	if ( ! $is_admin || ( $is_admin && in_array( $pagenow, $required_admin_pages ) && ( ! in_array( $pagenow, $specific_filter_pages ) || $is_edit_library_page || $is_role_editor_page || $is_edit_layout_category_page || $is_import_page ) ) ) {
		add_action($action_hook, 'DS_Custom_Modules', 9789);
	}
}
Prep_DS_Custom_Modules();

// ACF Field Groups

if(function_exists("register_field_group"))
{
	// [Global] Lucidchart Fields
	register_field_group(array (
		'id' => 'acf_global-lucidchart',
		'title' => '[Global] Lucidchart',
		'fields' => array (
			array (
				'key' => 'field_5a6cc55852410',
				'label' => 'Lucidchart ID',
				'name' => 'lucidchart_id',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'processes',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'policies',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	// [Global] Recurrence Fields
	register_field_group(array (
		'id' => 'acf_global-recurrence',
		'title' => '[Global] Recurrence',
		'fields' => array (
			array (
				'key' => 'field_5b09e4f42318f',
				'label' => 'Recurrence',
				'name' => 'recurrence',
				'type' => 'select',
				'required' => 1,
				'default_value' => '',
				'choices' => array (
					'Ad Hoc' => 'Ad Hoc',
					'Hourly' => 'Hourly',
					'Daily' => 'Daily',
					'Weekly' => 'Weekly',
					'Bi-weekly' => 'Bi-weekly',
					'Semi-monthly' => 'Semi-monthly',
					'Monthly' => 'Monthly',
					'Quarterly' => 'Quarterly',
					'Annually' => 'Annually',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'processes',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'meeting_agenda',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	// Process Fields
	register_field_group(array (
		'id' => 'acf_processes',
		'title' => 'Processes',
		'fields' => array (
			array (
				'key' => 'field_58810c112a049',
				'label' => 'Who is Accountable?',
				'name' => 'who_is_accountable',
				'type' => 'relationship',
				'instructions' => 'Only one individual can be accountable to a process. Who is it?',
				'required' => 0,
				'return_format' => 'object',
				'post_type' => array (
					0 => 'roles',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'processes',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	// Role Fields
	register_field_group(array (
		'id' => 'acf_roles',
		'title' => 'Roles',
		'fields' => array (
			array (
				'key' => 'field_5b0464a897d89',
				'label' => 'Assigned Team Members',
				'name' => 'assigned_team_members',
				'type' => 'user',
				'instructions' => 'Select which team members are assigned to this Role.',
				'required' => 0,
				'role' => array (
					0 => 'all',
				),
				'field_type' => 'multi_select',
				'allow_null' => 0,
			),
			array (
				'key' => 'field_5b09e26d5e26e',
				'label' => 'Reports to',
				'name' => 'role_reports_to',
				'type' => 'relationship',
				'required' => 0,
				'return_format' => 'object',
				'post_type' => array (
					0 => 'roles',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_type',
					1 => 'post_title',
				),
				'max' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'roles',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
