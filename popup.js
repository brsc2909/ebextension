$(function(){


	var options = {
	  enableHighAccuracy: true,
	  timeout: 5000,
	  maximumAge: 0
	};

	function success(pos) {
	  var crd = pos.coords;

	  console.log('Your current position is:');
	  console.log('Latitude : ' + crd.latitude);
	  console.log('Longitude: ' + crd.longitude);
	  console.log('More or less ' + crd.accuracy + ' meters.');
	};

	function error(err) {
	  console.warn('ERROR(' + err.code + '): ' + err.message);
	};

	navigator.geolocation.getCurrentPosition(success, error, options);

	



	var $data = $('#events');
	var range = "20";
	var longitude = "-122.4381";
	var latitude = "37.7587"; 

	var authurl = 	"https://www.eventbrite.com/oauth/authorize?response_type=token&client_id=4YCAY3L6RXDGTBDNWR";
    var tkn = 		'6UKFE7S2JJML3IFATR4R';
    var auth_headers = {'Authorization': 'Bearer ' + tkn};
    var url = 		"https://www.eventbriteapi.com/v3/events/search/?location.within="+range+"km&location.latitude=" + latitude + "&location.longitude="+ longitude+ "&token=" + tkn + "&expand=venue";
    //https://www.eventbriteapi.com/v3/events/search/?location.within=20km&location.latitude=37.7587&location.longitude=-122.4381&token=6UKFE7S2JJML3IFATR4R
	$.ajax({

		type: 'GET',
		url: url,
		data: {'sort_by': 'date'},
		dataType: "json",
		headers: auth_headers,

		success: function(data){
			var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			for (var i = 0; i < data.events.length; i++){
				  var evnt = data.events[i];
				  var evname = evnt.name.text;
				  var evdesc = evnt.description.text;
	              var dat = new Date(evnt.start.utc);
	              var date = days[dat.getDay()] + ", " + months[dat.getMonth()] + " " + dat.getDate();
	              var ven1 = evnt.venue.address.address_1;
	              try{
	              	var eventPic;
	              	if(evnt.logo.url == null){
	              		eventPic = "icons/icon128.png";
	              	}else{
	              		eventPic = evnt.logo.url;
	              	}
	              	console.log("the picture is :" + eventPic);
	              }catch(err){
	              	console.log(err);
	              	eventPic = "icons/icon64.png";
	              }
	              if (evnt.venue.address.address_2 !== null){
	                  ven1 = ven1 + " " + evnt.venue.address.address_2;
	              }
	              if (ven1 !== 'TBA'){
	                var enddat = new Date(evnt.end.utc);
	                var ven2 = evnt.venue.address.city + ", " + evnt.venue.address.region;
	                var ven3 = evnt.venue.name;
	                var time = meridian_time(dat) + " - " + meridian_time(enddat);
	                var btn = "<a  href=" + evnt.url + " target='new'style='float: right;'><button class = 'btn btn-warning'>Join</button></a><br />";
				}
			
			//display data in a list item
			$data.append( 
							'<div class="panel panel-primary"><div class = "panel-heading"><b>' +evname +'</b>'+ btn+'</div>' +
								
								'<div class = "panel-body">' +
									'<div class = "eventInfo">' + 	
											date + 	'<br />'+
											ven3 + 	'<br />'+
											ven1 + 	'<br />'+
											ven2 + 	'<br />'+
											time + 
										'</div>'+
										'<div class = "eventPic"><img src='+eventPic+' alt = "no image" style = "width:80px; height:80px;">' + 
											'</div>' +				
									'</div>' +
								'</div>'
								
						);
			}
		}
	});
	meridian_time = function(date){
      var meridian = "am";
      var hours = date.getHours();
      var minutes = date.getMinutes();
      if (hours > 12){
        hours -= 12;
        meridian = "pm"
      }else if (hours == 0){
        hours = 12;
      }
      if (minutes < 10){
        minutes = minutes + "0";
      }
      return hours + ":" + minutes + " " + meridian;
    }

});