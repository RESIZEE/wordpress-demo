import $ from "jquery";


$("#demo-contact-form").on("submit", function (e) {

    e.preventDefault();

    var form = $(this);
    
    var name = form.find('#name').val(),
    email = form.find('#email').val(),
    message = form.find('#message').val(),
    ajaxurl = form.data('url');

    if(name == '' || email == '' || message == ''){
        console.log('empty');
        return;
    }

    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            'name': name,
            'email': email,
            'message': message,
            'action' : 'demo_save_user_contact_form'
        },
        success: (response) => {
            if(response == 0){
                console.log("Unable to save post");
            }else{
                console.log("Message saved");
            }
        },
        error: (response) => {
            console.log(response);
        },
    });



});
