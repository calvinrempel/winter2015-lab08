<?php

/**
 * Our registered users' content. 
 * 
 * controllers/Welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Beta extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  Stuff that should only be seen by logged in users
    //-------------------------------------------------------------

    function index() {
        $this->restrict(ROLE_USER, ROLE_ADMIN);
        $this->data['pagebody'] = 'beta';
        $this->render();
    }

}
