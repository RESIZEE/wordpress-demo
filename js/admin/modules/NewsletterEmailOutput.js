import $                                    from 'jquery';
import { showSuccessAlert, showErrorAlert } from './ResponseAlerts';

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
        let loadingSpinner = $('.loading-spinner');
        let emailTitle = $('#newsletter-email-title');
        let emailContent = $('#newsletter-email-content');

        loadingSpinner.removeClass('d-none');

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
                if(response.success) {
                    emailTitle.val('');
                    emailContent.val('');

                    showSuccessAlert(response.success);
                }

                if(response.error) {
                    showErrorAlert(response.error);
                }

                loadingSpinner.addClass('d-none');
            },
            error: (response) => {
                showErrorAlert(response.error);

                loadingSpinner.addClass('d-none');
            },
        });
    }
}

export default NewsletterEmailOutput;