<?php
/**
 * One-click demo content importer: categories, fictional Bengali
 * articles written specifically for BDC News Desk, and the sample menu.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Categories created by the importer: slug => Bengali name.
 *
 * @return array
 */
function bdcnd_demo_categories() {
	return array(
		'bangladesh'    => 'বাংলাদেশ',
		'probash'       => 'প্রবাস',
		'politics'      => 'রাজনীতি',
		'sports'        => 'খেলা',
		'foreign'       => 'বিদেশ',
		'entertainment' => 'বিনোদন',
		'media'         => 'গণমাধ্যম',
		'jobs'          => 'চাকরির খবর',
		'tech'          => 'বিজ্ঞান ও তথ্যপ্রযুক্তি',
		'opinion'       => 'মতামত',
		'economy'       => 'অর্থনীতি',
		'education'     => 'শিক্ষা',
		'literature'    => 'সাহিত্য',
		'feature'       => 'ফিচার',
		'gallery'       => 'ফটো গ্যালারী',
	);
}

/**
 * Fictional demo articles. Written specifically for this theme — no real
 * people, organizations or events. Each ends with a small demo notice.
 *
 * @return array
 */
function bdcnd_demo_posts() {
	$notice = "\n\n<p><em>(এটি BDC News Desk থিমের ডেমো উদ্দেশ্যে তৈরি একটি কাল্পনিক প্রতিবেদন। এটি কোনো প্রকৃত ঘটনার প্রতিনিধিত্ব করে না।)</em></p>";

	return array(
		array(
			'cat'     => 'bangladesh',
			'title'   => 'রাজধানীর যানজট নিরসনে নতুন পাঁচ দফা পরিকল্পনা ঘোষণা',
			'content' => '<p>নগর কর্তৃপক্ষ রাজধানীর প্রধান সড়কগুলোতে যানজট কমাতে পাঁচ দফা পরিকল্পনা ঘোষণা করেছে, যার মধ্যে রয়েছে বাস র‍্যাপিড ট্রানজিট নেটওয়ার্ক সম্প্রসারণ ও স্মার্ট ট্রাফিক সিগন্যাল স্থাপন।</p><p>কর্তৃপক্ষের মতে, আগামী দুই বছরের মধ্যে ধাপে ধাপে এই পরিকল্পনা বাস্তবায়ন করা হবে এবং নগরবাসীর মতামতের ভিত্তিতে প্রয়োজনীয় সমন্বয় করা হবে।</p>' . $notice,
		),
		array(
			'cat'     => 'bangladesh',
			'title'   => 'গ্রামীণ এলাকায় বিশুদ্ধ পানির সংকট নিরসনে নতুন প্রকল্প শুরু',
			'content' => '<p>দেশের কয়েকটি জেলার প্রত্যন্ত অঞ্চলে সুপেয় পানির সংকট নিরসনে একটি নতুন প্রকল্প চালু হয়েছে, যার আওতায় সৌরচালিত পানি শোধনাগার স্থাপন করা হবে।</p><p>স্থানীয় বাসিন্দারা বলছেন, প্রকল্পটি বাস্তবায়িত হলে হাজারো পরিবার সরাসরি উপকৃত হবে।</p>' . $notice,
		),
		array(
			'cat'     => 'probash',
			'title'   => 'প্রবাসী শ্রমিকদের জন্য নতুন স্বাস্থ্যবীমা কর্মসূচি চালু',
			'content' => '<p>বিদেশে কর্মরত প্রবাসীদের স্বাস্থ্যসেবা নিশ্চিত করতে একটি নতুন গ্রুপ স্বাস্থ্যবীমা কর্মসূচি চালু হয়েছে, যা প্রাথমিকভাবে কয়েকটি দেশে কর্মরত শ্রমিকদের জন্য প্রযোজ্য হবে।</p><p>উদ্যোক্তারা জানিয়েছেন, ধাপে ধাপে কর্মসূচিটি আরও দেশে সম্প্রসারণ করা হবে।</p>' . $notice,
		),
		array(
			'cat'     => 'probash',
			'title'   => 'প্রবাসী কমিউনিটির উদ্যোগে যৌথ বৃক্ষরোপণ কর্মসূচি',
			'content' => '<p>প্রবাসে বসবাসরত একটি বাংলাদেশি কমিউনিটি সংগঠন স্থানীয় কর্তৃপক্ষের সহযোগিতায় বৃক্ষরোপণ কর্মসূচির আয়োজন করেছে।</p><p>আয়োজকরা বলছেন, পরিবেশ সচেতনতা বৃদ্ধি ও প্রবাসী প্রজন্মের মধ্যে সংস্কৃতির চর্চা ধরে রাখাই এই আয়োজনের মূল লক্ষ্য।</p>' . $notice,
		),
		array(
			'cat'     => 'politics',
			'title'   => 'ভোটার উপস্থিতি বাড়াতে নির্বাচন কমিশনের নতুন উদ্যোগ',
			'content' => '<p>আসন্ন স্থানীয় নির্বাচনে ভোটার উপস্থিতি বাড়াতে সচেতনতামূলক প্রচারণা শুরু করার সিদ্ধান্ত নিয়েছে সংশ্লিষ্ট কর্তৃপক্ষ।</p><p>এই উদ্যোগের আওতায় শিক্ষাপ্রতিষ্ঠান ও কমিউনিটি পর্যায়ে সেমিনার আয়োজন করা হবে বলে জানা গেছে।</p>' . $notice,
		),
		array(
			'cat'     => 'politics',
			'title'   => 'স্থানীয় সরকার সংস্কারে বিশেষজ্ঞ কমিটি গঠনের সুপারিশ',
			'content' => '<p>স্থানীয় সরকার ব্যবস্থাকে আরও কার্যকর করতে একটি স্বাধীন বিশেষজ্ঞ কমিটি গঠনের সুপারিশ করেছেন গবেষকরা।</p><p>প্রস্তাবিত কমিটি প্রশাসনিক কাঠামো পর্যালোচনা করে আগামী কয়েক মাসের মধ্যে প্রতিবেদন জমা দেবে বলে আশা করা হচ্ছে।</p>' . $notice,
		),
		array(
			'cat'     => 'sports',
			'title'   => 'জাতীয় ক্রিকেট দলের নতুন কোচ নিয়োগ, লক্ষ্য আগামী বিশ্বকাপ',
			'content' => '<p>জাতীয় ক্রিকেট বোর্ড আগামী বিশ্বকাপ সামনে রেখে দলের জন্য নতুন প্রধান কোচ নিয়োগ দিয়েছে।</p><p>নতুন কোচের অধীনে আগামী মাস থেকে বিশেষ প্রস্তুতি ক্যাম্প শুরু হবে বলে বোর্ড সূত্রে জানা গেছে।</p>' . $notice,
		),
		array(
			'cat'     => 'sports',
			'title'   => 'স্কুল পর্যায়ে ফুটবল টুর্নামেন্ট শুরু, অংশ নিচ্ছে ৬৪ জেলা',
			'content' => '<p>দেশব্যাপী স্কুল ফুটবল টুর্নামেন্টের নতুন আসর শুরু হয়েছে, যেখানে অংশ নিচ্ছে ৬৪টি জেলার শতাধিক দল।</p><p>আয়োজকদের আশা, এই টুর্নামেন্ট থেকে আগামী দিনের প্রতিভাবান খেলোয়াড় উঠে আসবে।</p>' . $notice,
		),
		array(
			'cat'     => 'foreign',
			'title'   => 'জলবায়ু পরিবর্তন মোকাবিলায় আঞ্চলিক দেশগুলোর যৌথ ঘোষণা',
			'content' => '<p>দক্ষিণ এশিয়ার কয়েকটি দেশ জলবায়ু পরিবর্তনের প্রভাব মোকাবিলায় যৌথ কর্মপরিকল্পনা গ্রহণের ঘোষণা দিয়েছে।</p><p>ঘোষণায় উপকূলীয় এলাকা সুরক্ষা ও নবায়নযোগ্য জ্বালানিতে বিনিয়োগ বাড়ানোর বিষয়ে গুরুত্ব দেওয়া হয়েছে।</p>' . $notice,
		),
		array(
			'cat'     => 'foreign',
			'title'   => 'আন্তর্জাতিক বাণিজ্য মেলায় দেশীয় পণ্যের ব্যাপক সাড়া',
			'content' => '<p>একটি আন্তর্জাতিক বাণিজ্য মেলায় দেশীয় প্রতিষ্ঠানগুলোর প্রদর্শিত পণ্য দর্শনার্থীদের কাছ থেকে ব্যাপক সাড়া পেয়েছে।</p><p>উদ্যোক্তারা বলছেন, এই অংশগ্রহণ নতুন রপ্তানি বাজার তৈরিতে সহায়ক হবে।</p>' . $notice,
		),
		array(
			'cat'     => 'entertainment',
			'title'   => "নতুন চলচ্চিত্র 'আলোর ঠিকানা' মুক্তি পাচ্ছে আগামী মাসে",
			'content' => '<p>প্রতীক্ষিত নতুন বাংলা চলচ্চিত্র আগামী মাসে সারাদেশের প্রেক্ষাগৃহে মুক্তি পাচ্ছে বলে জানিয়েছেন নির্মাতারা।</p><p>ছবিটি নিয়ে দর্শকদের মধ্যে ইতিমধ্যে বেশ আগ্রহ তৈরি হয়েছে বলে জানা গেছে।</p>' . $notice,
		),
		array(
			'cat'     => 'entertainment',
			'title'   => 'তরুণ কণ্ঠশিল্পীদের নিয়ে নতুন সংগীত প্রতিযোগিতা শুরু',
			'content' => '<p>উদীয়মান কণ্ঠশিল্পীদের মঞ্চ দিতে একটি নতুন সংগীত প্রতিযোগিতার আয়োজন করা হয়েছে।</p><p>সারাদেশ থেকে অংশগ্রহণকারীদের নিবন্ধন চলছে বলে আয়োজকরা জানিয়েছেন।</p>' . $notice,
		),
		array(
			'cat'     => 'media',
			'title'   => 'সাংবাদিকদের ডিজিটাল নিরাপত্তা বিষয়ক কর্মশালা অনুষ্ঠিত',
			'content' => '<p>গণমাধ্যমকর্মীদের অনলাইন নিরাপত্তা সম্পর্কে সচেতন করতে একটি কর্মশালা অনুষ্ঠিত হয়েছে।</p><p>কর্মশালায় ডিজিটাল তথ্য সুরক্ষা ও দায়িত্বশীল সাংবাদিকতার বিভিন্ন দিক নিয়ে আলোচনা করা হয়।</p>' . $notice,
		),
		array(
			'cat'     => 'jobs',
			'title'   => 'সরকারি প্রতিষ্ঠানে ২০০ পদে নিয়োগ বিজ্ঞপ্তি প্রকাশ',
			'content' => '<p>একটি সরকারি প্রতিষ্ঠানে বিভিন্ন পদে মোট ২০০ জনবল নিয়োগের বিজ্ঞপ্তি প্রকাশ করা হয়েছে।</p><p>আগ্রহী প্রার্থীদের নির্ধারিত সময়ের মধ্যে অনলাইনে আবেদন করার জন্য অনুরোধ জানানো হয়েছে।</p>' . $notice,
		),
		array(
			'cat'     => 'jobs',
			'title'   => 'তথ্যপ্রযুক্তি খাতে তরুণদের জন্য বিনামূল্যে প্রশিক্ষণ কর্মসূচি',
			'content' => '<p>বেকার তরুণ-তরুণীদের দক্ষ করে তুলতে তথ্যপ্রযুক্তি খাতে একটি বিনামূল্যে প্রশিক্ষণ কর্মসূচি চালু হয়েছে।</p><p>প্রশিক্ষণ শেষে অংশগ্রহণকারীদের সনদ ও কর্মসংস্থান সহায়তা দেওয়া হবে বলে জানা গেছে।</p>' . $notice,
		),
		array(
			'cat'     => 'tech',
			'title'   => 'দেশীয় স্টার্টআপের কৃষি অ্যাপ পেল আন্তর্জাতিক স্বীকৃতি',
			'content' => '<p>একটি দেশীয় প্রযুক্তি প্রতিষ্ঠানের তৈরি কৃষি সহায়ক মোবাইল অ্যাপ আন্তর্জাতিক একটি উদ্ভাবনী প্রতিযোগিতায় স্বীকৃতি পেয়েছে।</p><p>অ্যাপটি কৃষকদের আবহাওয়া তথ্য ও বাজারদর সম্পর্কে তাৎক্ষণিক আপডেট দিয়ে থাকে।</p>' . $notice,
		),
		array(
			'cat'     => 'tech',
			'title'   => 'নেটওয়ার্ক সম্প্রসারণে নতুন পরিকল্পনা প্রকাশ',
			'content' => '<p>দেশের প্রধান শহরগুলোতে উচ্চগতির ইন্টারনেট সংযোগ সম্প্রসারণে একটি নতুন পরিকল্পনা প্রকাশ করা হয়েছে।</p><p>পরিকল্পনার আওতায় আগামী কয়েক বছরে গ্রামীণ এলাকাতেও সংযোগ পৌঁছে দেওয়ার লক্ষ্য নির্ধারণ করা হয়েছে।</p>' . $notice,
		),
		array(
			'cat'     => 'opinion',
			'title'   => 'মতামত: ডিজিটাল সাক্ষরতা কেন এখন সময়ের দাবি',
			'content' => '<p>দ্রুত বদলে যাওয়া প্রযুক্তির যুগে ডিজিটাল সাক্ষরতা কেবল দক্ষতা নয়, বরং একটি মৌলিক প্রয়োজন হয়ে দাঁড়িয়েছে।</p><p>শিক্ষাপ্রতিষ্ঠান থেকে শুরু করে পরিবার—সব পর্যায়ে সচেতন উদ্যোগ ছাড়া এই ব্যবধান কমানো কঠিন হবে বলে মত দিয়েছেন বিশ্লেষকরা।</p>' . $notice,
		),
		array(
			'cat'     => 'economy',
			'title'   => 'রপ্তানি আয়ে প্রবৃদ্ধি, নতুন সম্ভাবনার দ্বার খুলছে',
			'content' => '<p>চলতি অর্থবছরের সাম্প্রতিক পরিসংখ্যানে রপ্তানি আয়ে উল্লেখযোগ্য প্রবৃদ্ধি লক্ষ্য করা গেছে।</p><p>অর্থনীতিবিদরা বলছেন, নতুন বাজারে প্রবেশের সুযোগ কাজে লাগাতে পারলে এই ধারা অব্যাহত থাকবে।</p>' . $notice,
		),
		array(
			'cat'     => 'education',
			'title'   => 'স্কুলে বিজ্ঞানভিত্তিক শিক্ষা কার্যক্রম সম্প্রসারণের উদ্যোগ',
			'content' => '<p>মাধ্যমিক পর্যায়ে শিক্ষার্থীদের মধ্যে বিজ্ঞানচর্চা বাড়াতে ব্যবহারিক ক্লাস সম্প্রসারণের উদ্যোগ নেওয়া হয়েছে।</p><p>নির্বাচিত বিদ্যালয়গুলোতে ধাপে ধাপে নতুন পরীক্ষাগার সরঞ্জাম সরবরাহ করা হবে বলে জানা গেছে।</p>' . $notice,
		),
		array(
			'cat'     => 'literature',
			'title'   => "নতুন কবিতা সংকলন 'নদীর কাছে চিঠি' প্রকাশিত হলো",
			'content' => '<p>একজন তরুণ কবির নতুন কবিতা সংকলন সম্প্রতি বাজারে এসেছে, যা ইতিমধ্যে পাঠকমহলে আলোচিত হচ্ছে।</p><p>বইটিতে জীবন, প্রকৃতি ও স্মৃতির বিভিন্ন অনুষঙ্গ উঠে এসেছে বলে জানিয়েছেন প্রকাশক।</p>' . $notice,
		),
		array(
			'cat'     => 'feature',
			'title'   => 'ফিচার: শহরের ছাদ বাগানে বদলে যাচ্ছে নগরজীবন',
			'content' => '<p>ইট-কাঠের শহরে সবুজের ছোঁয়া আনতে ছাদ বাগান করছেন অনেক নগরবাসী, যা ধীরে ধীরে একটি জনপ্রিয় প্রবণতায় পরিণত হয়েছে।</p><p>শখের পাশাপাশি এই উদ্যোগ পরিবেশ ও মানসিক স্বাস্থ্যের জন্যও উপকারী বলে মনে করছেন সংশ্লিষ্টরা।</p>' . $notice,
		),
		array(
			'cat'     => 'gallery',
			'title'   => 'ফটো ফিচার: শীতের সকালে গ্রামীণ জনজীবন',
			'content' => '<p>শীতের কুয়াশা মোড়া সকালে গ্রামীণ জনপদের চিরচেনা দৃশ্য ফুটে উঠেছে সাম্প্রতিক এক ফটো সংকলনে।</p><p>খেজুরের রস সংগ্রহ থেকে শুরু করে মাঠের কর্মব্যস্ততা—সবই উঠে এসেছে ছবিগুলোতে।</p>' . $notice,
		),
	);
}

