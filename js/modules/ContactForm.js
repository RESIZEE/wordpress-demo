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
                    console.log("Unable to save post");
                } else {
                    console.log("Message saved");
                }
            },
            error: (response) => {
                console.log(response);
            },
        });
    }
}

export default ContactForm;
