<form id="demo-contact-form" action="" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
    <div class="form-group">
        <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
    </div>
    <div class="form-group">
        <textarea rows="5" class="form-control" name="message" id="message" placeholder="Your Message" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Send</button>
</form>