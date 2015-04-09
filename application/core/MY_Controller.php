<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2013, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data['title'] = "Top Secret Government Site";    // our default title
        $this->errors = array();
        $this->data['pageTitle'] = 'welcome';   // our default page
    }

    function restrict($roleNeeded = null) {
        $userRole = $this->session->userdata('userRole');
        
        if ($roleNeeded != null) {
            if (is_array($roleNeeded)) {
                if (!in_array($userRole, $roleNeeded)) {
                    redirect('/');
                    return;
                }
            } else if ($userRole != $roleNeeded) {
                redirect ('/');
                return;
            }
        }
    }
    
    /**
     * Render this page
     */
    function render() {
        $this->data['menubar'] = $this->parser->parse('_menubar', $this->makemenu(),true);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);

        // finally, build the browser page!
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }

    /**
     * Modify the menu based on the users role.
     * 
     * @return string
     */
    function makemenu() {
        $userRole = $this->session->userdata('userRole');
        
        $menu = array( 'menudata' => array( array('name' => "Alpha", 'link' => '/alpha') ) );
        
        if ($userRole === NULL)
        {
            $menu['menudata'][] = array('name' => "Login", 'link' => '/auth');
        }
        else
        {
            if ($userRole == ROLE_USER)
            {
                $menu['menudata'][] = array('name' => "Beta", 'link' => '/beta');
            }
            else if ($userRole == ROLE_ADMIN)
            {
                $menu['menudata'][] = array('name' => "Beta", 'link' => '/beta');
                $menu['menudata'][] = array('name' => "Gamma", 'link' => '/gamma');
            }

            $menu['menudata'][] = array('name' => "Logout", 'link' => '/auth/logout');
        }

        return $menu;
    }
}

/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */