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

    submitCallback() {
        e.preventDefault();

        let form = $(this);

        let name = form.find("#name").val(),
            email = form.find("#email").val(),
            message = form.find("#message").val(),
            ajaxurl = form.data("url");

        if (name == "" || email == "" || message == "") {
            console.log("empty");
            return;
        }

        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
                name: name,
                email: email,
                message: message,
                action: "demo_save_user_contact_form",
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
