//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording
var wavesurfer = WaveSurfer.create({
    container: document.querySelector('#waveform'),
    waveColor: '#D9DCFF',
    progressColor: '#4353FF',
    cursorColor: '#4353FF',
    barWidth: 3,
    barRadius: 3,
    cursorWidth: 1,
    height: 200,
    barGap: 3
  });



// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");
var pauseButton = document.getElementById("pauseButton");
var checkButton=document.getElementById('checkButton');
var submitButton=document.getElementById('submitButton');

var auth = firebase.auth();
    var database = firebase.database();
    //this.storage = firebase.storage();
    // Initiates Firebase auth and listen to auth state changes.
auth.onAuthStateChanged(this.onAuthStateChanged.bind(this));

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
pauseButton.addEventListener("click", pauseRecording);
checkButton.addEventListener("click", checkfunc);

// Show the modal window in last 2 minutes

  function checkfunc(){
	  alert('asd');
  }
  


function startRecording() {
    console.log("recordButton clicked");
    //startCountdown(30);
    /*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/
    
    var constraints = { audio: true, video:false }

 	/*
    	Disable the record button until we get a success or fail from getUserMedia() 
	*/

	//recordButton.classList.add('cl-blue');
	//recordButton.className += "cl-blue";
	//recordButton.id = "stopButton";
	console.warn('from here');

	//recordButton.disabled = true;
	//stopButton.disabled = false;
	//pauseButton.disabled = false

	/*
    	We're using the standard promise based getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/
    

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();


        //update the format 
        
            
		//document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"+'<span id="time-remain"></span>';

		/*  assign to gumStream for later use  */
		gumStream = stream;
		
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);

		/* 
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		
		rec = new Recorder(input,{numChannels:1})

		//start the recording process
		rec.record()
		console.log('going on..');
		console.log("Recording started");

	}).catch(function(err) {
	  	//enable the record button if getUserMedia() fails
		  //err
		  console.warn(err);
      	//recordButton.disabled = false;
    	//stopButton.disabled = true;
    	//pauseButton.disabled = true
	});
}

function pauseRecording(){
	console.log("pauseButton clicked rec.recording=",rec.recording );
	if (rec.recording){
		//pause
		rec.stop();
		pauseButton.innerHTML="Resume";
	}else{
		//resume
		rec.record()
		pauseButton.innerHTML="Pause";

	}
}

function stopRecording() {
    //clearInterval(startCountdown.interval);
	console.log("stopButton clicked",rec.recording);
	
	//disable the stop button, enable the record too allow for new recordings
	//stopButton.disabled = true;
	//recordButton.disabled = false;
	//pauseButton.disabled = true;

	//reset button just in case the recording is stopped while paused
	//pauseButton.innerHTML="Pause";
	
	//tell the recorder to stop the recording
	rec.stop();

	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);
}

function createDownloadLink(blob) {
	$('#recordingsList').html('');
	var url = URL.createObjectURL(blob);
	wavesurfer.loadBlob(blob);
	var bt=document.createElement('button');
	bt.classList.add('btn','btn-md','btn-primary');
	bt.textContent="Play";
	document.getElementById('play').onclick=wavesurfer.playPause.bind(wavesurfer);;
	document.getElementById('play').innerHTML=bt.outerHTML;
	//var bb = new window.Blob([new Uint8Array(evt.target.result)]);
	
	document.getElementById('submit').onclick= function(event){
		var conff=document.getElementById('conf-inp').value;
		if(conff==2){
			uploadAudio(blob,'audiofile');
			//console.log(conff);
		}else{

		}

	};
    
}

function uploadAudio(blob,filename){
	console.warn('filename');
	var messagesRef = this.database.ref('messages');
	messagesRef.off();
	var xhr=new XMLHttpRequest();
	 	  xhr.onload=function(e) {
	 	      if(this.readyState === 4) {
	 	          //console.log("Server returned: "+e.target.responseText);
				   var resp=JSON.parse(e.target.responseText);
				   if(resp.upload){
					   console.warn('File Uploaded');
					   //push message
					   messagesRef.child(localStorage.getItem('prime')).push({
                        name: auth.currentUser.displayName,
                        text: document.getElementById('message').value,
                        d:window.sessionStorage.getItem('device'),
                        imgKey:resp.key,
                        file:resp.file,
						type:filename,
                        timestamp:d.getTime(),          
                      }).then(function(snap) {
                          //Update Chatlist andClear message text field and SEND button state.
                          //console.warn(snap.key);
                          //this.lastMessage = snap.key;
                          this.updateChat(localStorage.getItem('prime'));
                          FriendlyChat.resetMaterialTextfield(this.messageInput);
                          this.toggleButton();

						}.bind(this)).catch(function(error) {
							console.error('Error writing new message to Firebase Database', error);
						});

				   }else{
						console.warn('File Not Uploaded');
				   }
	 	      }
	 	  };
	 	  var fd=new FormData();
	 	  fd.append("audio_data",blob, filename);
		  fd.append("p", localStorage.getItem('prime'));
	 	  xhr.open("POST","requests/chats.php",true);
	 	  xhr.send(fd);
}