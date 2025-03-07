<?php
/**
 * Blocksy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blocksy
 */
add_action('after_setup_theme', function () {
	$i18n_manager = new Blocksy_Translations_Manager();
	$i18n_manager->register_translation_keys();

	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Word, use a find and replace
	 * to change 'blocksy' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blocksy', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');
	add_theme_support('custom-logo');
	add_theme_support('lifterlms-sidebars');
	add_theme_support('boostify-header-footer');

	add_theme_support('fl-theme-builder-headers');
	add_theme_support('fl-theme-builder-footers');
	add_theme_support('fl-theme-builder-parts');

	add_theme_support(
		'editor-gradient-presets',
		[
			[
				'name' => 'Vivid cyan blue to vivid purple',
				'gradient' => 'linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%)',
				'slug' => 'vivid-cyan-blue-to-vivid-purple',
			],

			[
				'name' => 'Light green cyan to vivid green cyan',
				'gradient' => 'linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%)',
				'slug' => 'light-green-cyan-to-vivid-green-cyan',
			],

			[
				'name' => 'Luminous vivid amber to luminous vivid orange',
				'gradient' => 'linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%)',
				'slug' => 'luminous-vivid-amber-to-luminous-vivid-orange',
			],

			[
				'name' => 'Luminous vivid orange to vivid red',
				'gradient' => 'linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%)',
				'slug' => 'luminous-vivid-orange-to-vivid-red',
			],

			[
				'name' => 'Cool to warm spectrum',
				'gradient' => 'linear-gradient(135deg,rgb(74,234,220) 0%,rgb(151,120,209) 20%,rgb(207,42,186) 40%,rgb(238,44,130) 60%,rgb(251,105,98) 80%,rgb(254,248,76) 100%)',
				'slug' => 'cool-to-warm-spectrum',
			],

			[
				'name' => 'Blush light purple',
				'gradient' => 'linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%)',
				'slug' => 'blush-light-purple',
			],

			[
				'name' => 'Blush bordeaux',
				'gradient' => 'linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%)',
				'slug' => 'blush-bordeaux',
			],

			[
				'name' => 'Luminous dusk',
				'gradient' => 'linear-gradient(135deg,rgb(255,203,112) 0%,rgb(199,81,192) 50%,rgb(65,88,208) 100%)',
				'slug' => 'luminous-dusk',
			],

			[
				'name' => 'Pale ocean',
				'gradient' => 'linear-gradient(135deg,rgb(255,245,203) 0%,rgb(182,227,212) 50%,rgb(51,167,181) 100%)',
				'slug' => 'pale-ocean',
			],

			[
				'name' => 'Electric grass',
				'gradient' => 'linear-gradient(135deg,rgb(202,248,128) 0%,rgb(113,206,126) 100%)',
				'slug' => 'electric-grass',
			],

			[
				'name' => 'Midnight',
				'gradient' => 'linear-gradient(135deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%)',
				'slug' => 'midnight',
			],

			[
				'name' => 'Juicy Peach',
				'gradient' => 'linear-gradient(to right, #ffecd2 0%, #fcb69f 100%)',
				'slug' => 'juicy-peach',
			],

			[
				'name' => 'Young Passion',
				'gradient' => 'linear-gradient(to right, #ff8177 0%, #ff867a 0%, #ff8c7f 21%, #f99185 52%, #cf556c 78%, #b12a5b 100%)',
				'slug' => 'young-passion',
			],

			[
				'name' => 'True Sunset',
				'gradient' => 'linear-gradient(to right, #fa709a 0%, #fee140 100%)',
				'slug' => 'true-sunset',
			],

			[
				'name' => 'Morpheus Den',
				'gradient' => 'linear-gradient(to top, #30cfd0 0%, #330867 100%)',
				'slug' => 'morpheus-den',
			],

			[
				'name' => 'Plum Plate',
				'gradient' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
				'slug' => 'plum-plate',
			],

			[
				'name' => 'Aqua Splash',
				'gradient' => 'linear-gradient(15deg, #13547a 0%, #80d0c7 100%)',
				'slug' => 'aqua-splash',
			],

			[
				'name' => 'Love Kiss',
				'gradient' => 'linear-gradient(to top, #ff0844 0%, #ffb199 100%)',
				'slug' => 'love-kiss',
			],

			[
				'name' => 'New Retrowave',
				'gradient' => 'linear-gradient(to top, #3b41c5 0%, #a981bb 49%, #ffc8a9 100%)',
				'slug' => 'new-retrowave',
			],

			[
				'name' => 'Plum Bath',
				'gradient' => 'linear-gradient(to top, #cc208e 0%, #6713d2 100%)',
				'slug' => 'plum-bath',
			],

			[
				'name' => 'High Flight',
				'gradient' => 'linear-gradient(to right, #0acffe 0%, #495aff 100%)',
				'slug' => 'high-flight',
			],

			[
				'name' => 'Teen Party',
				'gradient' => 'linear-gradient(-225deg, #FF057C 0%, #8D0B93 50%, #321575 100%)',
				'slug' => 'teen-party',
			],

			[
				'name' => 'Fabled Sunset',
				'gradient' => 'linear-gradient(-225deg, #231557 0%, #44107A 29%, #FF1361 67%, #FFF800 100%)',
				'slug' => 'fabled-sunset',
			],

			[
				'name' => 'Arielle Smile',
				'gradient' => 'radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%)',
				'slug' => 'arielle-smile',
			],

			[
				'name' => 'Itmeo Branding',
				'gradient' => 'linear-gradient(180deg, #2af598 0%, #009efd 100%)',
				'slug' => 'itmeo-branding',
			],

			[
				'name' => 'Deep Blue',
				'gradient' => 'linear-gradient(to right, #6a11cb 0%, #2575fc 100%)',
				'slug' => 'deep-blue',
			],

			[
				'name' => 'Strong Bliss',
				'gradient' => 'linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%)',
				'slug' => 'strong-bliss',
			],

			[
				'name' => 'Sweet Period',
				'gradient' => 'linear-gradient(to top, #3f51b1 0%, #5a55ae 13%, #7b5fac 25%, #8f6aae 38%, #a86aa4 50%, #cc6b8e 62%, #f18271 75%, #f3a469 87%, #f7c978 100%)',
				'slug' => 'sweet-period',
			],

			[
				'name' => 'Purple Division',
				'gradient' => 'linear-gradient(to top, #7028e4 0%, #e5b2ca 100%)',
				'slug' => 'purple-division',
			],

			[
				'name' => 'Cold Evening',
				'gradient' => 'linear-gradient(to top, #0c3483 0%, #a2b6df 100%, #6b8cce 100%, #a2b6df 100%)',
				'slug' => 'cold-evening',
			],

			[
				'name' => 'Mountain Rock',
				'gradient' => 'linear-gradient(to right, #868f96 0%, #596164 100%)',
				'slug' => 'mountain-rock',
			],

			[
				'name' => 'Desert Hump',
				'gradient' => 'linear-gradient(to top, #c79081 0%, #dfa579 100%)',
				'slug' => 'desert-hump',
			],

			[
				'name' => 'Eternal Constance',
				'gradient' => 'linear-gradient(to top, #09203f 0%, #537895 100%)',
				'slug' => 'ethernal-constance',
			],

			[
				'name' => 'Happy Memories',
				'gradient' => 'linear-gradient(-60deg, #ff5858 0%, #f09819 100%)',
				'slug' => 'happy-memories',
			],

			[
				'name' => 'Grown Early',
				'gradient' => 'linear-gradient(to top, #0ba360 0%, #3cba92 100%)',
				'slug' => 'grown-early',
			],

			[
				'name' => 'Morning Salad',
				'gradient' => 'linear-gradient(-225deg, #B7F8DB 0%, #50A7C2 100%)',
				'slug' => 'morning-salad',
			],

			[
				'name' => 'Night Call',
				'gradient' => 'linear-gradient(-225deg, #AC32E4 0%, #7918F2 48%, #4801FF 100%)',
				'slug' => 'night-call',
			],

			[
				'name' => 'Mind Crawl',
				'gradient' => 'linear-gradient(-225deg, #473B7B 0%, #3584A7 51%, #30D2BE 100%)',
				'slug' => 'mind-crawl',
			],

			[
				'name' => 'Angel Care',
				'gradient' => 'linear-gradient(-225deg, #FFE29F 0%, #FFA99F 48%, #FF719A 100%)',
				'slug' => 'angel-care',
			],

			[
				'name' => 'Juicy Cake',
				'gradient' => 'linear-gradient(to top, #e14fad 0%, #f9d423 100%)',
				'slug' => 'juicy-cake',
			],

			[
				'name' => 'Rich Metal',
				'gradient' => 'linear-gradient(to right, #d7d2cc 0%, #304352 100%)',
				'slug' => 'rich-metal',
			],

			[
				'name' => 'Mole Hall',
				'gradient' => 'linear-gradient(-20deg, #616161 0%, #9bc5c3 100%)',
				'slug' => 'mole-hall',
			],

			[
				'name' => 'Cloudy Knoxville',
				'gradient' => 'linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%)',
				'slug' => 'cloudy-knoxville',
			],

			[
				'name' => 'Very light gray to cyan bluish gray',
				'gradient' => 'linear-gradient(135deg,rgb(238,238,238) 0%,rgb(169,184,195) 100%)',
				'slug' => 'very-light-gray-to-cyan-bluish-gray',
			],

			[
				'name' => 'Soft Grass',
				'gradient' => 'linear-gradient(to top, #c1dfc4 0%, #deecdd 100%)',
				'slug' => 'soft-grass',
			],

			[
				'name' => 'Saint Petersburg',
				'gradient' => 'linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%)',
				'slug' => 'saint-petersburg',
			],

			[
				'name' => 'Everlasting Sky',
				'gradient' => 'linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%)',
				'slug' => 'everlasting-sky',
			],

			[
				'name' => 'Kind Steel',
				'gradient' => 'linear-gradient(-20deg, #e9defa 0%, #fbfcdb 100%)',
				'slug' => 'kind-steel',
			],

			[
				'name' => 'Over Sun',
				'gradient' => 'linear-gradient(60deg, #abecd6 0%, #fbed96 100%)',
				'slug' => 'over-sun',
			],

			[
				'name' => 'Premium White',
				'gradient' => 'linear-gradient(to top, #d5d4d0 0%, #d5d4d0 1%, #eeeeec 31%, #efeeec 75%, #e9e9e7 100%)',
				'slug' => 'premium-white',
			],

			[
				'name' => 'Clean Mirror',
				'gradient' => 'linear-gradient(45deg, #93a5cf 0%, #e4efe9 100%)',
				'slug' => 'clean-mirror',
			],

			[
				'name' => 'Wild Apple',
				'gradient' => 'linear-gradient(to top, #d299c2 0%, #fef9d7 100%)',
				'slug' => 'wild-apple',
			],

			[
				'name' => 'Snow Again',
				'gradient' => 'linear-gradient(to top, #e6e9f0 0%, #eef1f5 100%)',
				'slug' => 'snow-again',
			],

			[
				'name' => 'Confident Cloud',
				'gradient' => 'linear-gradient(to top, #dad4ec 0%, #dad4ec 1%, #f3e7e9 100%)',
				'slug' => 'confident-cloud',
			],

			[
				'name' => 'Glass Water',
				'gradient' => 'linear-gradient(to top, #dfe9f3 0%, white 100%)',
				'slug' => 'glass-water',
			],

			[
				'name' => 'Perfect White',
				'gradient' => 'linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%)',
				'slug' => 'perfect-white',
			],
		]
	);

	remove_theme_support('widgets-block-editor');

	$paletteColors = blocksy_get_colors(
		get_theme_mod('colorPalette'),
		[
			'color1' => [ 'color' => '#3eaf7c' ],
			'color2' => [ 'color' => '#33a370' ],
			'color3' => [ 'color' => 'rgba(44, 62, 80, 0.9)' ],
			'color4' => [ 'color' => 'rgba(44, 62, 80, 1)' ],
			'color5' => [ 'color' => '#ffffff' ],
		]
	);

	add_theme_support( 'editor-color-palette', [
		[
			'name' => __( 'Palette Color 1', 'blocksy' ),
			'slug' => 'palette-color-1',
			'color' => 'var(--paletteColor1, ' . $paletteColors['color1'] . ')',
		],

		[
			'name' => __( 'Palette Color 2', 'blocksy' ),
			'slug' => 'palette-color-2',
			'color' => 'var(--paletteColor2, ' . $paletteColors['color2'] . ')',
		],

		[
			'name' => __( 'Palette Color 3', 'blocksy' ),
			'slug' => 'palette-color-3',
			'color' => 'var(--paletteColor3, '. $paletteColors['color3'] . ')',
		],

		[
			'name' => __( 'Palette Color 4', 'blocksy' ),
			'slug' => 'palette-color-4',
			'color' => 'var(--paletteColor4, ' . $paletteColors['color4'] . ')',
		],

		[
			'name' => __( 'Palette Color 5', 'blocksy' ),
			'slug' => 'palette-color-5',
			'color' => 'var(--paletteColor5, ' . $paletteColors['color5'] . ')',
		]
	]);

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	add_post_type_support('page', 'excerpt');

	$all_menus = [];

	$all_menus['footer'] = esc_html__('Footer Menu', 'blocksy');
	$all_menus['menu_1'] = esc_html__('Header Menu 1', 'blocksy');
	$all_menus['menu_2'] = esc_html__('Header Menu 2', 'blocksy');
	$all_menus['menu_mobile'] = esc_html__('Mobile Menu', 'blocksy');

	// This theme uses wp_nav_menu() in one location.
	if (! empty($all_menus)) {
		register_nav_menus($all_menus);
	}

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		]
	);

	// Registers support for Gutenberg wide images
	add_theme_support('align-wide');

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');
	add_theme_support('header-footer-elementor');
});


