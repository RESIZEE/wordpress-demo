import $ from 'jquery';

class NewsletterEmailOutput {
    constructor() {
        this.events();
    }

    events() {
        // On hover fill star on leave make it shallow
        // simulating hover state of CSS
        $('#newsletter-email-output-button')
            .on('click', this.onClickCallback);
    }

    onClickCallback() {
        let successAlert = $('#success-alert');
        let errorAlert = $('#error-alert');
        let emailTitle = $('#newsletter-email-title');
        let emailContent = $('#newsletter-email-content');

        $.ajax({
            url: `${demoData.rootUrl}/wp-json/demo/v1/admin/newsletter/email`,
            headers: {
                'X-WP-Nonce': demoData.nonce,
            },
            type: 'POST',
            data: {
                'email_title': emailTitle.val(),
                'email_content': emailContent.val(),
            },
            success: (response) => {
                emailTitle.val('');
                emailContent.val('');

                if(response.success) {
                    successAlert.removeClass('d-none');

                    setTimeout(() => successAlert.addClass('d-none'), 3000);
                    successAlert.html(response.success);
                }

                if(response.error) {
                    errorAlert.removeClass('d-none');

                    setTimeout(() => errorAlert.addClass('d-none'), 3000);
                    errorAlert.html(response.error);

                }
            },
            error: (response) => {
                emailTitle.val('');
                emailContent.val('');

                errorAlert.removeClass('d-none');
                setTimeout(() => errorAlert.addClass('d-none'), 3000);

                errorAlert.html(response.error);
            },
        });
    }
}


export default NewsletterEmailOutput;