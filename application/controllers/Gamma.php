<?php

/**
 * Secret stuff
 * 
 * controllers/Welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Gamma extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  We could tell you what was here, but...
    //-------------------------------------------------------------

    function index() {
        $this->restrict(ROLE_ADMIN);
        $this->data['pagebody'] = 'gamma';
        $this->render();
    }

}
