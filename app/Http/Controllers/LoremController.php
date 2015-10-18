<?php

namespace Dwa15p3\Http\Controllers;

use Illuminate\Http\Request;
use Dwa15p3\Http\Requests;
use Dwa15p3\Http\Controllers\Controller;
use Faker\Factory as Faker;
use Badcow\LoremIpsum as Badcow;

class LoremController extends Controller
{
    private $title = 'Lorem';
    private $qty = 3;

    /**
    * Responds to requests to GET /lorem
    */
    public function getLorem() {
        $session = session()->all();
        if(isset($session['lorem_qty']) )
            $this->qty = $session['lorem_qty'];

        return view('lorem')-> withTitle($this->title)-> withSitetitle($this->siteTitle)-> withQty($this->qty);
    }


    /**
    * Responds to requests to POST /lorem
    */
    public function postLorem(Request $request) {
        $session = session()->all();
        if(isset($session['lorem_qty']) )
            $this->qty = $session['lorem_qty'];

        // validate quantity
        $this->validate($request, ['qty' => 'required|numeric|min:1|max:99'
        ]);

        $request->flash();
        $qty = $request->input('qty');
        // Store a piece of data in the session...
        session(['lorem_qty' => $qty]);
        $paragraphs = '';
        $content = '';
        
        // generator choice
        switch ($request->input('generator')) {
            case 'faker' :
                $faker = Faker::create();
                $paragraphs = $faker->paragraphs($qty);
                break;
            case 'elvish' :
                $generator = new ElvishGenerator();
                $paragraphs = $generator->getParagraphs($qty);
                break;
            default :
                $generator = new Badcow\Generator();
                $paragraphs = $generator->getParagraphs($qty);
        }

        // output choice
        switch ($request->input('format')) {
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
        
        return view('lorem')-> withTitle($this->title)-> withContent($content)-> withSitetitle($this->siteTitle)-> withQty($this->qty);
    }
}

