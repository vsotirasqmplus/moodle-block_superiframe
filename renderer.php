<?php

class block_superiframe_renderer extends plugin_renderer_base {
   
   //Here we return all the content that the goes in the block
    /**
     * @param $block_id
     *
     * @return string
     */
    public function fetch_block_content($block_id){
        global $USER ,$DB;
        $def_config = get_config('block_superiframe');
        try {
            $configdata = $DB->get_field('block_instances','configdata',array('id' => $block_id));
            if($configdata){
                $config = unserialize(base64_decode($configdata));
            }
        } catch (\Exception $e ) {
            $config = $def_config;
        }

        $content = '';
        $content .= '<br />' . get_string('welcomeuser','block_superiframe',$USER) . '<br/>';

        $link = new moodle_url('/blocks/superiframe/view.php',array('blockid' => $block_id ));
        $content .= html_writer::link( $link , get_string('gotosuperiframe', 'block_superiframe') , array('title' => $config->url ) ) ;
        $content .= '<br/>(' . $config->url . ')';

        return $content ;
   }

    //Here we aggregate all the pieces of content of the view page and displays them
    /**
     * @param $url
     * @param $block_id
     *
     * @internal param $width
     * @internal param $height
     */
    public function display_view_page($url , $block_id ){
        global $USER , $PAGE;
        // get default block configuration
        $def_config = get_config('block_superiframe');

        // start output to browser
        echo $this->output->header();

        // check for capability to show user details
        if(has_capability('block/superiframe:seeuserdetail' , $PAGE->context )){
            // create a link to the user's list of entries in this glossary
            $userpicture = $this->output->user_picture($USER, array('size'=>65));
            $elementUrl = new moodle_url('/user/view.php', array('id' => $USER->id));
            $elementLink = html_writer::link($elementUrl,$userpicture);
            echo '<br/>' . fullname($USER);
            echo '<br/>' . $elementLink;
        }

        // show the heading
        echo $this->output->heading(get_string('pluginname', 'block_superiframe'),5);

        echo '<br/>';

        $sizes = array();
        $sizes['custom']    = ['width' => $def_config->width , 'height' => $def_config->height ] ;
        $sizes['small']     = ['width' => 300 , 'height' => 200 ] ;
        $sizes['medium']    = ['width' => 600 , 'height' => 400 ] ;
        $sizes['large']     = ['width' => 900 , 'height' => 600 ] ;

        // get the parameter if exists
        $size = optional_param('size','custom',PARAM_TEXT);

        // check if the parameter is within the array of predefined parameter sets
        if( ! array_key_exists( $size , $sizes ) ){
            $size = 'custom';
        }

        //fetch the size of the iframe
        $width = $sizes[$size]['width'];
        $height = $sizes[$size]['height'];

        echo $this->show_links( $sizes , $block_id );

        $iframe_attr = array();
        $iframe_attr['src'] = $url ;
        $iframe_attr['width'] = $width ;
        $iframe_attr['height'] = $height ;
        $iframe_attr['class'] = 'block_superiframe_iframe' ;
        $iframe = html_writer::tag('iframe','',$iframe_attr);
        echo '<br/><br/>' . $iframe ;
 
        // send footer out to browser
        echo $this->output->footer();
    }

    /**
     * @param $sizes
     * @param $block_id
     *
     * @return string
     */
    private function show_links(array $sizes , $block_id ){
        $links = '';

        foreach( $sizes as $key => $value){
            $links[] = html_writer::link( new moodle_url('/blocks/superiframe/view.php',array( 'blockid' => $block_id ,'size' => $key)) , get_string('link_'.$key,'block_superiframe')) ;
        }

        return html_writer::div(implode(' ',$links),'block_superiframe_sizes');
    }
}
