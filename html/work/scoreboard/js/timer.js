/*
$( "html" ).click(function() {
	resetTimer();
});
*/

$(document).click(function(e) {
	resetTimer();
});

var totalSeconds = 0;
setInterval(setTime, 1000);

function setTime() {
	++totalSeconds;
	console.clear();
	console.log(totalSeconds);
	if(totalSeconds == 30){
		window.location.href = "/";
	}
}

function resetTimer(){
	totalSeconds = 0;

}
