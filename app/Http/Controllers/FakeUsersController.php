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
        , 'format' => array('default' => 'json'
            , 'in' => array('json','csv','tab','plain') )
        , 'incName' => array('default' => 'full'
            , 'in' => array('full', 'component', 'both') )
        , 'incTitle' => array('default' => 'some'
            , 'in' => array('some', 'yes', 'no') )
        , 'incSuffix' => array('default' => 'some'
            , 'in' => array('some', 'yes', 'no') )
        , 'incOptions' => array('all', 'address', 'phoneNumber', 'dob', 'email', 'userName', 'url', 'creditCard', 'uuid', 'bio')
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

        // delete input values if reset button clicked
        if($request->has('reset') ) {
            $request->replace(array() );
        }

        $qty = $request->input('quantity');
        $fusers = array();
        $content = '';
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

            $name = array('name' => $this->includeName($request->input('includeName'), $name) );
            if ($request->has('includeOptions') ) {
                $name = array_merge($name, $this->includeOptions($faker, $request->input('includeOptions') ) );
            }
            array_push($fusers, $name);
        }

        // output choice
        switch ($request->input('format')) {
            // comma separated values wrapped in parens ()
            case 'csv' :
                foreach ($fusers as $fuser) {
                    $content .= $this->userToCSV($fuser, true);
                }
                break;
             case 'tab' :
                foreach ($fusers as $fuser) {
                    $content .= $this->userToTab($fuser, true);
                }
                break;
            case 'plain' :
                foreach ($fusers as $fuser) {
                    $content .= $this->userToPlain($fuser, true);
                }
                break;
            default :
                $content = json_encode($fusers);
        }

        // if ALL is checked, check all the other boxes
        if($request->has('includeOptions') && in_array('all', $request->input('includeOptions') ) ) {
            $inputs = $request->all();
            $inputs['includeOptions'] = $this->fakeuser['incOptions'];
            $request->replace($inputs);
        }

        // store input in session
        $request->flash();

        return view('fakeusers')-> withTitle($this->title)-> withContent($content)-> withSitetitle($this->siteTitle);
    }

    /**
    * Return full name, name in components, or both
    *
    * @param String $incName
    * @param Array $name
    *
    * @return Array
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

        return $arrName;
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
    * Return suffix for name, or not
    *
    * @param Object $faker
    * @param Array  $name
    * @param Array  $incOptions
    *
    * @return Array
    */
    private function includeOptions($faker, $incOptions) {
        $details = array();

        foreach($incOptions as $option) {
            $all = false;
            switch ($option) {
                // include all options, prevent cases from breaking
                case 'all' :
                    $all = true;
                case 'address' : 
                    $addr = array('streetAddress' => $faker->streetAddress);
                    $addr['secondaryAddress'] = $faker->optional()->secondaryAddress;
                    $addr['city'] = $faker->city;
                    $addr['stateAbbr'] = $faker->stateAbbr;
                    $addr['postcode'] = $faker->postcode;
                    $addr['country'] = $faker->optional()->country;

                    $details['address'] = $addr;
                    if(!$all)
                        break;
                case 'phoneNumber' : 
                    $details['phoneNumber'] = $faker->phoneNumber;
                    if(!$all)
                        break;
                case 'dob' : 
                    $details['dob'] = $faker->date('m/d/Y', '-18 years');
                    if(!$all)
                        break;
                case 'email' :
                    $details['email'] = $faker->safeEmail;
                    if(!$all)
                        break;
                case 'userName' : 
                    $details['userName'] = $faker->userName;
                    if(!$all)
                        break;
                case 'url' : 
                    $details['url'] = $faker->url;
                    if(!$all)
                        break;
                case 'creditCard' : 
                    $details['creditCard'] = array('cc' => $faker->creditCardDetails);
                    if(!$all)
                        break;
                case 'uuid' : 
                    $details['uuid'] = $faker->uuid;
                    if(!$all)
                        break;
                case 'bio' :
                    $details['bio'] = $faker->text('200');
                    if(!$all)
                        break;
                default :
            }
            // stop foreach, all options added
            if($all)
                break;

        }
        
        return $details;
    }


    /**
    * Validate input
    *
    * @param Request $req
    */
    private function validateFakeUsers($req) {
        $this->validate($req, [
          'quantity'  => 'required|integer|'. $this->implodeKeyValue($this->fakeuser['qty']['range'])
        , 'format'   => 'required|in:'. implode(',', $this->fakeuser['format']['in'])
        , 'includeName'   => 'required|in:'. implode(',', $this->fakeuser['incName']['in'])
        , 'includeTitle'  => 'required|in:'. implode(',', $this->fakeuser['incTitle']['in'])
        , 'includeSuffix' => 'required|in:'. implode(',', $this->fakeuser['incSuffix']['in'])
        , 'includeOptions' => 'array'
        ]);
    }


    /**
    * Convert a user array to CSV formatted string
    *
    * @param Array   $data
    * @param Boolean $outermost
    *
    * @return String
    */
    private function userToCSV($data, $outermost) {
        $row = array();
        foreach($data as $key => $value) {
            if(is_array($value) ) {
                // recursively call function
                array_push($row, $this->userToCSV($value, false) );
            }
            else {
                // add string to array
                array_push($row, $value);
            }
        }
        // array inside array
        if (!$outermost) {
            return implode('", "', $row);
        }
        else {
            return '"'. implode('", "', $row) .'"' ."\n";
        }
    }


    /**
    * Convert a user array to tab-delimited string
    *
    * @param Array   $data
    * @param Boolean $outermost
    *
    * @return String
    */
    private function userToTab($data, $outermost) {
        $row = array();
        foreach($data as $key => $value) {
            if(is_array($value) ) {
                // recursively call function
                array_push($row, $this->userToTab($value, false) );
            }
            else {
                // add string to array
                array_push($row, $value);
            }
        }
        // array inside array
        if (!$outermost) {
            return implode("\t", $row);
        }
        else {
            return implode("\t", $row) ."\n";
        }
    }


    /**
    * Convert a user array to space-delimited string
    *
    * @param Array   $data
    * @param Boolean $outermost
    *
    * @return String
    */
    private function userToPlain($data, $outermost) {
        $row = array();
        foreach($data as $key => $value) {
            if(is_array($value) ) {
                // recursively call function
                array_push($row, $this->userToPlain($value, false) );
            }
            else {
                // add string to array
                array_push($row, $value);
            }
        }
        // array inside array
        if (!$outermost) {
            return implode(" ", $row);
        }
        else {
            return implode(" ", $row) ."\n";
        }
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