add_action('customize_save_after', function () {
	$i18n_manager = new Blocksy_Translations_Manager();
	$i18n_manager->register_wpml_translation_keys();
});

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
add_action('after_setup_theme', function () {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters(
		'blocksy_content_width',
		get_theme_mod('maxSiteWidth', 1290)
	);
}, 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
add_action(
	'widgets_init',
	function () {
		$sidebar_title_tag = get_theme_mod('widgets_title_wrapper', 'h2');

		register_sidebar(
			[
				'name' => esc_html__( 'Main Sidebar', 'blocksy' ),
				'id' => 'sidebar-1',
				'description' => esc_html__( 'Add widgets here.', 'blocksy' ),
				'before_widget' => '<div class="ct-widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<' . $sidebar_title_tag . ' class="widget-title">',
				'after_title' => '</' . $sidebar_title_tag . '>',
			]
		);

		do_action('blocksy:widgets_init', $sidebar_title_tag);

		$number_of_sidebars = 6;

		for ($i = 1; $i <= $number_of_sidebars; $i++) {
			register_sidebar(
				[
					'id' => 'ct-footer-sidebar-' . $i,
					'name' => "Footer Column $i",
					'before_widget' => '<div class="ct-widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<' . $sidebar_title_tag . ' class="widget-title">',
					'after_title' => '</' . $sidebar_title_tag . '>',
				]
			);
		}
	}
);

add_action('wp_enqueue_scripts', function () {
	$theme = blocksy_get_wp_parent_theme();

	$m = new Blocksy_Fonts_Manager();
	$m->load_dynamic_google_fonts();

	wp_register_script(
		'ct-events',
		get_template_directory_uri() . '/static/bundle/events.js',
		[],
		$theme->get('Version'),
		true
	);

    /*
	wp_enqueue_style(
		'ct-style',
		get_stylesheet_uri(),
		[],
		$theme->get( 'Version' )
	);
     */

	wp_enqueue_style(
		'ct-main-styles',
		get_template_directory_uri() . '/static/bundle/main.css',
		[],
		$theme->get('Version')
	);

	if (is_rtl()) {
		wp_enqueue_style(
			'ct-main-rtl-styles',
			get_template_directory_uri() . '/static/bundle/main-rtl.css',
			['ct-main-styles'],
			$theme->get('Version')
		);
	}

	if (class_exists('Forminator')) {
		wp_enqueue_style(
			'ct-forminator-styles',
			get_template_directory_uri() . '/static/bundle/forminator.css',
			['ct-main-styles'],
			$theme->get('Version')
		);
	}

	wp_enqueue_script(
		'ct-scripts',
		get_template_directory_uri() . '/static/bundle/main.js',
		['ct-events'],
		$theme->get('Version'),
		true
	);

	$data = apply_filters('blocksy:general:ct-scripts-localizations', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('ct-ajax-nonce'),
		'public_url' => get_template_directory_uri() . '/static/bundle/',
		'rest_url' => get_rest_url(),
		'search_url' => get_search_link('QUERY_STRING'),
		'show_more_text' => __('Show more', 'blocksy'),
		'more_text' => __('More', 'blocksy'),
	]);

	if (class_exists('BunnyCDN')) {
		$bunnyCdnOptions = BunnyCDN::getOptions();

		$data['public_url'] = str_replace(
			$bunnyCdnOptions["site_url"],
			(
				is_ssl() ? 'https://' : 'http://'
			) . $bunnyCdnOptions["cdn_domain_name"],
			$data['public_url']
		);
	}

	if (function_exists('get_rocket_cdn_url')) {
		$data['public_url'] = get_rocket_cdn_url($data['public_url']);
	}

	if (apply_filters('blocksy:general:internet-explorer-redirect', true)) {
		ob_start();
		get_template_part('template-parts/internet', 'explorer');
		$data['internet_explorer_template'] = ob_get_clean();
	}

	if (is_customize_preview()) {
		$data['customizer_sync'] = blocksy_customizer_sync_data();
	}

	if (function_exists('is_woocommerce')) {
		$data['wc_empty_price'] = wc_price(0);
	}

	wp_localize_script(
		'ct-scripts',
		'ct_localizations',
		$data
	);

	if (defined('WP_DEBUG') && WP_DEBUG) {
		wp_localize_script(
			'ct-scripts',
			'WP_DEBUG',
			['debug' => true]
		);
	}

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script( 'comment-reply' );
	}
}, 50);


