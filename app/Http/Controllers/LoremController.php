<?php

namespace Dwa15p3\Http\Controllers;

use Illuminate\Http\Request;
use Dwa15p3\Http\Requests;
use Dwa15p3\Http\Controllers\Controller;
use Faker\Factory as Faker;


class LoremController extends Controller
{
    private $title = 'Lorem';
    private $siteTitle = ' | Developer\'s Best Friend';

    /**
    * Responds to requests to GET /lorem
    */
    public function getLorem() {
        return view('lorem')-> withTitle($this->title)-> withSitetitle($this->siteTitle);
    }
    /**
    * Responds to requests to POST /lorem
    */
    public function postLorem(Request $request) {
        $request->flash();
        $qty = $request->input('qty');
        $format = $request->input('format');
        $content = '';
        $faker = Faker::create();
        $paragraphs = $faker->paragraphs($qty);
        switch ($format) {
            // comma separated values wrapped in parens ()
            case 'php' :
                for($i = 0; $i < $qty; $i++) {
                    if ($i == 0)
                        $content .= '(  ';
                    else
                        $content .= ' , ';

                    $content .= "'$paragraphs[$i]'\n";
                }
                $content .= ');';
                break;
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
        
        return view('lorem')-> withTitle($this->title)-> withContent($content)-> withSitetitle($this->siteTitle);
    }
}
