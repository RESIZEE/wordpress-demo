import $ from 'jquery';
import { subscribe } from "../../../../../wp-includes/js/dist/redux-routine";

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

        let successAlert = $('#success-alert');
        let errorAlert = $('#error-alert');
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
            error: () => {
                errorAlert.removeClass('d-none');
                setTimeout(() => errorAlert.addClass('d-none'), 3000);

                errorAlert.html('Unhandled error occurred.');
            },
        });
    }
}


export default Review;