<?php

namespace App\Controllers;
use App\Basecontroller;


class DashboardController extends BaseController {
    public function index() {
        if (!$this->user->isLoggedIn()) {
            $this->redirectTo('/login');
        }

        $this->view->render('dashboard/index');
    }




}