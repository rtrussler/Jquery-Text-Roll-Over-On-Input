READ ME!!!!

My Problem: Some iNput fields on a page where too small to display their entire contents

Solution:

Simple effect to take input value of the elements on a page and display a jQuery div
containing the full string of text within the input element. Uses onMouseOver and onMouseOut
to show/hide the hover div. Also added a jquery fadein effect.

The on MouseOver action gets the current mouse co-ordinates from the screen as x and y and
set the top left position of the div to match these.

can easily be modified to get any element... doesnt have to be inputs; could be spans, 
headings - just about anything really!

MODIFICATION 20-2-14 ————

ADDED THE JQUERY TO GET THE ELEMENT BY NAME RATHER THAN BY CLASS AS FOLLOWS

$(‘input[name=<name here>]’)…..

I PASSED THE VARIABLE IN AS FOLLOWS:
$(‘input[name’ + varname + ’]’)…..