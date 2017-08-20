<?php

/*  Copyright 2014 PressApps

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * @file
 * Main file of the "PressApps Plugin Framework"
 *
 * The file loads the core files if not already done inside another plugin,
 * then it loads the options defined in the options folder.
 *
 * @package pressapps-admin-framework
 */

/**
 * Load the framework core if not done inside another plugin
 */
if ( ! defined( 'PAF' ) ) {
	include dirname( __FILE__ ) . '/core/core.php';
}