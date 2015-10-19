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

    private $lorem = array( 'qty' => array('default' => 3
            , 'range' => array('min' => 1, 'max' => 99) )
        , 'generator' => array('default' => 'badcow'
            , 'in' => array('badcow','elvish','faker') )
        , 'format' => array('default' => 'plain'
            , 'in' => array('plain','php','html','json') )
        );

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

        $this->validateLorem($request);

        $request->flash();
        $qty = $request->input('Quantity');
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

    /**
    * Validate input
    */
    private function validateLorem($req) {
        $this->validate($req, [
          'quantity'       => 'required|integer|'. $this->implodeKeyValue($this->lorem['qty']['range'])
        , 'generator' => 'required|in:'. implode(',', $this->lorem['generator']['in'])
        , 'format'    => 'required|in:'. implode(',', $this->lorem['format']['in'])
        ]);
    }

    /**
    * Implode both key and value
    */
    private function implodeKeyValue($input) {
        return implode('|', array_map(function ($v, $k) { return $k . ':' . $v; }, $input, array_keys($input)));
    }
}