require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/classes/translations-manager.php';
require get_template_directory() . '/inc/classes/screen-manager.php';
require get_template_directory() . '/inc/classes/blocksy-blocks-parser.php';
require get_template_directory() . '/inc/classes/theme-db-versioning.php';
require get_template_directory() . '/inc/components/breadcrumbs.php';
require get_template_directory() . '/inc/components/customizer-builder.php';
require get_template_directory() . '/inc/schema-org.php';
require get_template_directory() . '/inc/classes/class-ct-css-injector.php';
require get_template_directory() . '/inc/classes/class-ct-attributes-parser.php';


require get_template_directory() . '/inc/css/fundamentals.php';
require get_template_directory() . '/inc/css/colors.php';
require get_template_directory() . '/inc/css/selectors.php';
require get_template_directory() . '/inc/css/helpers.php';
require get_template_directory() . '/inc/css/box-shadow-option.php';
require get_template_directory() . '/inc/css/typography.php';
require get_template_directory() . '/inc/css/backgrounds.php';
require get_template_directory() . '/inc/dynamic-css.php';
require get_template_directory() . '/inc/sidebar.php';
require get_template_directory() . '/inc/sidebar-render.php';
require get_template_directory() . '/inc/single/single-helpers.php';
require get_template_directory() . '/inc/single/content-helpers.php';
require get_template_directory() . '/inc/menus.php';

