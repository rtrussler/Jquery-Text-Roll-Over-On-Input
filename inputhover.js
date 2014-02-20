// JAVASCRIPT AND JQUERY FUNCTIONS


// CREATED BY RICHARD TRUSSLER

// USES JQUERY TO GET VALUE OF TEXT INPUT FIELDS AND DISPLAYS THE RESULT IN A HOVERED DIV AT THE MOUSE CO-ORDINATES.
// IS ACTIVATED ON MOUSE OVER TO DISPLAY AND MOUSE OUT TO REMOVE

// DIV ANIMATED IN JQUERY USING FADEIN



$('input').mouseover(function(event) {
    tid =  $(event.target).attr("name");
    
    text = document.getElementsByName(tid)[0].value;
    console.debug(text);
    console.debug('Nodename = ' + tid)
    
// ALTERNATIVE METHOD - GETS THE INPUT ELEMENT BY TAG NAME.... ANYTHING WITHIN THE ELEMENT
// CAN BE CALLED THIS WAY YTO BIND THE JQUERY TO AM ELEMENT TO THE NAME OF THE ELEMENT RATHER
// THAN BY USING THE #ID OR THE .CLASS

	$('input[name='+tid+']').mouseover( function(pos) {
	  mouseX = pos.pageX; 
	  mouseY = pos.pageY;
	  console.debug('mouseX= ' + mouseX + ' mouseY=' + mouseY);
  
  
	  getText(tid, mouseX, mouseY, text);
	  
	$('input').mouseout(function(event) {
			var d = document.getElementById('fulltext' + tid);
			console.debug('Removing Element : fulltext' + tid)
			d.parentNode.removeChild(d);
			console.debug('mouse over active')
			});



    $('input').click(function(dis) {
			var d = document.getElementById('fulltext' + tid);
			console.debug('Removing Element : fulltext' + tid)
			d.parentNode.removeChild(d);
            });	


		
  }); 
});

function getText(name, x, y, text)
{
    //console.debug(x + ',' + y);
	console.debug('get text is running');
    
	var textlen = text.length;
	console.debug (textlen);
	console.debug(x + ',' + y);
	
	if (textlen >= 10)
		{
		var div = document.createElement("div");
		div.id = "fulltext" + name;
		div.className = 'popup';
		div.style.left = x + "px";
		div.style.top = y + "px";
		div.innerHTML = text;		

		$(div)
    	.hide()
    	.appendTo('body')
    	.fadeIn();
		}

}
