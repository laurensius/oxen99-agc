<?php
/*
Plugin Name:  OXEN99 AGC
Plugin URI:   https://github.com/laurensius/pangepetan_oxen99_penjadwalan/
Description:  Auto generate content untuk website dengan CMS WP karya Tim Pangepetan Online OXEN99
Version:      1.0 Beta 
Author:       Tim Pangepetan Online OXEN99
Author URI:   http://laurensius-dede-suhardiman.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/


if ( !function_exists( 'add_action' ) ) {
    echo 'Jangan nakal, kalo nakal nanti diseruduk sama OXEN99.';
	exit;
}

define( 'OXEN99_DIR', plugin_dir_path( __FILE__ ) );
define( 'OXEN99_VIEW_DIR', OXEN99_DIR.'view/' );
define( 'OXEN99_TBL_BADWORD', 'oxen99_badword' );

require_once(OXEN99_DIR . 'class.oxen99.php' );
require_once(OXEN99_DIR . 'class.oxen99-badword.php' );
require_once(OXEN99_DIR . 'class.oxen99-jadwal-grubing.php' );

function f_create_admin_menu(){
    add_menu_page( 'OXEN99 AGC', 'OXEN99 AGC', 'manage_options', 'm_oxen99_agc', 'f_top_menu', 'dashicons-star-filled', 99 );
    add_submenu_page( 'm_oxen99_agc', 'Bad Word', 'Bad Word', 'manage_options', 's_bad_word', 'f_bad_word' ); 
    add_submenu_page( 'm_oxen99_agc', 'Jadwal Grubing', 'Jadwal Grubing', 'manage_options', 's_jadwal_grubing', 'f_jadwal_grubing' ); 
    add_submenu_page( 'm_oxen99_agc', 'About OXEN99', 'About OXEN99', 'manage_options', 's_about_oxen99', 'f_about_oxen99' ); 
}

function f_create_tbl_plugin(){
    global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'oxen99_badword';
	$sql = "CREATE TABLE $table_name (
        id int(99) NOT NULL AUTO_INCREMENT, 
        badword varchar(255) NOT NULL,
        UNIQUE KEY id (id)) $charset_collate ;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

function f_drop_tbl_plugin(){
    global $wpdb;
	$table_name = $wpdb->prefix . 'oxen99_badword';
	$sql = "DROP TABLE IF EXISTS $table_name ;";
    $wpdb->query($sql);
}

function f_top_menu(){
    $O = new Oxen99();
    $O->say_hello(OXEN99_DIR . "view/page.dashboard.php");
}

function f_jadwal_grubing(){
    $OJG = new Oxen99_Jadwal_Grubing();
    $OJG->load_form();
}

function f_bad_word(){
    $OBK = new Oxen99_Bad_Word();
    $OBK->load_form(OXEN99_DIR . "view/page.badword.php");
}

function f_about_oxen99(){
    $O = new Oxen99();
    $O->about(OXEN99_DIR . "view/page.about.php");
}


add_action( 'admin_menu', 'f_create_admin_menu' );
register_activation_hook( __FILE__, 'f_create_tbl_plugin' );
register_deactivation_hook( __FILE__, 'f_drop_tbl_plugin' );

