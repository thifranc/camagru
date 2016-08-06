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
		console.log(glasses.style.top);
});
up.addEventListener('click', function(){
		var topVal = parseInt(glasses.style.top, 10);
		glasses.style.top = (topVal - 3) + "px";
		console.log(glasses.style.top);
});
left.addEventListener('click', function(){
		var topVal = parseInt(glasses.style.left, 10);
		glasses.style.left = (topVal - 3) + "px";
		console.log(glasses.style.left);
});
right.addEventListener('click', function(){
		var topVal = parseInt(glasses.style.left, 10);
		glasses.style.left = (topVal + 3) + "px";
		console.log(glasses.style.left);
});
grow.addEventListener('click', function(){
		var topVal = parseInt(glasses.style.width, 10);
		glasses.style.width = (topVal + 3) + "px";
		console.log(glasses.style.width);
		console.log(glasses.offsetWidth);
});
reduce.addEventListener('click', function(){
		var topVal = parseInt(glasses.style.width, 10);
		glasses.style.width = (topVal - 3) + "px";
		console.log(glasses.style.width);
});

  add_glasses.addEventListener('click', function(ev){
	var hidden = glasses.className;
	console.log(hidden);
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
