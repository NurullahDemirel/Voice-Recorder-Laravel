<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Simple Recorder.js demo with record, stop and pause - addpipe.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div id="controls">
    <button id="recordButton">Record</button>
    <button id="pauseButton" disabled>Pause</button>
    <button id="stopButton" disabled>Stop</button>
</div>
<div id="formats">Format: start recording to see sample rate</div>
<p><strong>Recordings:</strong></p>
<button type="submit">Yükle</button>
<ol id="recordingsList">
    <li id="record">

    </li>
</ol>
<!-- inserting these scripts at the end to be able to use all the elements in the DOM -->
<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{--<script src="{{asset('js/voice.js')}}"></script>--}}


<script>
    //webkitURL is deprecated but nevertheless
    URL = window.URL || window.webkitURL;

    var gumStream; 						//stream from getUserMedia()
    var rec; 							//Recorder.js object
    var input; 							//MediaStreamAudioSourceNode we'll be recording

    // shim for AudioContext when it's not avb.
    var AudioContext = window.AudioContext || window.webkitAudioContext;
    var audioContext //audio context to help us record

    var recordButton = document.getElementById("recordButton");
    var stopButton = document.getElementById("stopButton");
    var pauseButton = document.getElementById("pauseButton");
    var li =document.querySelector('ol#recordingsList li#record');

    //add events to those 2 buttons
    recordButton.addEventListener("click", startRecording);
    stopButton.addEventListener("click", stopRecording);
    pauseButton.addEventListener("click", pauseRecording);

    function startRecording() {
        console.log("recordButton clicked");

       if (li.children.length ===0){
           var constraints = { audio: true, video:false }

           recordButton.disabled = true;
           stopButton.disabled = false;
           pauseButton.disabled = false


           navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
               console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

               audioContext = new AudioContext();

               //update the format
               document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

               gumStream = stream;

               input = audioContext.createMediaStreamSource(stream);

               rec = new Recorder(input,{numChannels:1})
               rec.record()

               console.log("Recording started");

           }).catch(function(err) {
               recordButton.disabled = false;
               stopButton.disabled = true;
               pauseButton.disabled = true
           });
       }
       else {
           alert('Lütfen yeni kayıt oluşturmadan eski kaydı silin');
       }
    }

    function pauseRecording(){
        console.log("pauseButton clicked rec.recording=",rec.recording );
        if (rec.recording){
            rec.stop();
            pauseButton.innerHTML="Resume";
        }else{
            rec.record()
            pauseButton.innerHTML="Pause";

        }
    }

    function stopRecording() {
        console.log("stopButton clicked");

        stopButton.disabled = true;
        recordButton.disabled = false;
        pauseButton.disabled = true;

        pauseButton.innerHTML="Pause";

        rec.stop();

        gumStream.getAudioTracks()[0].stop();

        rec.exportWAV(createDownloadLink);
    }

    function createDownloadLink(blob) {

        var url = URL.createObjectURL(blob);
        var au = document.createElement('audio');
        var li =document.querySelector('ol#recordingsList li#record');
        var link = document.createElement('a');

        //name of .wav file to use during upload and download (without extendion)
        var filename = new Date().toISOString();

        //add controls to the <audio> element
        au.controls = true;
        au.src = url;

        //save to disk link
        link.href = url;
        link.download = filename+".wav"; //download forces the browser to donwload the file using the  filename
        link.innerHTML = "Save to disk";

        //add the new audio element to li
        li.innerHTML='';
        li.appendChild(au);

        //add the filename to the li
        li.appendChild(document.createTextNode(filename+".wav "))

        //add the save to disk link to li
        li.appendChild(link);

        li.appendChild(document.createTextNode (" "))//add a space in between

        var deleteButton = document.createElement('a');
        deleteButton.href="#";
        deleteButton.innerHTML = "Delete";
        deleteButton.onclick=function (){
            li.innerHTML='';
        }
        li.appendChild(deleteButton);

        //upload link
        var upload = document.createElement('a');
        upload.href="#";
        upload.innerHTML = "Upload";
        upload.addEventListener("click", function(event){
            var xhr=new XMLHttpRequest();
            xhr.onload=function(e) {
                if(this.readyState === 4) {
                    console.log("Server returned: ",e.target.responseText);
                }
            };
            var fd=new FormData();
            fd.append("audio_data",blob, filename);
            fd.append("_token","{{csrf_token()}}");
            xhr.open("POST","{{route('upload.voice')}}",true);
            xhr.send(fd);
        })
        li.appendChild(document.createTextNode (" "))//add a space in between
        li.appendChild(upload)//add the upload link to li

        recordingsList.appendChild(li);
    }


</script>

</body>
</html>
