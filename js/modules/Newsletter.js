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

    onClickCallback(e) {
        e.preventDefault();

        let subscriberEmail = $('#newsletter-email').val();

        $.ajax({
            url: `${demoData.rootUrl}/wp-json/demo/v1/newsletter/subscribe`,
            headers: {
                'X-WP-Nonce': demoData.nonce,
            },
            type: 'POST',
            data: {
                'subscriber_email': subscriberEmail,
            },
            success: (response) => {
                if(response.success) {
                    showSuccessAlert(response.success);

                    $('#newsletter-email').val('');
                }

                if(response.error) {
                    showErrorAlert(response.error);
                }
            },
            error: () => {
                showErrorAlert('Unhandled error occurred.');
            },
        });
    }
}

export default Review;