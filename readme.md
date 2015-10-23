## P3: Developer's Best Friend

## Live URL
<http://p3.dwa15.cognize.org>

## Description
A site to generate paragraphs of random text and random user account details for use in application development. The user can choose different output formats such as JSON and CSV. Random text options include two different "lorem ipsum" generators and Elvish. Random users can have names formatted in different ways and accompanied by many other bits of data.

## Demo
<https://youtu.be/F4zqdWSPGZ4>

## Details for teaching team
* I couldn't get the Elvish package to work so I just copied its word array and made my own class that extends badcow/lorem-ipsum and overloads the $words variable. I put it in the Controllers directory and called it ElvishGenerator, I'm not sure that's the best practice.
* All input is validated server-side. includeOptions is only checked to confirm it's an array. However, includeOptions array elements are checked by a `switch()` statement and if an element doesn't match a case, it does nothing.
*The forms "remember" your input from your previous submission so you don't have to keep re-choosing the options you want.
* I used Bootstrap button groups to style the radio buttons and checkboxes to look like buttons. Their button states are also "remembered" after submission.
* In the fake user additional options, if "ALL" is selected, after submission, all the buttons in that section are selected to show their content is included.
* The Bootstrap-styled radio buttons have default values but don't show them until the form is submitted once, I didn't have time to figure out the code to do that.
* Sorry it's not pretty.

## Outside code
* [Badcow/lorem-ipsum](https://packagist.org/packages/badcow/lorem-ipsum)
* [Elvish words](https://github.com/stevenmaguire/elvish-ipsum/blob/master/src/Provider.php)
* [implode key and value](http://stackoverflow.com/questions/11427398/php-how-to-implode-array-with-key-and-value-without-foreach)
*[PHP – Wrap Implode Array Elements in Quotes](http://melikedev.com/2010/02/24/php-wrap-implode-array-elements-in-quotes/)