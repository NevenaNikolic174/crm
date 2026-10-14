


jQuery(document).ready(function() {
	populateUnreadBadgeFinance();
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}

	});
	countNoReadNotification();
	window.setInterval(function(){
		countNoReadNotification();		
	}, 300000);
	notificationHead(1);
	$("#loadmorenotification").click(function(){
		notificationHead(1);
		$("#loadmorenotification").blur();
	});

	$(document).on("click", "#markRead", function(){
		$.ajax({
			type: 'POST',
			url: '/markallnotifications',
			async: true,
			data: {
				markRead: true
			},
			beforeSend: function(){
            	mApp.block("#topbar_notifications_notifications");
        	},
        	success: function(response){
				countNoReadNotification();
				$("#headnotificationlist").html("");
				notificationHead(0);

				$('.markAllNotification').prop('checked', false);
				$("#markalllink_read").show();
				$("#markalllink_unread").hide();
			}
		});
	});

	$(document).on("click", "#markUnread", function(){
		$.ajax({
			type: 'POST',
			url: '/markallnotifications',
			async: true,
			data: {
				markUnread: true
			},
			beforeSend: function(){
            	mApp.block("#topbar_notifications_notifications");
        	},
        	success: function(response){
				countNoReadNotification();
				$("#headnotificationlist").html("");
				notificationHead(0);

				$('.markAllNotification').prop('checked', false);
				$("#markalllink_read").show();
				$("#markalllink_unread").hide();
			}
		});
	});

	$(document).on('click', '.notificationwordbreak a', function(){
	  	let id = $(this).parents('span').data('id');
	  	markNotificationRead(id);
	}); 

	$(document).on("click", ".read_unread", function(){
		var id = $(this).data("id");
		var status = $(this).is(":checked");

		/* Oznaci kao procitano */	
		if(status){
			if(markNotificationRead(id)){
				$("#m-checkbox-"+ id).attr('title', 'Obeleži kao nepročitano');
				$("#notification_" + id).removeClass('unreadnotificationlist');
				countNoReadNotification();
				// notificationHead(0);
			}
		} else { 
			/* Oznaci kao neprocitano */	
			if(markNotificationUnread(id)){
				$("#m-checkbox-"+ id).attr('title', 'Obeleži kao pročitano');
				$("#notification_" + id).addClass('unreadnotificationlist');
				countNoReadNotification();	
				// notificationHead(0);
			}
		}
	});

	$("#m_topbar_notification_icon").click(function(){
		$("#headnotificationlist").html("");
		notificationHead(0);
	});
	populateNewRokBadge(loadNewTsk());
	populateunreadtskBadge(loadunreadtsk());
	// populateunreadwtime(loadunreadwt());
	populateunreadcase(loadunreadcase());
	
	$("#feedback-banner").click(function(){
		$("#feedback-modal").modal();
	});

	$("#videoUputstva").click(function(){
		$("#videoModal").modal();
	});

	$("#clikchangeuserrole").click(function(){
		$("#changeUserRole").modal();
	});

	//feedbackForm
	$("#feedbackForm").validate({
		ignore: ":hidden",
		rules: {
			"feedbackText": {
				required: true
			}
		},
		messages: {
			"feedbackText": {
				required: 'Obavezno polje'
			}
		},
		invalidHandler: function (event, validator) { var errors = validator.numberOfInvalids();if (errors) { validator.errorList[0].element.focus(); }
			mApp.scrollTop();
			swal({
				"title": "",
				"text": "Imate greške na formularu. Molimo Vas ispravite greške i nastavite",
				"type": "error",
				"confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
			});
		}	
	});

});


function countNoReadNotification() {

	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: '/countNoReadNotification',
		data: {

		}
	}).done(function (response) {
		if (response === 0){
			$("#noreadnotificationcount").hide();
			$(".zvonce").addClass('notransition');
			$("#noreadnotificationcount").html("0");
			$("#markalllink_read").hide();
			$("#markalllink_unread").show();
		}
		else {
			$(".zvonce").addClass('notransition');
			$(".zvonce").next("span").addClass('notransition');
			var old = $("#noreadnotificationcount").html();
			$("#markalllink_read").show();
			$("#markalllink_unread").hide();
			// alert(old);
			// console.log(old);
			// if (old == ''){
			// 	old = 0;
			// }
			if (parseInt(old) < response){
				var lastNotification = getLastNotification();
				showNotificationToast(lastNotification);
			}
			else {

			}
			$("#noreadnotificationcount").show();
			$("#noreadnotificationcount").html(response);
		}
	});
}

