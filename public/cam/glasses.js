(function() {
	var		add_glasses		= document.getElementById('add_glasses'),
			display_glasses	= document.getElementById('display_glasses'),
			down			= document.getElementById('down'),
			left			= document.getElementById('left'),
			right			= document.getElementById('right'),
			up				= document.getElementById('up'),
			grow			= document.getElementById('grow'),
			reduce			= document.getElementById('reduce');
			startbutton		= document.getElementById('startbutton');

down.addEventListener('click', function(){
		var topVal = parseInt(glasses.style.top, 10);
		glasses.style.top = (topVal + 3) + "px";
});
up.addEventListener('click', function(){
		var topVal = parseInt(glasses.style.top, 10);
		glasses.style.top = (topVal - 3) + "px";
});
left.addEventListener('click', function(){
		var topVal = parseInt(glasses.style.left, 10);
		glasses.style.left = (topVal - 3) + "px";
});
right.addEventListener('click', function(){
		var topVal = parseInt(glasses.style.left, 10);
		glasses.style.left = (topVal + 3) + "px";
});
grow.addEventListener('click', function(){
		var topVal = parseInt(glasses.style.width, 10);
		glasses.style.width = (topVal + 3) + "px";
});
reduce.addEventListener('click', function(){
		var topVal = parseInt(glasses.style.width, 10);
		glasses.style.width = (topVal - 3) + "px";
});

  add_glasses.addEventListener('click', function(ev){
	var hidden = glasses.className;
	if (!hidden)
	{
		glasses.className = 'hidden';
		display_glasses.className = 'hidden';
		startbutton.className = 'hidden';
	}
	else
	{
		glasses.className = '';
		display_glasses.className = '';
		startbutton.className = '';
	}
  }, false);

})();
