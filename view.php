<?php
 
require('../../config.php');
require_once('../../lib/moodlelib.php');
 
require_login();
 
//get our config
$def_config = get_config('block_superiframe');
 
$usercontext = context_user::instance($USER->id);
$PAGE->set_course($COURSE);
$PAGE->set_url('/blocks/superiframe/view.php');
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout($def_config->pagelayout);
$PAGE->set_title(get_string('pluginname', 'block_superiframe'));
$PAGE->navbar->add(get_string('pluginname', 'block_superiframe'));
 
$renderer = $PAGE->get_renderer('block_superiframe');
$renderer->display_view_page($def_config->url , $def_config->width , $def_config->height);
return;
    