<?php

namespace Dwa15p3\Http\Controllers;

use Illuminate\Http\Request;
use Dwa15p3\Http\Requests;
use Dwa15p3\Http\Controllers\Controller;
use Faker\Factory as Faker;

class FakeUsersController extends Controller
{
    private $title = 'Fake Users';

    private $fakeuser = array( 'qty' => array('default' => 6
            , 'range' => array('min' => 1, 'max' => 99) )
        , 'incName' => array('default' => 'full'
            , 'in' => array('full', 'component', 'both') )
        , 'incTitle' => array('default' => 'some'
            , 'in' => array('some', 'yes', 'no') )
        , 'incSuffix' => array('default' => 'some'
            , 'in' => array('some', 'yes', 'no') )
        );

    /**
    * Responds to requests to GET /fakeusers
    */
    public function getFakeUsers() {
        // store attributes in session
        session()->put('fakeuser', $this->fakeuser);
        return view('fakeusers')-> withTitle($this->title)-> withFusers(array() )-> withSitetitle($this->siteTitle);
    }

    /**
    * Responds to requests to POST /lorem
    */
    public function postFakeUsers(Request $request) {
        $this->validateFakeUsers($request);
        // store input in session
        $request->flash();
        $qty = $request->input('quantity');
        $fusers = array();

        for($i=0; $i < $qty; $i++) {
            $name = array();
            // include title, or not
            $incTitle = $this->includeTitle($request->input('includeTitle') );
            if ($incTitle)
                array_push($name, $incTitle);

            $faker = Faker::create();
            array_push($name, $faker->firstName);
            array_push($name, $faker->lastName);

            // include suffix, or not
            $incSuffix = $this->includeSuffix($request->input('includeSuffix') );
            if ($incSuffix)
                array_push($name, $incSuffix);

            array_push($fusers,  $this->includeName($request->input('includeName'), $name) );
        }

        return view('fakeusers')-> withTitle($this->title)-> withFusers($fusers)-> withSitetitle($this->siteTitle);
    }

    /**
    * Return full name, name in components, or both
    *
    * @param String $incName
    * @param Array $name
    *
    * @return String
    */
    private function includeName($incName, $name) {
        $arrName = array();
        switch ($incName) {
            case 'full' :
                array_push($arrName, implode(' ', $name) );
                break;
            case 'component' :
                $arrName = $name;
                break;
            default :
                array_unshift($name, implode(' ', $name) );
                $arrName = $name;
        }

        return implode(', ', $arrName);
    }

    /**
    * Return title for name, or not
    *
    * @param String $incTitle
    *
    * @return String
    */
    private function includeTitle($incTitle) {
        switch ($incTitle) {
            case 'yes' :
                return Faker::create()->title;
            case 'no' :
                return null;
            default :
                if (rand(0,1) ) {
                    return Faker::create()->title;
                }
                else {
                    return null;
                }
        }
    }

    /**
    * Return suffix for name, or not
    *
    * @param String $incSuffix
    *
    * @return String
    */
    private function includeSuffix($incSuffix) {
        switch ($incSuffix) {
            case 'yes' :
                return Faker::create()->suffix;
            case 'no' :
                return null;
            default :
                if (rand(0,1) ) {
                    return Faker::create()->suffix;
                }
                else {
                    return null;
                }
        }
    }

    /**
    * Validate input
    *
    * @param Request $req
    */
    private function validateFakeUsers($req) {
        $this->validate($req, [
          'quantity'  => 'required|integer|'. $this->implodeKeyValue($this->fakeuser['qty']['range'])
        , 'includeName'   => 'required|in:'. implode(',', $this->fakeuser['incName']['in'])
        , 'includeTitle'  => 'required|in:'. implode(',', $this->fakeuser['incTitle']['in'])
        , 'includeSuffix' => 'required|in:'. implode(',', $this->fakeuser['incSuffix']['in'])
        ]);
    }

    /**
    * Implode both key and value
    *
    * @param Array $input
    *
    * @return String
    */
    private function implodeKeyValue($input) {
        return implode('|', array_map(function ($v, $k) { return $k . ':' . $v; }, $input, array_keys($input)));
    }
}
