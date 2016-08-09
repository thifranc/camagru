(function() {

function merge_images() {

		var formData = new FormData();
		formData.append('type', 'upload');
		formData.append('width', glasses.offsetWidth);
		formData.append('height', glasses.offsetHeight);
		formData.append('top', parseInt(glasses.style.top, 10));
		formData.append('left', parseInt(glasses.style.left, 10));
		var sender = new XMLHttpRequest();
		sender.open("POST", "add.php", true);
		sender.send(formData);
		sender.onload = function () {
			if (sender.status >= 200 && sender.status <= 400)
	{
		//var ret = sender.responseText;
		location.reload();
	}
		}
}

startbutton.addEventListener('click', function(ev){
	merge_images();
	ev.preventDefault();
}, false);
})();
