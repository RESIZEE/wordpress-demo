import $                                    from 'jquery';
import { showSuccessAlert, showErrorAlert } from '../helpers/ResponseAlerts';

class Review {
    constructor() {
        this.events();
    }

    events() {
        /*
            On hover fill star on leave make it shallow
            simulating hover state of CSS
         */
        $('.reviews i')
            .on('mouseenter', this.fillStarts)
            .on('mouseleave', this.emptyStars)
            .on('click', this.onClickCallback);
    }

    fillStarts() {
        let currentElement = $(this);

        /*
            If user hovers over clicked(filled) star make it empty
            on the other hand make them filled
         */
        if(!currentElement.attr('data-star-checked')) {
            currentElement.removeClass('far').addClass('fas');
            currentElement.prevAll('i').removeClass('far').addClass('fas');
        }else {
            currentElement.nextAll('i').removeClass('fas').addClass('far');
        }
    }

    emptyStars() {
        $('.reviews i').each(function() {
            let currentElement = $(this);

            // Stars that are clicked do not get emptied all others do
            if(!currentElement.attr('data-star-checked')) {
                currentElement.removeClass('fas').addClass('far');
            }else {
                currentElement.removeClass('far').addClass('fas');
            }
        });
    }

    onClickCallback(event) {
        let currentElement = $(this);
        let currentElementSiblings = currentElement.prevAll('i');

        // Calculating review by sibling number + 1 for current star selected
        let reviewScore = currentElementSiblings.length + 1;
        let postId = currentElement.closest('.reviews').data('post-id');

        /*
            Adding custom attribute so clicked starts always stay selected
            Previously clearing custom attributes of all stars
         */
        $('.reviews i').removeAttr('data-star-checked');
        currentElement.attr('data-star-checked', 'true');
        currentElementSiblings.attr('data-star-checked', 'true');

        $.ajax({
            url: demoData.ajaxUrl,
            type: 'POST',
            data: {
                _ajax_nonce: demoData.nonce,
                action: 'create_or_update_review',
                reviewed_post_id: postId,
                review_score: reviewScore,
            },
            success: (response) => {
                showSuccessAlert(response.data.message, event);

                $('.review-score').html(response.data.review_score);
            },
            error: (response) => {
                showErrorAlert(response.responseJSON.data.message, event);
            },
        });
    }
}


export default Review;