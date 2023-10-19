$(document).ready(function() {
    $(".files").on("change", function() {
        var files = $(this)[0].files;
        var imageList = $(".image-list");
        var currentImages = imageList.find(".img-item").length;
        var maxImages = 4;
        var maxSize = 1024 * 1024; // 1MB
        var validExtensions = ["jpeg", "jpg", "png", "gif", "webp"];
        var validFiles = [];
        var invalidFiles = [];

        if (files.length > maxImages - currentImages) {
            alert("Bạn chỉ có thể chọn tối đa 4 ảnh.");
            return; // Thoát khỏi sự kiện nếu đã vượt quá số lượng cho phép
        }

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file.size > maxSize) {
                invalidFiles.push(file.name + " : kích thước quá 1MB");
            } else {
                var fileExtension = file.name.split('.').pop().toLowerCase();
                if (validExtensions.indexOf(fileExtension) === -1) {
                    invalidFiles.push(file.name + " : file không hợp lệ");
                } else {
                    validFiles.push(file);
                }
            }
        }

        for (var j = 0; j < validFiles.length; j++) {
            var reader = new FileReader();
            reader.onload = function(event) {
                var imgSrc = event.target.result;
                var imgItem = $("<div>").addClass("img-item");
                var imgElement = $("<img>").attr("src", imgSrc);
                imgElement.on("click", function() {
                    $(this).parent().remove();
                });

                imgItem.append(imgElement);
                imageList.append(imgItem);
            };
            reader.readAsDataURL(validFiles[j]);
        }

        if (invalidFiles.length > 0) {
            alert("Lỗi file:\n" + invalidFiles.join("\n"));
        }
    });

    $(".upload").click(function(e) {
        $(".files").click();
    });
});