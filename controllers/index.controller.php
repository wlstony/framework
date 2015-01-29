<?php
require_once FRAME_ROOT . '/controllers/base.controller.php';

class Index_Controller extends Base_Controller {
    
    function indexAction() {
        View::show('wse/login');
    }

}

