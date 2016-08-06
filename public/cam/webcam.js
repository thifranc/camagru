(function() {

	var streaming = false,
video        = document.querySelector('#video'),
cover        = document.querySelector('#cover'),
canvas       = document.querySelector('#canvas'),
photo        = document.querySelector('#photo'),
startbutton  = document.querySelector('#startbutton'),
glasses	     = document.getElementById('glasses'),
width = 320,
height = 0;

console.log(glasses.offsetWidth);
console.log(glasses.offsetHeight);
console.log(video.offsetWidth);
console.log(video.offsetHeight);

navigator.getMedia = ( navigator.getUserMedia ||
	navigator.webkitGetUserMedia ||
	navigator.mozGetUserMedia ||
	navigator.msGetUserMedia);

navigator.getMedia(
	{video: true,audio: false},
	function(stream) {
		if (navigator.mozGetUserMedia) {
			video.mozSrcObject = stream;
		} else {
			var vendorURL = window.URL || window.webkitURL;
			video.src = vendorURL.createObjectURL(stream);
		}
		video.play();
	},
	function(err) {
		console.log("An error occured! " + err);
	}
	);

video.addEventListener('canplay', function(ev){
	if (!streaming) {
		height = video.videoHeight / (video.videoWidth/width);
		video.setAttribute('width', width);
		video.setAttribute('height', height);
		canvas.setAttribute('width', width);
		canvas.setAttribute('height', height);
		streaming = true;
	}
}, false);

function takepicture() {
	canvas.width = width;
	canvas.height = height;
	canvas.className = 'hidden';
	canvas.getContext('2d').drawImage(video, 0, 0, width, height);


	canvas.toBlob(function(blob) {
		var formData = new FormData();
		console.log('bonjour');
		formData.append('pictures', blob);
		formData.append('type', 'camera');
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
		var ret = sender.responseText;
		console.log(ret);
	}
		}
	});
}

startbutton.addEventListener('click', function(ev){
	takepicture();
	ev.preventDefault();
}, false);


})();
