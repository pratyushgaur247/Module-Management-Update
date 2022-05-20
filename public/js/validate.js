// Bank Account Form Validation 
$('#form_bank_account').validate({
    rules: {
        routing_number: {
            required: true,
        },
        bank_account: {
            required: true,
        },
        dob: {
            required: true,
        },
        ssn: {
            required: true,
        },
        country: {
            required: true,
        },
        line1: {
            required: true,
        },
        line2: {
            required: true,
        },
        city: {
            required: true,
        },
        state: {
            required: true,
        },
        zip: {
            // required: true,
        },
        mobile_number: {
            required: true,
            matches:"[0-9]",
            minlength:10, 
            maxlength:10
        },
        media: {
            required: true,
        },
        
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});

// Bank Account Update Form Validation 
$('#form_bank_account_update').validate({
    rules: {
        routing_number: {
            required: true,
        },
        bank_account: {
            required: true,
        },
        dob: {
            required: true,
        },
        // ssn: {
        //     required: true,
        // },
        country: {
            required: true,
        },
        line1: {
            required: true,
        },
        line2: {
            required: true,
        },
        city: {
            required: true,
        },
        state: {
            required: true,
        },
        zip: {
            // required: true,
        },
        mobile_number: {
            required: true,
            phoneUS: true,
        },
        // media: {
        //     required: true,
        // },
        
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});