require get_template_directory() . '/inc/components/post-meta.php';
require get_template_directory() . '/inc/components/pagination.php';
require get_template_directory() . '/inc/components/back-to-top.php';
require get_template_directory() . '/inc/components/hero-section.php';
require get_template_directory() . '/inc/components/social-box.php';

require get_template_directory() . '/inc/css/visibility.php';
require get_template_directory() . '/inc/header-helpers.php';
require get_template_directory() . '/inc/meta-boxes.php';
require get_template_directory() . '/inc/components/posts-listing.php';

require get_template_directory() . '/inc/components/images.php';
require get_template_directory() . '/inc/components/gallery.php';

require get_template_directory() . '/inc/integrations/elementor.php';
require get_template_directory() . '/inc/integrations/qubely.php';
require get_template_directory() . '/inc/integrations/beaver-themer.php';
require get_template_directory() . '/inc/integrations/theme-builders.php';
require get_template_directory() . '/inc/integrations/custom-post-types.php';

if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/components/woocommerce-integration.php';
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-actions.php';
require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/admin/helpers/all.php';


/**
 * Customizer additions.
 */
global $wp_customize;

if (isset($wp_customize)) {
	require get_template_directory() . '/inc/customizer/init.php';
}

if (is_admin()) {
	require get_template_directory() . '/admin/init.php';
}

