// var domtoimage = require('dom-to-image');
//lokalizacija
var delLocaleJS;
if($('#delLocaleJS').val()) {
	delLocaleJS = JSON.parse($('#delLocaleJS').val());
}

$ (document).on("click", "#clikchangeuserrole", function(event) {
	$("#changeUserRole").modal();
});

function checkValidateForm(){
	$('.activeButton').attr('disabled', true);

	if ($("#feedbackForm").valid()) {
		swal({
			"title": "",
			// "text": "Imate greške na formularu. Molimo Vas ispravite greške i nastavite",
			"text": "Uspešno ste poslali poruku",
			"type": "success",
			"confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
		});
		$("#feedbackForm").submit();
	}else{
		$('.activeButton').attr('disabled', false);
	}
}

jQuery(document).ready(function() {
	// populateUnreadBadgeFinance();
	var checkTextsModule = $('#checkTextsModule').val();
	if (checkTextsModule) {
		checkUnreadTextsCount();
	}

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}

	});
	countNoReadNotification();
	getUserKancelarkoPoruke();
	countUnreadKancelarkoTextMessages();
	window.setInterval(function(){
		countNoReadNotification();
		countUnreadKancelarkoTextMessages();
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
	});


	if (window.getSelectedModule == 'principal') {
		populateunreadtskBadge(loadunreadtsk());
		// populateunreadwtime(loadunreadwt());
		populateunreadcase(loadunreadcase());
		populateNewRokBadge(loadNewTsk());
		populateUnreadBadgeFinance()
	}

	$("#feedback-banner").click(function(){

		html2canvas(document.body, {
			ignoreElements: $("#feedback-modal"),
			backgroundColor: "#ffffff"
		}).then(function(canvas) {

			// var ctx = canvas.getContext('2d');
			// ctx.beginPath();
			// ctx.arc(100, 100, 50, 1.5 * Math.PI, 0.5 * Math.PI, false);
			// ctx.lineWidth = 10;
			// ctx.stroke();
			var imgData = canvas.toDataURL();
			$("#printScrn").val(imgData);
			// console.log("imgData", imgData);
		});

		$("#feedback-modal").modal();

		// $("#feedback-modal").modal();


		// // domtoimage.toJpeg(document.body, { quality: 0.95 })
		// // .then(function (dataUrl) {
		// // 	console.log("dataUrl", dataUrl);
		// // 	// var link = document.createElement('a');
		// // 	// link.download = 'my-image-name.jpeg';
		// // 	// link.href = dataUrl;
		// // 	// link.click();
		// // });
		// var captureStream = startCapture();
		// console.log(captureStream);
	});

	//VIDEO UPUTSTVA NEW
	$("#videoUputstva").click(function(){
		$("#videoModal").modal();
	});

	$("#eFakUputstva").click(function(){
		// $("#eFakUputstvaModal").modal();
	});

	$("#eDelUputstva").click(function(){
		// $("#eDelUputstvaModal").modal();
	});

	$(document).ready(function(){
		//ukoliko nije prihvatio uslove, ne prikazujem mu uputstva
		if (typeof window.appAccCond !== 'undefined' && window.appAccCond == 0) {

		} else {
			var dontShowVideo = localStorage.getItem('dontShowVideo');
			//proveravamo storage ako ga nema pravimo ga
			if(!dontShowVideo) {
				$('#videoUputstvaShowCheck').prop('checked', false);
				$("#videoUputstvaShow").addClass('m-menu__item--open-dropdown m-menu__item--hover');
			}
			else {
				$('#videoUputstvaShowCheck').prop('checked', true);
			}

			$("#videoUputstvaShowCheck").change(function() {
				if(this.checked) {
					localStorage.setItem('dontShowVideo', "true");
				}
				else {
					localStorage.removeItem('dontShowVideo');
				}
			});

			$('#m_nav .m-nav__item').click(function(){
				$('#m_nav .m-nav__item').removeClass("m-nav__item--active");
				$(this).addClass("m-nav__item--active");
			});

			$('#m_nav_del .m-nav__item').click(function(){
				$('#m_nav_del .m-nav__item').removeClass("m-nav__item--active");
				$(this).addClass("m-nav__item--active");
			});

			$('.m-nav__sub .m-nav__link-text').click(function () {
				$('.m-nav__sub .m-nav__link-text').removeClass("subActive");
				$(this).addClass("subActive");
			})
		}



		$('.srcYtF').click(function(){
			// console.log($(this).attr("data-src"));
			let src = $(this).attr("data-src");
			loadIframe('eFakdynamicVideoContent', src);
		});

		$('.srcYtD').click(function(){
			// console.log($(this).attr("data-src"));
			let src = $(this).attr("data-src");
			loadIframe('eDeldynamicVideoContent', src);
		});
	});

	function loadIframe(iframeName, url) {
		var $iframe = $('#' + iframeName);
		if ($iframe.length) {
			$iframe.attr('src',url);
			return false;
		}
		return true;
	}

	$("#videoModal").on('hidden.bs.modal', function (e) {
		$("#videoModal iframe").attr("src", $("#videoModal iframe").attr("src"));
	});

	//feedbackForm
	//lokalizacija
	var langFeedbackForm;
	if(delLocaleJS) {
		langFeedbackForm = { required: delLocaleJS.feedbackForm.required, text: delLocaleJS.feedbackForm.text };
	} else {
		langFeedbackForm = { required: 'Obavezno polje', text: "Imate greške na formularu. Molimo Vas ispravite greške i nastavite" };
	}

	$.validator.methods.fontele = function( value, element ) {
		return this.optional( element ) || /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/.test( value );
	}

	$("#feedbackNumber").on('keypress', function(key){
		// var key = $(this).val();
		// console.log(key.charCode);
		if(key.charCode == 43){
			return true;
		}else if(key.charCode == 45){
			return true;
		}else if(key.charCode == 47){
			return true;
		}
		else if(key.charCode < 48 || key.charCode > 57) return false;
		// var regex = /^[a-zA-Z]+$/;
		// if(regex.test($(this).val()) == true){
		// 	console.log("KITA");
		// 	return false;
		// }
		// alert($(this).val());
	});

	$("#feedbackForm").validate({
		ignore: ":hidden",
		rules: {
			"feedbackText": {
				required: true
			},
			"feedbackNumber": {
				required: true,
				maxlength: 20,
				fontele: true
			}
		},
		messages: {
			"feedbackText": {
				// required: 'Obavezno polje'
				required: langFeedbackForm.required,
				// regex: "^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$"
			},
			"feedbackNumber": {
				// required: 'Obavezno polje'
				required: langFeedbackForm.required,
				fontele: "Broj telefona nije u dobrom formatu",
				maxlength: "Dozvoljena duzina telefona je 20 karaktera"
			}
		},
		invalidHandler: function (event, validator) { var errors = validator.numberOfInvalids();if (errors) { validator.errorList[0].element.focus(); }
			mApp.scrollTop();
			swal({
				"title": "",
				// "text": "Imate greške na formularu. Molimo Vas ispravite greške i nastavite",
				"text": langFeedbackForm.text + ".",
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

function countUnreadKancelarkoTextMessages() {
	let headerNumber = $('#unread-kanc-msgs-icon');

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $ ('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajax({
		url: "/texts/count-unread-messages",
		method: "GET",
		success: function(response) {
			if (response.count > 0) {
				headerNumber.removeClass('d-none');
				headerNumber.html(response.count);
			} else {
				headerNumber.addClass('d-none');
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

function checkUnreadTextsCount() {
    let  unreadCount = 0;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $ ('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/texts/check-unread",
        type: "GET",
        success: function(response) {
            unreadCount = response.noOfUnreadTexts;

            if (unreadCount > 0) {
				// console.log($("#unread-texts-icon").get(), unreadCount);
                $("#unread-texts-icon").removeClass('d-none');
            }
        }
    });
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

function showFullKancelarkoMsg(msgID) {
	$.ajax({
		type: 'GET',
		url: `/kancelarkoMsgSeen/${msgID}`,
	}).done(function (res) {
		if (res) {
			$(`.kancelarkoMsg_${msgID}`).each((i, el) => {
				$(el).css('background', 'none')
			});

			let msgCount = parseInt($("#kancelarkoPorukeCount").html()) - 1;
			$("#kancelarkoPorukeCount").html(msgCount);

			if (msgCount <= 0)
				$("#kancelarkoPorukeCount").hide();
		}

		$.ajax({
			type: 'GET',
			url: `/getKancelarkoMsg/${msgID}`,
		}).done(function (res) {
			$('#kancelarkoMsgModal #msg').html(res.msg);
			$('#kancelarkoMsgModal').modal();
		})
	})
}

function formateDateKP(date) {
    const newDate = new Date(date);
    const month = newDate.getMonth() + 1;
    const day = newDate.getDate();
    const year = newDate.getFullYear();
	const h = newDate.getHours();
	const m = newDate.getMinutes();
	const s = newDate.getSeconds();

    return `${day}/${month}/${year} ${h}:${m}:${s}`;
}


