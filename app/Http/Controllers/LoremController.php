<?php

namespace Dwa15p3\Http\Controllers;

use Illuminate\Http\Request;
use Dwa15p3\Http\Requests;
use Dwa15p3\Http\Controllers\Controller;
use Faker\Factory as Faker;


class LoremController extends Controller
{

    /**
    * Responds to requests to GET /lorem
    */
    public function getLorem() {
        $faker = Faker::create();
        return dd($faker->paragraphs(3) );
    }
}