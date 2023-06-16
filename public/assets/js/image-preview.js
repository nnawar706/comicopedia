$(document).on("change", ".file-input", function () {
    var filesCount = $(this)[0].files.length;

    var textbox = $(this).prev();

    textbox.text("1 file selected");

    if (typeof FileReader != "undefined") {
        var dvPreview = $("#imagePreview");
        dvPreview.html("");
        $($(this)[0].files).each(function () {
            var file = $(this);
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = $("<img />");
                img.attr("style", "width: 150px; height:100px; padding: 10px");
                img.attr("src", e.target.result);
                dvPreview.append(img);
            };
            reader.readAsDataURL(file[0]);
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});