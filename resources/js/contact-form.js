let domain = window.location.origin;
$('#contact-form').validate({
    rules: {
        name: {
            required: true
        },
        phone: {
            required: true
        },
        message: {
            required: true
        }
    },
    message: {
        name: '',
        phone: '',
        message: ''
    },
    submitHandler: function () {
        $('#contact-form .submit-button').addClass('no-pointer')
        let formData = {
            "name": $('#contact-form input[name="name"]').val(),
            "phone": $('#contact-form input[name="phone"]').val(),
            "message": $('#contact-form textarea[name="message"]').val(),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: domain + '/consultations',
            data: formData,
            dataType: 'json',
            encode: true,
            beforeSend: function () {
                $('#contact-form .submit-button').addClass('no-pointer')
            },
            error: function (err) {
                $('#contact-form .submit-button').addClass("no-validate no-pointer").text('Ошибка');
                setTimeout(function () {
                    $('#contact-form .submit-button').removeClass('no-validate', 3250)
                    $('#contact-form .submit-button').removeClass('no-pointer').text('Отправить')
                }, 2000)
            },
            success: function (data) {
                $('#contact-form .submit-button').addClass("validate no-pointer").text('Отправлено');
                setTimeout(function () {
                    $('#contact-form .submit-button').removeClass('validate', 1250)
                    $('#contact-form .submit-button').removeClass('no-pointer').text('Отправить')
                }, 2000)
                $('#contact-form input[name="name"]').val('');
                $('#contact-form input[name="phone"]').val('');
                $('#contact-form textarea[name="message"]').val('')
            }
        })
    }
})
$('#contact-form-2').validate({
    rules: {
        name: {
            required: true
        },
        phone: {
            required: true
        },
        message: {
            required: true
        }
    },
    message: {
        name: '',
        phone: '',
        message: ''
    },
    submitHandler: function () {
        $('#contact-form-2 .submit-button').addClass('no-pointer')
        let formData = {
            "name": $('#contact-form-2 input[name="name"]').val(),
            "phone": $('#contact-form-2 input[name="phone"]').val(),
            "message": $('#contact-form-2 textarea[name="message"]').val(),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: domain + '/consultations',
            data: formData,
            dataType: 'json',
            encode: true,
            beforeSend: function () {
                $('#contact-form-2 .submit-button').addClass('no-pointer')
            },
            error: function (err) {
                $('#contact-form-2 .submit-button').addClass("no-validate no-pointer").text('Ошибка');
                setTimeout(function () {
                    $('#contact-form-2 .submit-button').removeClass('no-validate', 3250)
                    $('#contact-form-2 .submit-button').removeClass('no-pointer').text('Отправить')
                }, 2000)
            },
            success: function (data) {
                $('#contact-form-2 .submit-button').addClass("validate no-pointer").text('Отправлено');
                setTimeout(function () {
                    $('#contact-form-2 .submit-button').removeClass('validate', 1250)
                    $('#contact-form-2 .submit-button').removeClass('no-pointer').text('Отправить')
                }, 2000)
                $('#contact-form-2 input[name="name"]').val('');
                $('#contact-form-2 input[name="phone"]').val('');
                $('#contact-form-2 textarea[name="message"]').val('')
            }
        })
    }
})
$('#first-modal-form').validate({
    rules: {
        name: {
            required: true
        },
        phone: {
            required: true
        },
        mail: {
            required: true
        }
    },
    message: {
        name: '',
        phone: '',
        mail: ''
    },
    submitHandler: function () {
        $('#first-modal-form .submit-button').addClass('no-pointer')
        let formData = {
            "name": $('#first-modal-form input[name="name"]').val(),
            "phone": $('#first-modal-form input[name="phone"]').val(),
            "email": $('#first-modal-form input[name="mail"]').val(),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: domain + '/newsletter-subscriptions',
            data: formData,
            dataType: 'json',
            encode: true,
            beforeSend: function () {
                $('#first-modal-form .submit-button').addClass('no-pointer')
            },
            error: function (err) {
                $('#first-modal-form .submit-button').addClass("no-validate no-pointer").text('Ошибка');
                setTimeout(function () {
                    $('#first-modal-form .submit-button').removeClass('no-validate', 3250)
                    $('#first-modal-form .submit-button').removeClass('no-pointer').text('Отправить')
                }, 2000)
            },
            success: function (data) {
                $('#first-modal-form .submit-button').addClass("validate no-pointer").text('Отправлено');
                setTimeout(function () {
                    $('#first-modal-form .submit-button').removeClass('validate', 1250)
                    $('#first-modal-form .submit-button').removeClass('no-pointer').text('Отправить')
                    $('.offer-modal .close').trigger('click')
                }, 2000)
                $('#first-modal-form input[name="name"]').val('');
                $('#first-modal-form input[name="phone"]').val('');
                $('#first-modal-form input[name="mail"]').val('')
            }
        })
    }
})
$('#second-modal-form').validate({
    rules: {
        name: {
            required: true
        },
        phone: {
            required: true
        }
    },
    message: {
        name: '',
        phone: ''
    },
    submitHandler: function () {
        $('#second-modal-form .submit-button').addClass('no-pointer')
        let formData = {
            "name": $('#second-modal-form input[name="name"]').val(),
            "phone": $('#second-modal-form input[name="phone"]').val(),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: domain + '/newsletter-subscriptions',
            data: formData,
            dataType: 'json',
            encode: true,
            beforeSend: function () {
                $('#second-modal-form .submit-button').addClass('no-pointer')
            },
            error: function (err) {
                $('#second-modal-form .submit-button').addClass("no-validate no-pointer").text('Ошибка');
                setTimeout(function () {
                    $('#second-modal-form .submit-button').removeClass('no-validate', 3250)
                    $('#second-modal-form .submit-button').removeClass('no-pointer').text('Отправить')
                }, 2000)
            },
            success: function (data) {
                $('#second-modal-form .submit-button').addClass("validate no-pointer").text('Отправлено');
                setTimeout(function () {
                    $('#second-modal-form .submit-button').removeClass('validate', 1250)
                    $('#second-modal-form .submit-button').removeClass('no-pointer').text('Отправить')
                    $('.offer-modal .close').trigger('click')
                }, 2000)
                $('#second-modal-form input[name="name"]').val('');
                $('#second-modal-form input[name="phone"]').val('');
            }
        })
    }
})
$('#third-modal-form').validate({
    rules: {
        name: {
            required: true
        },
        phone: {
            required: true
        },
        mail: {
            required: true
        }
    },
    message: {
        name: '',
        phone: '',
        mail: ''
    },
    submitHandler: function () {
        $('#third-modal-form .submit-button').addClass('no-pointer')
        let formData = {
            "name": $('#third-modal-form input[name="name"]').val(),
            "phone": $('#third-modal-form input[name="phone"]').val(),
            "email": $('#third-modal-form input[name="mail"]').val(),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: domain + '/newsletter-subscriptions',
            data: formData,
            dataType: 'json',
            encode: true,
            beforeSend: function () {
                $('#third-modal-form .submit-button').addClass('no-pointer')
            },
            error: function (err) {
                $('#third-modal-form .submit-button').addClass("no-validate no-pointer").text('Ошибка');
                setTimeout(function () {
                    $('#third-modal-form .submit-button').removeClass('no-validate', 3250)
                    $('#third-modal-form .submit-button').removeClass('no-pointer').text('Отправить')
                }, 2000)
            },
            success: function (data) {
                $('#third-modal-form .submit-button').addClass("validate no-pointer").text('Отправлено');
                setTimeout(function () {
                    $('#third-modal-form .submit-button').removeClass('validate', 1250)
                    $('#third-modal-form .submit-button').removeClass('no-pointer').text('Отправить')
                }, 2000)
                $('#third-modal-form input[name="name"]').val('');
                $('#third-modal-form input[name="phone"]').val('');
                $('#third-modal-form input[name="mail"]').val('')
                $('.offer-modal .close').trigger('click')
            }
        })
    }
})
$('#tour-form').validate({
    rules: {
        name: {
            required: true
        },
        phone: {
            required: true
        },
        message: {
            required: true
        }
    },
    message: {
        name: '',
        phone: '',
        message: ''
    },
    submitHandler: function () {
        $('#contact-form .submit-button').addClass('no-pointer')
        let formData = {
            "name": $('#tour-form input[name="name"]').val(),
            "phone": $('#tour-form input[name="phone"]').val(),
            "message": $('#tour-form textarea[name="message"]').val() + '   | Заявка с тура:  '+ domain + '/tours/' + $('.single-tour-wrap').attr('data-tour-slug'),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: domain +'/consultations',
            data: formData,
            dataType: 'json',
            encode: true,
            beforeSend: function () {
                $('#tour-form .submit-button').addClass('no-pointer')
            },
            error: function (err) {
                console.log(formData)
                $('#tour-form .submit-button').addClass("no-validate no-pointer").text('Ошибка');
                setTimeout(function () {
                    $('#tour-form .submit-button').removeClass('no-validate', 3250)
                    $('#tour-form .submit-button').removeClass('no-pointer').text('Отправить')
                }, 2000)
            },
            success: function (data) {
                $('#tour-form .submit-button').addClass("validate no-pointer").text('Отправлено');
                setTimeout(function () {
                    $('#tour-form .submit-button').removeClass('validate', 1250)
                    $('#tour-form .submit-button').removeClass('no-pointer').text('Отправить')
                    $('#tourModal .close').trigger('click')
                }, 2000)
                $('#tour-form input[name="name"]').val('');
                $('#tour-form input[name="phone"]').val('');
                $('#tour-form textarea[name="message"]').val('')
            }
        })
    }
})
