var music = document.getElementById('track'); // id for audio element
var pButton = document.getElementById('pButton'); // play button
var playhead = document.getElementById('playhead'); // playhead
var timeline = document.getElementById('timeline'); // timeline
var myVolumeBar = document.getElementById("voldivhead");

timeline.addEventListener("click", function(event) {
    music.currentTime = music.duration * clickPercent(event);
    music.play();
    document.getElementById('playicon').className="glyphicon glyphicon-pause";
});

function clickPercent(event) {
    return ((event.clientX-(timeline.offsetWidth/2))/timeline.offsetWidth);
}

function muteVolume(){
    if(!music.muted){
        music.muted=true;
        document.getElementById('volplusButton').className="glyphicon glyphicon-volume-off";
    }
    else{
        music.muted=false;    
        document.getElementById('volplusButton').className="glyphicon glyphicon-volume-up";
    }
}


function incVolume(){
    if(music.volume<1){
        music.volume+=0.1;
        myVolumeBar.style.width=(100*music.volume)+"%";
    }
}


function decVolume(){
    if(music.volume>0){
        music.volume-=0.1;
        myVolumeBar.style.width=(100*music.volume)+"%";
    }
}


function backTrack(){
    music.currentTime=0;
}

function timeUpdate(event) {
        var playPercent= 100*(music.currentTime/music.duration);
        playhead.style.width =playPercent+"%";
}

function play() {
    if (music.paused) {
        music.play();
        document.getElementById('playicon').className="glyphicon glyphicon-pause";
    } else { 
        music.pause();
        document.getElementById('playicon').className="glyphicon glyphicon-play";
    }
}

music.onended = function() {
    nextTrack();
};
