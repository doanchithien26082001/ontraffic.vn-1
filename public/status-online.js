window.addEventListener("offline", () => {
    $('#online-status').addClass('show').text('Mất kết mối Internet');
    window.addEventListener("online", () => {
        $('#online-status').text('Kết nối thành công').css('background', '#ffffffd8');
        setTimeout(() => {
            $('#online-status').removeClass('show').text('');
        }, 1500);
    });
});