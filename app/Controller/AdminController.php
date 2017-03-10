<?php
namespace Controller;

use W\Controller\Controller;

class AdminController extends Controller
{
    public function connexion() {
        $this->show('admin/connexion');
    }
}

