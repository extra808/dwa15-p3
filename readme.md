## P3: Developer's Best Friend

## Live URL
<http://p3.dwa15.cognize.org>

## Description
A site to generate paragraphs of random text and random user account details for use in application development.

## Demo

## Details for teaching team
* All input is validated server-side. includeOptions is only checked to confirm it's an array. However, includeOptions array elements are checked by a `switch()` statement and if an element doesn't match a case, it does nothing.

## Outside code
* [Badcow/lorem-ipsum](https://packagist.org/packages/badcow/lorem-ipsum)
* [Elvish words](https://github.com/stevenmaguire/elvish-ipsum/blob/master/src/Provider.php)
* [implode key and value](http://stackoverflow.com/questions/11427398/php-how-to-implode-array-with-key-and-value-without-foreach)
*[PHP – Wrap Implode Array Elements in Quotes](http://melikedev.com/2010/02/24/php-wrap-implode-array-elements-in-quotes/)