import $                                    from 'jquery';
import { showSuccessAlert, showErrorAlert } from '../helpers/ResponseAlerts';

class Review {
    constructor() {
        this.events();
    }

    events() {
        $('#newsletter-button')
            .on('click', this.onClickCallback);
    }

    onClickCallback(event) {
        event.preventDefault();

        let subscriberEmail = $('#newsletter-email').val();

        $.ajax({
            url: demoData.ajaxUrl,
            type: 'POST',
            data: {
                _ajax_nonce: demoData.nonce,
                action: 'subscribe_to_newsletter',
                subscriber_email: subscriberEmail,
            },
            success: (response) => {
                showSuccessAlert(response.data.message, 'newsletter-alert');
                $('#newsletter-email').val('');
            },
            error: (response) => {
                showErrorAlert(response.responseJSON.data.message, 'newsletter-alert');
            },
        });
    }
}

export default Review;