/**
 * Menu items created for the sample primary menu: label => category slug (or '' for home).
 *
 * @return array
 */
function bdcnd_demo_menu_items() {
	return array(
		'home'          => __( 'প্রচ্ছদ', 'bdc-news-desk' ),
		'bangladesh'    => 'বাংলাদেশ',
		'probash'       => 'প্রবাস',
		'politics'      => 'রাজনীতি',
		'sports'        => 'খেলা',
		'foreign'       => 'বিদেশ',
		'entertainment' => 'বিনোদন',
		'media'         => 'গণমাধ্যম',
		'jobs'          => 'চাকরির খবর',
		'tech'          => 'বিজ্ঞান ও তথ্যপ্রযুক্তি',
		'opinion'       => 'মতামত',
		'economy'       => 'অর্থনীতি',
		'education'     => 'শিক্ষা',
	);
}

/**
 * Handle the "Import Demo Content" form submission.
 */
function bdcnd_handle_demo_content_import() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to do this.', 'bdc-news-desk' ) );
	}
	check_admin_referer( 'bdcnd_import_demo_content', 'bdcnd_nonce' );

	$category_ids = array();
	foreach ( bdcnd_demo_categories() as $slug => $name ) {
		$term = get_term_by( 'slug', $slug, 'category' );
		if ( ! $term ) {
			$inserted = wp_insert_term( $name, 'category', array( 'slug' => $slug ) );
			$term_id  = is_wp_error( $inserted ) ? 0 : $inserted['term_id'];
		} else {
			$term_id = $term->term_id;
		}
		if ( $term_id ) {
			$category_ids[ $slug ] = $term_id;
		}
	}

	$author_id = get_current_user_id();

	foreach ( bdcnd_demo_posts() as $post_data ) {
		if ( ! isset( $category_ids[ $post_data['cat'] ] ) ) {
			continue;
		}
		$existing = get_posts(
			array(
				'post_type'              => 'post',
				'title'                  => $post_data['title'],
				'posts_per_page'         => 1,
				'post_status'            => 'any',
				'fields'                 => 'ids',
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
			)
		);
		if ( ! empty( $existing ) ) {
			continue;
		}
		wp_insert_post(
			array(
				'post_title'   => $post_data['title'],
				'post_content' => $post_data['content'],
				'post_status'  => 'publish',
				'post_type'    => 'post',
				'post_author'  => $author_id,
				'post_category' => array( $category_ids[ $post_data['cat'] ] ),
			)
		);
	}

	bdcnd_create_demo_menu( $category_ids );

	update_option( 'bdcnd_demo_content_imported', 1 );
	update_option( 'bdcnd_demo_content_imported_at', time() );

	wp_safe_redirect( add_query_arg( array( 'page' => 'bdc-news-desk', 'bdcnd_status' => 'imported' ), admin_url( 'themes.php' ) ) );
	exit;
}
add_action( 'admin_post_bdcnd_import_demo_content', 'bdcnd_handle_demo_content_import' );

