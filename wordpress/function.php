<?php
    function my_setup(){
        add_theme_support('post-thumbnails');// アイキャッチ画像
        add_theme_support('automatic-feed-links');// RSSフィードのURLを自動で出力
        add_theme_support('title-tag');// タイトルタグ自動生成※使用する場合はh1タグをheader.phpに直接記述しない
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );// HTML5マークアップを有効化
    }
    add_action("after_setup_theme", "my_setup");

    function my_script_init(){
        wp_enqueue_style("font-awesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css", array() , "5.8.2", "all");
        wp_enqueue_style("my", get_template_directory_uri() . "/css/style.css", array() , filemtime(get_theme_file_path( "css/style.css" )), "all");
        wp_enqueue_script("my", get_template_directory_uri() . "/js/script.js" , array("jQuery"), filemtime(get_theme_file_path( "/js/script.js" )), true);
    }
    add_action("wp_enqueue_scripts", "my_script_init");

    function my_menu_init(){
        register_nav_menus(
            array(
                'global' => 'ヘッダーメニュー',
                'drawer' => 'ドロワーメニュー',
                'footer' => 'フッターメニュー'
            )
        );
    }
    add_action('init', 'my_menu_init');

    function my_archive_title() {
        if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title =  get_the_author();
        } elseif ( is_year() ) {
            $title =  get_the_date( 'Y年' );
        } elseif ( is_month() ) {
            $title =  get_the_date( 'Y年F' );
        } elseif ( is_day() ) {
            $title =  get_the_date( 'Y年Fd日' );
        } else {
            $title = 'ARCHIVE';
        }
        return $title;
    }
    add_filter( 'get_the_archive_title', 'my_archive_title' );

?>