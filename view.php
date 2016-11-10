<?php
        ini_set('display_errors', '1');
        error_reporting(E_ALL);
 
require('../../config.php');
require_once('../../lib/moodlelib.php');
 
require_login();
 
//get our config
$def_config = get_config('block_superiframe');
$block_id = required_param('blockid',PARAM_INT);
 
$usercontext = context_user::instance($USER->id);
$PAGE->set_course($COURSE);
$PAGE->set_url('/blocks/superiframe/view.php',array('blockid' => $block_id ));
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout($def_config->pagelayout);
$PAGE->set_title(get_string('pluginname', 'block_superiframe'));
$PAGE->navbar->add(get_string('pluginname', 'block_superiframe'));
 
$renderer = $PAGE->get_renderer('block_superiframe');

// fetch config data
try {
    $configdata = $DB->get_field('block_instances','configdata',array('id' => $block_id));
    if($configdata){
        $config = unserialize(base64_decode($configdata));
    }
} catch (\Exception $e ) {
    $config = $def_config;    
}

$size = $config->size ;
$sizes = array();
$sizes['custom']    = ['width' => $def_config->width , 'height' => $def_config->height ] ;
$sizes['small']     = ['width' => 300 , 'height' => 200 ] ;
$sizes['medium']    = ['width' => 600 , 'height' => 400 ] ;
$sizes['large']     = ['width' => 900 , 'height' => 600 ] ;

if( ! array_key_exists( $size , $sizes ) ){
    $size = 'custom';
}

//fetch the size of the iframe
$width = $sizes[$size]['width'];
$height = $sizes[$size]['height'];

$renderer->display_view_page($config->url , $width , $height, $block_id );
return;
    