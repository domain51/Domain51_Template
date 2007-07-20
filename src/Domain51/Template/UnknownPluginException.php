<?php

class Domain51_Template_UnknownPluginException extends PEAR_Exception
{
    public function __construct($plugin_name)
    {
        parent::__construct(
            'requested plugin unknown',
            array('$plugin_name' => $plugin_name)
        );
    }
}
