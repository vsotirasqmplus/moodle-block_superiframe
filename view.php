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
 
 
// start output to browser
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'block_superiframe'),5);
 
// Some content goes here


$userpicture = $OUTPUT->user_picture($USER, array('size'=>65));
$elementUrl = new moodle_url('/user/view.php', array('id' => $USER->id));
$elementLink = html_writer::link($elementUrl,$userpicture);

// create a link to the user's list of entries in this glossary

echo  fullname($USER);
echo '<br>' .$elementLink;

$src = $def_config->url;
$width = $def_config->width ;
$height =  $def_config->height ;

echo "<iframe src='$src' height='$height' width='$width' style='border:0'></iframe>";
 
//send footer out to browser
echo $OUTPUT->footer();
return;
    