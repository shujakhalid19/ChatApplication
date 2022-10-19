var flag=true;
var count = 200;
var defaults = {
  origin: { y: 0.7 }
};

function setMic(){
  $('#conf-inp').val(2);
  //$(".fa-microphone").parent().replaceWith('<span id="recordButton" class="pointer" onclick="iniRecording(this)" style="font-size:24px;"><i class="fa fa-microphone"></i></span>');
  $('.preview_bl').addClass('hide');  
  $('.fa-microphone').removeClass('cl-blue');
  $('.preview_ml').removeClass('hide');
  $('.mic-info').text('Click on the mic to start recording');
}

function iniRecording(el){
  switch(flag){
    case true:
      //alert('asd');
      //$(el).replaceWith('<span id="stopButton" class="pointer" style="font-size:24px;"><i class="fa fa-microphone"></i></span>');
      $('.fa-microphone').addClass('cl-blue');
      $('.mic-info').text('Recording...');
      startRecording();
      flag=false;
      break;

    case false:
      //recording complete
      console.warn('closing initialized');
      stopRecording();
      setMic();
      flag=true;
      break;
  }
}

function set_explode(){
  $('#conf-inp').val(1);
  $('.preview_ml').addClass('hide');  
  $('.preview_bl').html('<div class="col-xs-12 text-muted" style="border-radius:14px;padding:20px 0px 10px 4px;"><span style="font-size:24px;">🎉</span> Send messages with a blast&nbsp;&nbsp;&nbsp;&nbsp;<span class=""onclick="blastOff()">&nbsp;&nbsp;<i class="fa fa-times"></i></span></div>').removeClass('hide');
}

function blastOff(){
  $('#conf-inp').val(0);
  $('.preview_bl').addClass('hide');
  $('.preview_ml').addClass('hide');
  document.getElementById('play').innerHTML='';
	
  wavesurfer.empty();
}

function fire(particleRatio, opts) {
    

  confetti(Object.assign({}, defaults, opts, {
    particleCount: Math.floor(count * particleRatio)
  }));
}

function explode(){
    fire(0.25, {
      spread: 26,
      startVelocity: 55,
    });
    fire(0.2, {
      spread: 60,
    });
    fire(0.35, {
      spread: 100,
      decay: 0.91,
      scalar: 0.8
    });
    fire(0.1, {
      spread: 120,
      startVelocity: 25,
      decay: 0.92,
      scalar: 1.2
    });
    fire(0.1, {
      spread: 120,
      startVelocity: 45,
    });
}
    