if (document.getElementById("vid1")) {
	videojs("vid1").ready(function() {


		var myPlayer = this;

		//Set initial time to 0
		var currentTime = 0;

		var maxTime=0;

		var video_id = $('#video_id').val();
		var resume_duration=$('#time').val();
		var next =parseInt(video_id)+parseInt(1);


		maxTime=Math.floor(resume_duration)
		myPlayer.currentTime(maxTime);

//		console.log(resume_duration);

		//This example allows users to seek backwards but not forwards.
		//To disable all seeking replace the if statements from the next
		//two functions with myPlayer.currentTime(currentTime);

		myPlayer.on("seeking", function(event) {
			if (currentTime < myPlayer.currentTime()) {
				//console.log('current '+currentTime);
				//console.log('max '+maxTime);
				if(currentTime == maxTime || !(myPlayer.currentTime() < maxTime)){
					myPlayer.currentTime(maxTime);
				}


			}
		});

		myPlayer.on("seeked", function(event) {
			if (currentTime < myPlayer.currentTime()) {

				if(currentTime == maxTime){
					console.log('seeked');
					myPlayer.currentTime(currentTime);
				}

			}
		});

		myPlayer.on("ended",function(event){

			$.ajax({ //line 28
				url: 'https://ecertifyeducation.com/updatevideodata',
				type: 'POST',
				data: { video_id: video_id, task: 'videodata' },
				success: function()
				{
					if(video_id==12){
						window.location.href = "https://ecertifyeducation.com/dashboard/";
						//console.log('success');
					}
					else{
						window.location.href = "https://ecertifyeducation.com/dashboard/video/"+next;

						//console.log('success');
					}
					//window.location.href = "http://localhost:8000/dashboard/video/"+next;
				},
				error: function(){
					if(video_id==12){
						window.location.href = "https://ecertifyeducation.com/dashboard/";
						//console.log('succDddd');
					}
					else{
						window.location.href = "https://ecertifyeducation.com/dashboard/video/"+next;
						//console.log('successzsfsf');
					}
				}
			});
		});


		setInterval(function() {
			if (!myPlayer.paused()) {
				currentTime = myPlayer.currentTime();

				$.ajax({ //line 28
					url: 'https://ecertifyeducation.com/updatevideodata',
					type: 'POST',
					data: { video_id: video_id ,time: currentTime ,task: 'time'},
					success: function()
					{	
							//window.location.href = "http://104.236.225.35/dashboard/";
					//		console.log('success');
							//window.location.href = "http://104.236.225.35/dashboard/video/"+next;


					},
					error: function(){
					//	console.log('error');
					}
				});


				if(maxTime<=currentTime){
					maxTime= currentTime;
				}
				var rand = Math.floor((Math.random() * 100) + 1);
//				console.log(Math.round(myPlayer.duration()));

				var totalduration=myPlayer.duration();
				var interval = Math.floor(totalduration)/4;
				var x = Math.floor((Math.random() * 999999) + 111111);


				if(totalduration%2!=0){

					totalduration = totalduration +1;
					//console.log(interval +'interval');
				}
				//console.log("total duration="+totalduration);
				//console.log("current time="+ myPlayer.currentTime());

				var interval1= totalduration/4;
				var interval2=totalduration/3;
				var interval3=totalduration/2;
				//console.log(myPlayer.currentTime()+interval+"+sdfdf");

				var t1=16.449633;
						var t2=39.629615;
								var t3=53.631474;

				var x = Math.floor((Math.random() * 10) + 1);

				var y = Math.floor((Math.random() * Math.floor(myPlayer.duration())) + 1);
				var z = Math.floor((Math.random() * 10) + 1);


				if(Math.round(myPlayer.currentTime()) == x || y==x || y==x+z){

					myPlayer.pause();
					myPlayer.exitFullscreen();
//					console.log(Math.floor(currentTime));
//					console.log('choot');




					$(document).ready(function(){
						//$.colorbox({html:"<h1>Some Random Text</h1>"});

						$('#videomodal').modal('show');


					});

					$('#videomodal').on('hidden.bs.modal', function (e) {
						myPlayer.play();
					})




				}







			}

		}, 1000);

	});





}


if (document.getElementById("watched")) {
	videojs("watched").ready(function() {


		var myPlayer = this;

		//Set initial time to 0
		var currentTime = 0;

		var maxTime=0;

		var video_id = $('#video_id').val();
		var next =parseInt(video_id)+parseInt(1);

		/*
		this.currentTime(getCookie("resume_duration"+video_id));
		console.log(document.URL);

		*/



		//This example allows users to seek backwards but not forwards.
		//To disable all seeking replace the if statements from the next
		//two functions with myPlayer.currentTime(currentTime);




		myPlayer.on("ended",function(event){

			$.ajax({ //line 28
				url: 'https://ecertifyeducation.com/updatevideodata',
				type: 'POST',
				data: { video_id: video_id },
				success: function()
				{
					if(video_id==12){
						window.location.href = "https://ecertifyeducation.com/dashboard/";
					}
					else{
						window.location.href = "https://ecertifyeducation.com/dashboard/video/"+next;
					}
					//window.location.href = "http://localhost:8000/dashboard/video/"+next;
				},
				error: function(){
					if(video_id==12){
						window.location.href = "https://ecertifyeducation.com/dashboard/";
					}
					else{
						window.location.href = "https://ecertifyeducation.com/dashboard/video/"+next;
					}
				}
			});
		});




		setInterval(function() {
			if (!myPlayer.paused()) {
				currentTime = myPlayer.currentTime();

				/*
				setCookie(myPlayer.currentTime());
				console.log("cokie_"+video_id+"="+getCookie("resume_duration"+video_id));

				*/





				if(maxTime<=currentTime){
					maxTime= currentTime;
				}
				var rand = Math.floor((Math.random() * 100) + 1);
				//console.log(Math.round(myPlayer.duration()));

				var totalduration=Math.round(myPlayer.duration());
				var interval = Math.round(totalduration/4);

				if(totalduration%2!=0){

					totalduration = totalduration +1;
					//console.log(interval +'interval');
				}

				var interval1= totalduration/4;
				var interval2= totalduration/3;
				var interval3=totalduration/2;

				if( currentTime==interval1 ||  Math.round(currentTime)==interval2 ||  Math.floor(currentTime)==interval3 ){

//					myPlayer.pause();
				//	console.log(Math.floor(currentTime));
				//	console.log('choot');







				}







			}

		}, 1000);

	});





}

function setCookie(cvalue) {

	var video_id = $('#video_id').val();
	document.cookie = "resume_duration" + video_id + "=" + cvalue;
}

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}