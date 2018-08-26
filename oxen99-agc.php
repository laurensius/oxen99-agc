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
    echo 'Jangan nakal, kalo nakal nanti diseruduk sama OXEN.';
	exit;
}

define( 'OXEN99_DIR', plugin_dir_path( __FILE__ ) );
define( 'OXEN99_VIEW_DIR', OXEN99_DIR.'view/' );

require_once(OXEN99_DIR . 'class.oxen99.php' );
require_once(OXEN99_DIR . 'class.oxen99-badkeyword.php' );
require_once(OXEN99_DIR . 'class.oxen99-jadwal-grubing.php' );

function inisialisasi(){
    add_menu_page( 'OXEN99 AGC', 'OXEN99 AGC', 'manage_options', 'm_oxen99_agc', 'f_top_menu', 'dashicons-star-filled', 99 );
    add_submenu_page( 'm_oxen99_agc', 'Bad Keyword', 'Bad keyword', 'manage_options', 's_bad_keyword', 'f_bad_keyword' ); 
    add_submenu_page( 'm_oxen99_agc', 'Jadwal Grubing', 'Jadwal Grubing', 'manage_options', 's_jadwal_grubing', 'f_jadwal_grubing' ); 
    add_submenu_page( 'm_oxen99_agc', 'About OXEN99', 'About OXEN99', 'manage_options', 's_about_oxen99', 'f_about_oxen99' ); 
}

function f_top_menu(){
    $O = new Oxen99();
    $O->say_hello();
}

function f_jadwal_grubing(){
    $OJG = new Oxen99_Jadwal_Grubing();
    $OJG->load_form();
}

function f_bad_keyword(){
    $OBK = new Oxen99_Bad_Keyword();
    $OBK->load_form();
}

function f_about_oxen99(){
    $O = new Oxen99();
    $O->about();
}

add_action( 'admin_menu', 'inisialisasi' );

