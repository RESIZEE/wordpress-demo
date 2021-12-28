import $                                    from 'jquery';
import { showSuccessAlert, showErrorAlert } from '../../helpers/ResponseAlerts';

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
            url: demoData.ajaxUrl,
            type: 'POST',
            data: {
                _ajax_nonce: demoData.nonce,
                action: 'output_newsletter_email',
                email_title: emailTitle.val(),
                email_content: emailContent.val(),
            },
            success: (response) => {
                emailTitle.val('');
                emailContent.val('');

                showSuccessAlert(response.data.message, 'admin-newsletter-alert');

                loadingSpinner.addClass('d-none');
            },
            error: (response) => {
                showErrorAlert(response.responseJSON.data.message, 'admin-newsletter-alert');

                loadingSpinner.addClass('d-none');
            },
        });
    }
}

export default NewsletterEmailOutput;