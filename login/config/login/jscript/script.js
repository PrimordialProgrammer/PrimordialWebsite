document.addEventListener('DOMContentLoaded', function () {

    setTimeout(function () {
        document.getElementById('error_notif').style.display = 'none';
    }, 5000);
});
$(document).ready(function() {
    $(".previewBtn").click(function() {
        var linkInput = $(this).data("link");
        var linkPreview = $(this).data("preview");
        var url = $(linkInput).val();

        $(linkPreview).html("Loading...");
        $.get(url, function(data) {

            $(linkPreview).html(data);
        });
    });
});