(function() {

  var streaming = false,
      video        = document.getElementById('video'),
      canvas       = document.getElementById('canvas'),
      photo    	   = document.getElementById('photo'),
      startbutton  = document.getElementById('startbutton'),
      glasses      = document.getElementById('glasses'),
      add_glasses  = document.getElementById('add_glasses'),
      width = 320,
      height = 0;

  navigator.getMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;

if (navigator.getMedia)
{
 	 navigator.getMedia(
    {video: true,audio: false},

    function(stream) {
	if (navigator.mozGetUserMedia)
        video.mozSrcObject = stream;
	else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },

    function(err) {
      console.log("An error occured! " + err);
	}
	);
}

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

  add_glasses.addEventListener('click', function(ev){
	var lol=glasses.className;
	console.log(lol);
	if (!lol)
		glasses.className='hidden';
	else
		glasses.className='';
  }, false);

  var canvas = document.getElementById('canvas');
  var rect = canvas.getBoundingClientRect();
  console.log(rect.top, rect.bottom, rect.right, rect.left);
  var glasses = document.getElementById('glasses');


  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
	var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

})();