function notificationHead(append){
	var offset = $('.headnotification').length;
	var limit = 30;

	return $.ajax({
		type: 'POST',
		dataType: 'json',
		url: '/getHeadNotificationRequest',
		data: {
			offset: offset,
			limit: limit
		}
	}).done(function (response) {
		mApp.unblock("#topbar_notifications_notifications");
		if (response.length < 1){
			$("#loadmorenotification").hide();
			$("#markalllink_read").hide();
			$("#markalllink_unread").hide();
		}
		else {
			$("#loadmorenotification").show();
		}

		$.each( response, function( key, value ) {
			if (append === 1){
				$("#headnotificationlist").append(value);
			}
			else {

				$("#headnotificationlist").append(value);
			}
		  
		});
	});
}

function getLastNotification(){
	return $.ajax({
		type: 'POST',
		dataType: 'json',
		url: '/getLastNotification',
		async: false,
	}).done(function (response) {
		// console.log(response.textSrbLat);
		return response.textSrbLat;
	});
}

function markNotificationRead(id){
	return $.ajax({
		type: 'POST',
		dataType: 'json',
		url: '/markNotificationRead',
		async: false,
		data: {
			notificationid: id
		}
	}).done(function (response) {
		return true;
	});
}

function markNotificationUnread(id){
	return $.ajax({
		type: 'POST',
		dataType: 'json',
		url: '/markNotificationUnread',
		async: false,
		data: {
			notificationid: id
		}
	}).done(function (response) {
		return true;
	});
}

function showNotificationToast(lastNotification){
	toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "18000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};
toastr.info(lastNotification.responseJSON.textSrbLat, "Notifikacija");
}


function loadNewTsk(){
	 return $.ajax({
        type: "POST",
        url: "/loadNewTskMark",
        dataType: "json",
        async: false,
        success: function (json) {
            // return json;
        },
        data: {
            
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
        	console.log(thrownError);
        }
    });
}

function populateNewRokBadge(number){
	// console.log(number);
	if (parseInt(number.responseJSON) > 0){
		$("#newRokBadge").html(number.responseJSON);
		$("#newRokBadge").show();
		$("#newRokBadgeHeader").html(number.responseJSON);
		$("#newRokBadgeHeader").show();
		$(".newRokBadgeTab").html(number.responseJSON);
	}
	else {
		$("#newRokBadge").hide();
		$("#newRokBadgeHeader").hide();
		$(".newRokBadgeTab").hide();
	}
}

function populateUnreadBadgeFinance(){

	$.ajax({
        type: "GET",
        url: "/populateUnreadBadgeFinance",
        async: false,
        success: function (number) {
            if (parseInt(number) > 0){
				$("#unreadBadgeFinance").html(number);
				$("#unreadBadgeFinance").show();
			}
			else {
				$("#unreadBadgeFinance").hide();
			}
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
        	console.log(thrownError);
        }
    });

	
}


function loadunreadtsk(){
	 return $.ajax({
        type: "POST",
        url: "/loadunreadtsk",
        dataType: "json",
        async: false,
        success: function (json) {
            // return json;
        },
        data: {
            
        },
        error: function (xhr, ajaxOptions, thrownError) {
        	console.log(xhr.status);
        	console.log(thrownError);
        }
    });
}

function loadunreadwt(){
	 return $.ajax({
        type: "POST",
        url: "/loadunreadwt",
        dataType: "json",
        async: false,
        success: function (json) {
            // return json;
        },
        data: {
            
        },
        error: function (xhr, ajaxOptions, thrownError) {
        	console.log(xhr.status);
        	console.log(thrownError);
        }
    });
}

function loadunreadcase(){
	 return $.ajax({
        type: "POST",
        url: "/loadunreadcase",
        dataType: "json",
        async: false,
        success: function (json) {
            // return json;
        },
        data: {
            
        },
        error: function (xhr, ajaxOptions, thrownError) {
        	console.log(xhr.status);
        	console.log(thrownError);
        }
    });
}

function populateunreadtskBadge(number){
	// console.log(number);
	if (parseInt(number.responseJSON) > 0){
		$("#unreadBadge").html(number.responseJSON);
		$("#unreadBadge").show();
		$("#unreadBadgeHeader").html(number.responseJSON);
		$("#unreadBadgeHeader").show();
	}
	else {
		$("#unreadBadge").hide();
		$("#unreadBadgeHeader").hide();
	}
}

function populateunreadwtime(number){
	if (parseInt(number.responseJSON) > 0){
		$("#unreadWtBadge").html(number.responseJSON);
		$("#unreadWtBadge").show();
		$("#unreadWtBadgeHeader").html(number.responseJSON);
		$("#unreadWtBadgeHeader").show();
	}
	else {
		$("#unreadWtBadge").hide();
		$("#unreadWtBadgeHeader").hide();
	}
}

function populateunreadcase(number){
	if (parseInt(number.responseJSON) > 0){
		$("#unreadCaseBadge").html(number.responseJSON);
		$("#unreadCaseBadge").show();
		$("#unreadCaseBadgeHeader").html(number.responseJSON);
		$("#unreadCaseBadgeHeader").show();
	}
	else {
		$("#unreadCaseBadge").hide();
		$("#unreadCaseBadgeHeader").hide();
	}
}

