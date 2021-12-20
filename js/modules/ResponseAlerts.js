import $ from 'jquery';

export function showSuccessAlert(successAlertMessage) {
    let successAlert = $('#success-alert');

    successAlert.removeClass('d-none');
    setTimeout(() => successAlert.addClass('d-none'), 3000);

    successAlert.html(successAlertMessage);
}

export function showErrorAlert(errorAlertMessage) {
    let errorAlert = $('#error-alert');

    errorAlert.removeClass('d-none');
    setTimeout(() => errorAlert.addClass('d-none'), 3000);

    errorAlert.html(errorAlertMessage);
}
