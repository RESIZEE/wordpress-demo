import $ from 'jquery';

/*
    Displays success alert HTML element and hides it after 3s.
*/
export function showSuccessAlert(successAlertMessage, event) {
    /*
        Event is passed to select closest alert box to clicked element
        because multiple alerts could potentially be on the same page.
    */
    let successAlert = $(event.target).closest('div.success-alert');

    successAlert.removeClass('d-none');
    setTimeout(() => successAlert.addClass('d-none'), 3000);

    successAlert.html(successAlertMessage);
}

/*
    Displays error alert HTML element and hides it after 3s.
*/
export function showErrorAlert(errorAlertMessage, event) {
    /*
        Event is passed to select closest alert box to clicked element
        because multiple alerts could potentially be on the same page.
    */
    let errorAlert = $(event.target).closest('div.error-alert');

    errorAlert.removeClass('d-none');
    setTimeout(() => errorAlert.addClass('d-none'), 3000);

    errorAlert.html(errorAlertMessage);
}
