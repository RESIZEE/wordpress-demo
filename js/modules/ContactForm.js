import $ from "jquery";

class ContactForm {
        
    constructor() {
        this.events();
    }

    events() {
        // On hover fill star on leave make it shallow
        // simulating hover state of CSS
        $("#demo-contact-form").on("submit", this.submitCallback);
    }

    submitCallback(e) {
        e.preventDefault();

        let form = $(this);

        $('.is-invalid').removeClass('is-invalid').addClass('is-valid');
        $(".show-feedback").removeClass('show-feedback');

        let name = form.find("#name").val(),
            email = form.find("#email").val(),
            message = form.find("#message").val();

        // Validation
        if (name == "") {
            $('#name').addClass('is-invalid');
            return;
        }

        if (email == "") {
            $('#email').addClass('is-invalid');
            return;
        }

        if (message == "") {
            $('#message').addClass('is-invalid');
            return;
        }

        form.find('input, button, textarea').attr('disabled','disabled');
        $('.form-submited').addClass('show-feedback');

        $.ajax({
            url: `${demoData.rootUrl}/wp-json/demo/v1/contact`,
            headers: {
                'X-WP-Nonce': demoData.nonce,
            },
            type: "POST",
            data: {
                name: name,
                email: email,
                message: message,
            },
            success: (response) => {
                if (response == 0) {
                    setTimeout(function(){
                        $('.form-submited').removeClass('show-feedback');
                        $('.form-error').addClass('show-feedback');
                        form.find('input, button, textarea').removeAttr('disabled');
                    },1000);
                    
                } else {
                    setTimeout(function(){
                        $('.form-submited').removeClass('show-feedback');
                        $('.form-success').addClass('show-feedback');
                        form.find('input, button, textarea').removeAttr('disabled').val('');
                    },1000);
                    
                }
            },
            error: (response) => {
                setTimeout(function(){
                    $('.form-submited').removeClass('show-feedback');
                    $('.form-error').addClass('show-feedback');
                    form.find('input, button, textarea').removeAttr('disabled');
                },1000);
                console.log(response);
            },
        });
    }
}

export default ContactForm;
