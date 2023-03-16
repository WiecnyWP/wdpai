<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function add()
    {
        $this->render('add');
    }

    public function hau()
    {
        $this->render('hau');
    }

    public function index()
    {
        $this->render('login');
    }

    public function register()
    {
        $this->render('register');
    }

    public function search()
    {
        $this->render('search');
    }

    public function workofart()
    {
        $this->render('workofart');
    }


}