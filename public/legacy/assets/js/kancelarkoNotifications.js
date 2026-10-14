var delLocaleJS = false;
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
			$("#m_topbar_notification_icon").removeClass("blink");
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
			$("#m_topbar_notification_icon").addClass("blink");
		}
	});
}

function countUnreadKancelarkoTextMessages() {
	let headerNumber = $('#unread-kanc-msgs-icon');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $ ('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajax({
		url: "/count-unread-messages",
		method: "GET",
		success: function(response) {
			if (response.count > 0) {
				headerNumber.removeClass('d-none');
				headerNumber.html(response.count);
				$("#kancelarkoMessagesA").addClass("blink");
			} else {
				headerNumber.addClass('d-none');
				$("#kancelarkoMessagesA").removeClass("blink");
			}
		},
		error: function(error) {
			console.log(error);
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

function notificationHeadVazno(append){
	var offset = $('.headnotification').length;
	var limit = 30;

	return $.ajax({
		type: 'POST',
		dataType: 'json',
		url: '/getHeadNotificationVaznoRequest',
		data: {
			offset: offset,
			limit: limit
		}
	}).done(function (response) {
		mApp.unblock("#topbar_notifications_notifications");
		if (response.length < 1){
			$("#loadmorenotificationVazno").hide();
			$("#markalllink_read").hide();
			$("#markalllink_unread").hide();
		}
		else {
			$("#loadmorenotificationVazno").show();
		}

		$.each( response, function( key, value ) {
			if (append === 1){
				$("#headnotificationVaznolist").append(value);
			}
			else {

				$("#headnotificationVaznolist").append(value);
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
	//lokalizacija
	var langObj;
	if(delLocaleJS) {
		langObj = { text: delLocaleJS.showNotificationToast.text };
	} else {
		langObj = { text: "Notifikacija" };
	}

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
// toastr.info(lastNotification.responseJSON.textSrbLat, "Notifikacija");
toastr.info(lastNotification.responseJSON.textSrbLat, langObj.text);
}

function getUserKancelarkoPoruke() {
	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: '/getKancelarkoMsgsForUser',
	}).done(function (res) {
		if (res.length > 0) {
			let newMsgs = 0;
			$('#kancelarkoPorukeList').html('');

			res.forEach(el => {
				if (el.seen == 0)
					newMsgs++

				$('#kancelarkoPorukeList').append(`
					<div onclick="showFullKancelarkoMsg(${el.kancelarko_share_messages_id})"
						class="m-list-timeline__item headnotification kancelarkoMsg_${el.kancelarko_share_messages_id}"
						style="${el.seen == 0 ? 'background: #02fcff4f; padding: 10px 0; cursor: pointer;' : 'cursor: pointer; padding: 10px 0;'}">
							<span class="m-list-timeline__badge"></span>
							<span class="m-list-timeline__text notificationwordbreak">
								${el.msg.length > 50 ? el.msg.slice(0, 50) + '...' : el.msg}
							</span>
							<span class="m-list-timeline__time">
								<span">${formateDateKP(el.created_at)}</span>
							</span>
					</div>
				`)
			})

			if (newMsgs > 0 )
				$("#kancelarkoPorukeCount").html(newMsgs).show();
		} else {
			$("#kancelarkoPorukeCount").html('').hide();
			$("#kancelarkoPorukeList").html(
				`<p style="text-align: center;"> ${
					delLocaleJS && delLocaleJS.kancelarkoPoruke && delLocaleJS.kancelarkoPoruke.noMsg ?
					delLocaleJS.kancelarkoPoruke.noMsg :
					'Trenutno nemate poruku/e'
				}</p>`)
		}
	});
}

countNoReadNotification();
getUserKancelarkoPoruke();
countUnreadKancelarkoTextMessages();
window.setInterval(function(){
    countNoReadNotification();
    countUnreadKancelarkoTextMessages();
}, 300000);
notificationHead(1);
notificationHeadVazno(1);
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
        console.log(123);
		//lokalizacija
		var langObj;
		if(delLocaleJS) {
			langObj = { notRead: delLocaleJS.readunread.notRead, read: delLocaleJS.readunread.read };
		} else {
			langObj = { notRead: "Obeleži kao nepročitano", read: "Obeleži kao pročitano" };
		}

		var id = $(this).data("id");
		var status = $(this).is(":checked");

		/* Oznaci kao procitano */
		if(status){
			if(markNotificationRead(id)){
				// $("#m-checkbox-"+ id).attr('title', 'Obeleži kao nepročitano');
				$("#m-checkbox-"+ id).attr('title', langObj.notRead);
				$("#notification_" + id).removeClass('unreadnotificationlist');
				countNoReadNotification();
				// notificationHead(0);
			}
		} else {
			/* Oznaci kao neprocitano */
			if(markNotificationUnread(id)){
				// $("#m-checkbox-"+ id).attr('title', 'Obeleži kao pročitano');
				$("#m-checkbox-"+ id).attr('title', langObj.read);
				$("#notification_" + id).addClass('unreadnotificationlist');
				countNoReadNotification();
				// notificationHead(0);
			}
		}
	});

	$("#m_topbar_notification_icon").click(function(){
		$("#headnotificationlist").html("");
		notificationHead(0);

		// $("#headnotificationVaznolist").html("");
		// notificationHeadVazno(0);
	});


