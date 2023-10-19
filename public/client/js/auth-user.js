$('.form-auth-user input').on('change', function() {
    $(this).next('.form-error').hide();
});
$('.form-auth-user').submit(function(e) {
    $(this).find('.handle').removeClass('d-none');
    $(this).find('.text-button').hide();
    setTimeout(() => {
        $(this).find('.handle').addClass('d-none');
        $(this).find('.text-button').show();
    }, 2000);
});
$('.toggle-show-password').click(function() {
    var previousElement = $(this).prev();
    if (previousElement.attr('type') === 'password') {
        previousElement.attr('type', 'text');
        $(this).find('i').addClass('bi-eye-slash-fill').removeClass('bi-eye-fill');
    } else {
        previousElement.attr('type', 'password');
        $(this).find('i').addClass('bi-eye-fill').removeClass('bi-eye-slash-fill');
    }
});

setTimeout(() => {
    $('.update-info').hide();
}, 2000);