/**
 * Create (or update) the sample primary menu and assign it.
 *
 * @param array $category_ids slug => term_id map.
 */
function bdcnd_create_demo_menu( $category_ids ) {
	$menu_name = __( 'BDC News Desk Primary Menu', 'bdc-news-desk' );
	$menu      = wp_get_nav_menu_object( $menu_name );

	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $menu_name );
	} else {
		$menu_id = $menu->term_id;
		foreach ( wp_get_nav_menu_items( $menu_id ) as $item ) {
			wp_delete_post( $item->ID, true );
		}
	}

	$position = 1;
	foreach ( bdcnd_demo_menu_items() as $slug => $label ) {
		if ( 'home' === $slug ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'     => $label,
					'menu-item-url'       => home_url( '/' ),
					'menu-item-status'    => 'publish',
					'menu-item-position'  => $position,
				)
			);
		} elseif ( isset( $category_ids[ $slug ] ) ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'     => $label,
					'menu-item-object'    => 'category',
					'menu-item-object-id' => $category_ids[ $slug ],
					'menu-item-type'      => 'taxonomy',
					'menu-item-status'    => 'publish',
					'menu-item-position'  => $position,
				)
			);
		}
		++$position;
	}

	$locations               = get_theme_mod( 'nav_menu_locations', array() );
	$locations['primary']    = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}
