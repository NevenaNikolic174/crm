var localeJS;

if ($('#localeJS').val()) {
    localeJS = JSON.parse($('#localeJS').val());
}

//== Class Definition
var SnippetLogin = (function () {
    var login = $('#m_login');

    var showErrorMsg = function (form, type, msg) {
        var alert = $(
            '<div class="m-alert m-alert--outline alert alert-' +
                type +
                ' alert-dismissible" role="alert">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
		</div>',
        );

        form.find('.alert').remove();
        alert.prependTo(form);
        alert.animateClass('fadeIn animated');
        alert.find('span').html(msg);
    };

    //== Private Functions

    var displaySignUpForm = function () {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signin');

        login.addClass('m-login--signup');
        login.find('.m-login__signup').animateClass('flipInX animated');
    };

    var displaySignInForm = function () {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signup');

        login.addClass('m-login--signin');
        login.find('.m-login__signin').animateClass('flipInX animated');
    };

    var displayForgetPasswordForm = function () {
        login.removeClass('m-login--signin');
        login.removeClass('m-login--signup');

        login.addClass('m-login--forget-password');
        login
            .find('.m-login__forget-password')
            .animateClass('flipInX animated');
    };

    var handleFormSwitch = function () {
        $('#m_login_forget_password').click(function (e) {
            e.preventDefault();
            displayForgetPasswordForm();
        });

        $('#m_login_forget_password_cancel').click(function (e) {
            e.preventDefault();
            displaySignInForm();
        });

        $('#m_login_signup').click(function (e) {
            e.preventDefault();
            displaySignUpForm();
        });

        $('#m_login_signup_cancel').click(function (e) {
            e.preventDefault();
            displaySignInForm();
        });
    };

    var handleSignInFormSubmit = function () {
        $('#m_login_signin_submit').click(function (e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                    },
                },
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr(
                'disabled',
                true,
            );

            form.ajaxSubmit({
                url: '',
                success: function (response, status, xhr, $form) {
                    // similate 2s delay
                    setTimeout(function () {
                        btn.removeClass(
                            'm-loader m-loader--right m-loader--light',
                        ).attr('disabled', false);
                        showErrorMsg(
                            form,
                            'danger',
                            'Incorrect username or password. Please try again.',
                        );
                    }, 2000);
                },
            });
        });
    };

    var handleSignUpFormSubmit = function () {
        $('#m_login_signup_submit').click(function (e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    fullname: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                    },
                    rpassword: {
                        required: true,
                    },
                    agree: {
                        required: true,
                    },
                },
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr(
                'disabled',
                true,
            );

            form.ajaxSubmit({
                url: '',
                success: function (response, status, xhr, $form) {
                    // similate 2s delay
                    setTimeout(function () {
                        btn.removeClass(
                            'm-loader m-loader--right m-loader--light',
                        ).attr('disabled', false);
                        form.clearForm();
                        form.validate().resetForm();

                        // display signup form
                        displaySignInForm();
                        var signInForm = login.find('.m-login__signin form');
                        signInForm.clearForm();
                        signInForm.validate().resetForm();

                        showErrorMsg(
                            signInForm,
                            'success',
                            'Thank you. To complete your registration please check your email.',
                        );
                    }, 2000);
                },
            });
        });
    };

    var handleForgetPasswordFormSubmit = function () {
        $('#m_login_forget_password_submit').click(function (e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                },
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr(
                'disabled',
                true,
            );

            form.ajaxSubmit({
                url: '',
                success: function (response, status, xhr, $form) {
                    // similate 2s delay
                    setTimeout(function () {
                        btn.removeClass(
                            'm-loader m-loader--right m-loader--light',
                        ).attr('disabled', false); // remove
                        form.clearForm(); // clear form
                        form.validate().resetForm(); // reset validation states

                        // display signup form
                        displaySignInForm();
                        var signInForm = login.find('.m-login__signin form');
                        signInForm.clearForm();
                        signInForm.validate().resetForm();

                        showErrorMsg(
                            signInForm,
                            'success',
                            'Cool! Password recovery instruction has been sent to your email.',
                        );
                    }, 2000);
                },
            });
        });
    };

    //== Public Functions
    return {
        // public functions
        init: function () {
            handleFormSwitch();
            handleSignInFormSubmit();
            handleSignUpFormSubmit();
            handleForgetPasswordFormSubmit();
        },
    };
})();
/**
 * detect IE
 * returns version of IE or false, if browser is not Internet Explorer
 */
function detectIE() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
        // Edge (IE 12+) => return version number
        // return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
        return false;
    }

    // other browser
    return false;
}
//== Class Initialization

var togglePassView = false;

$(document).on('click', '#viberBtn', function () {
    $('#viberZajednicaModal').modal();
});

$(document).on('click', '#podrskaLink', function (e) {
    e.preventDefault();
    $('#infoModal').modal();
});

jQuery(document).ready(function () {
    SnippetLogin.init();
    if (detectIE()) {
        var langObj;
        if (localeJS) {
            langObj = {
                postovani: localeJS.postovani,
                browser: localeJS.browser,
                chrome: localeJS.chrome,
            };
            //console.log(langObj);
        } else {
            langObj = {
                postovani: 'Poštovani',
                browser: 'Vaša verzija browser-a trenutno nije podržana',
                chrome: 'Molimo Vas da koristite Google Chrome browser',
            };
        }

        $('.m-login__signin').html(
            '<p>' +
                langObj.postovani +
                ',<br><br>' +
                langObj.browser +
                '.<br> ' +
                langObj.chrome +
                '.</p>',
        );
        $('.m-login__account').remove();
    }

    $('#viewPassBtn').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        togglePassView = !togglePassView;
        if (togglePassView) {
            $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        }
    });
});
