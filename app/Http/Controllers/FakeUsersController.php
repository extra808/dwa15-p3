<?php

namespace Dwa15p3\Http\Controllers;

use Illuminate\Http\Request;
use Dwa15p3\Http\Requests;
use Dwa15p3\Http\Controllers\Controller;
use Faker\Factory as Faker;

class FakeUsersController extends Controller
{
    private $title = 'Fake Users';

    /**
    * Responds to requests to GET /fakeusers
    */
    public function getFakeUsers() {
        return view('fakeusers')-> withTitle($this->title)-> withSitetitle($this->siteTitle);
    }
}
