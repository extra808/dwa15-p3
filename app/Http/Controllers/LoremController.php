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
        $format = '';
        $faker = Faker::create();
        $siteTitle = ' | Developer\'s Best Friend';
        $title = 'Lorem';
        $content = '';
        $paragraphs = $faker->paragraphs(3);
        switch ($format) {
            case 'html' :
                foreach ($paragraphs as $paragraph) {
                    $content .= "<p>$paragraph</p>\n";
                }
                break;
            case 'json' :
                $content = json_encode($paragraphs);
                break;
            default :
                foreach ($paragraphs as $paragraph) {
                    $content .= "$paragraph\n\n";
                }
 
        }
        
        return view('lorem')-> withTitle($title)-> withContent($content)-> withSitetitle($siteTitle);
    }
}