add_action(
	'enqueue_block_editor_assets',
	function () {
		$theme = blocksy_get_wp_parent_theme();
		global $post;

		$m = new Blocksy_Fonts_Manager();
		$m->load_editor_fonts();

		$options = blocksy_get_options('meta/' . get_post_type($post));

		if (blocksy_manager()->post_types->is_supported_post_type()) {
			$options = blocksy_get_options('meta/default');
		}

		$options = apply_filters(
			'blocksy:editor:post_meta_options',
			$options,
			get_post_type($post)
		);

		wp_enqueue_style(
			'ct-main-editor-styles',
			get_template_directory_uri() . '/static/bundle/editor.css',
			[],
			$theme->get('Version')
		);

		if (is_rtl()) {
			wp_enqueue_style(
				'ct-main-editor-rtl-styles',
				get_template_directory_uri() . '/static/bundle/editor-rtl.css',
				['ct-main-editor-styles'],
				$theme->get('Version')
			);
		}

		wp_enqueue_script(
			'ct-main-editor-scripts',
			get_template_directory_uri() . '/static/bundle/editor.js',
			['wp-plugins', 'wp-edit-post', 'wp-element', 'ct-options-scripts'],
			$theme->get('Version'),
			true
		);

		$page_structure = get_post_type($post) === 'page' ? get_theme_mod(
			'single_page_structure', 'type-4'
		) : get_theme_mod(
			'single_blog_post_structure', 'type-3'
		);

		$maybe_cpt = blocksy_manager()->post_types->is_supported_post_type();

		if ($maybe_cpt) {
			$page_structure = get_theme_mod(
				$maybe_cpt . '_single_structure',
				'type-4'
			);
		}

		$localize = [
			'post_options' => $options,
			'default_page_structure' => $page_structure === 'type-4' ? 'normal' : 'narrow'
		];

		wp_localize_script(
			'ct-main-editor-scripts',
			'ct_editor_localizations',
			$localize
		);
	}
);

require get_template_directory() . '/inc/manager.php';

if (!is_admin()) {
	add_filter('script_loader_tag', function ($tag, $handle) {
		$scripts = apply_filters('blocksy-async-scripts-handles', [
			// 'ct-scripts'
		]);

		if (in_array($handle, $scripts)) {
			return str_replace('<script ', '<script async ', $tag);
		}

		return $tag;

		// if the unique handle/name of the registered script has 'async' in it
		if (strpos($handle, 'async') !== false) {
			// return the tag with the async attribute
			return str_replace( '<script ', '<script async ', $tag );
		} else if (
			// if the unique handle/name of the registered script has 'defer' in it
			strpos($handle, 'defer') !== false
		) {
			// return the tag with the defer attribute
			return str_replace( '<script ', '<script defer ', $tag );
		} else {
			return $tag;
		}
	}, 10, 2);
}

Blocksy_Manager::instance();

