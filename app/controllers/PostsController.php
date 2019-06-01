<?php

namespace Staff\Controllers;

use Staff\Controllers\ControllerBase;

class PostsController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function showAction($postId)
    {
        // Pass the $postId parameter to the view
        $this->view->postId = $postId;
    }

}

