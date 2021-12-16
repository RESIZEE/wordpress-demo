<div class="contact-alert alert alert-info form-submited" role="alert">
    <span>Sending message, please wait...</span>
</div>
<div class="contact-alert alert alert-success form-success" role="alert">
    <span>Your message was sent successfuly, thank you!</span>
</div>
<div class="contact-alert alert alert-danger form-error" role="alert">
    <span>There was a problem sending your message, please try again later.</span>
</div>
<form id="demo-contact-form" action="">
    <div class="form-group">
        <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
        <div class="invalid-feedback">
            Your Name is required.
        </div>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email">
        <div class="invalid-feedback">
            Your Email is required.
        </div>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="form-group">
        <textarea rows="5" class="form-control" name="message" id="message" placeholder="Your Message"></textarea>
        <div class="invalid-feedback">
            A message is required.
        </div>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Send</button>
</form>