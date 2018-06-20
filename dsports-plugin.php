<?php
/**
*
*@package dsports
*/
/*
 * Plugin Name: dsports-plugin
 * Plugin URI: https://github.com/AlbertHerrera/dsport_plugin
 * Description: Este plugin crea concursos online.
 * Version: 1.0
 * Author: Albert Herrera
 * License: GPLv2 or later.
 * Author URI: wwww.shuffleshowcase.com
 *
 * Text Domain: dsports
 */
 /*
 This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

 //Protects from unauthorized access
defined( 'ABSPATH' ) or die( 'You can not access this file,
maybe you will not get bored playing some parchis ;)
http://www.mundijuegos.com' );

//Imports autoload composer folders.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

//Initialize the core classes of the plugin
if ( class_exists( 'Inc\\Init' ) ) {
	global $wpdb;
	Inc\Init::register_services();
}


//The code that runs during plugin activation

register_activation_hook(__FILE__,'activate_plugin_dsports');
function activate_plugin_dsports(){
	Inc\Base\Activate::activate();
}

//The code that runs during plugin deactivation

register_deactivation_hook(__FILE__,'deactivate_plugin_dsports');
function deactivate_plugin_dsports(){
	Inc\Base\Deactivate::deactivate();
}
