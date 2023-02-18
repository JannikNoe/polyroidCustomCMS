<?php

namespace App\Controllers;

use App\BaseController;
use App\Models\Post;
use App\Request;


class LegalsController extends BaseController{
    public function index(Request $request) {

        $this->view->render('legals/index', [

        ]);
    }


}