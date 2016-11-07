<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * superiframe block caps.
 *
 * @package    block_superiframe
 * @copyright  Daniel Neis <danielneis@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$settings->add(new admin_setting_heading('sampleheader',
                                         get_string('headerconfig', 'block_superiframe'),
                                         get_string('descconfig', 'block_superiframe')));

/*
$settings->add(new admin_setting_configcheckbox('superiframe/foo',
                                                get_string('labelfoo', 'block_superiframe'),
                                                get_string('descfoo', 'block_superiframe'),
                                                '0'));
*/
$defaulturl='https://quizlet.com/132695231/scatter/embed';
$settings->add(new admin_setting_configtext('block_superiframe/url', get_string('url', 'block_superiframe'),
            get_string('url_details', 'block_superiframe'), $defaulturl, PARAM_RAW)); 

$default_width = 600;
$settings->add(new admin_setting_configtext('block_superiframe/width', get_string('width', 'block_superiframe'),
            get_string('width_details', 'block_superiframe'), $default_width, PARAM_INT)); 

$default_height = 400;
$settings->add(new admin_setting_configtext('block_superiframe/height', get_string('height', 'block_superiframe'),
            get_string('height_details', 'block_superiframe'), $default_height, PARAM_INT)); 


$default_pagelayout = 'course';
$page_layouts_options = array();
$page_layouts_options['course'] = get_string( $default_pagelayout );
$page_layouts_options['popup'] = get_string('popup');

$settings->add(new admin_setting_configselect('block_superiframe/pagelayout', get_string('pagelayout', 'block_superiframe'),
            get_string('pagelayout_details', 'block_superiframe'), $default_pagelayout , $page_layouts_options)); 


