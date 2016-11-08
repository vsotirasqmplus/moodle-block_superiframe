<?php

class block_superiframe_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        // Section header title according to language file.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        // A sample string variable with a default value.
        $mform->addElement('text', 'config_text', get_string('blockstring', 'block_superiframe'));
        $mform->setDefault('config_text', 'Configuration');
        $mform->setType('config_text', PARAM_TEXT);

        $config = get_config('block_superiframe');
        $mform->addElement('text','config_url',get_string('url','block_superiframe'));
        $mform->setDefault('config_url',$config->url);
        $mform->setType('config_ulr',PARAM_URL);

    }
}
