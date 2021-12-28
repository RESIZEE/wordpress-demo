import $ from 'jquery';

/*
    Displays success alert HTML element and hides it after 3s.
*/
export function showSuccessAlert(successAlertMessage, selector) {
    /*
        Event is passed to select closest alert box to clicked element
        because multiple alerts could potentially be on the same page.
    */
    let successAlert = $(`div.${selector}.alert-success`);

    successAlert.removeClass('d-none');
    setTimeout(() => successAlert.addClass('d-none'), 3000);

    successAlert.html(successAlertMessage);
}

/*
    Displays error alert HTML element and hides it after 3s.
*/
export function showErrorAlert(errorAlertMessage, selector) {
    /*
        Event is passed to select closest alert box to clicked element
        because multiple alerts could potentially be on the same page.
    */
    let errorAlert = $(`div.${selector}.alert-danger`);

    errorAlert.removeClass('d-none');
    setTimeout(() => errorAlert.addClass('d-none'), 3000);

    errorAlert.html(errorAlertMessage);
}
