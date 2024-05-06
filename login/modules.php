
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modules - BloomTech</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div id="modules-page">
        <center>
            <h2>Modules</h2>
            <div id="module-container">
            </div>
            <button id="addModuleBtn">Add Module</button>
        </center>
    </div>

    <script>
        $(document).ready(function() {
            function addModuleContainer() {
                var moduleCount = $("#module-container .module-container").length + 1;
                var newModuleHtml = `
                    <div class="module-container">
                        <label for="linkInput${moduleCount}">Module ${moduleCount}</label>
                        <input type="text" id="linkInput${moduleCount}" placeholder="Enter module URL">
                        <button type="button" class="previewBtn" data-link="#linkInput${moduleCount}" data-preview="#linkPreview${moduleCount}">Preview</button>
                        <button type="button" class="deleteModuleBtn">Delete</button>
                        <button type="button" class="closePreviewBtn" style="display: none;">Close Preview</button>
                        <iframe id="linkPreview${moduleCount}" style="display: none;"></iframe>
                    </div>
                `;
                $("#module-container").append(newModuleHtml);
            }

            $("#addModuleBtn").click(function() {
                addModuleContainer();
            });

            $("#module-container").on("click", ".deleteModuleBtn", function() {
                $(this).parent().remove();
            });

            $("#module-container").on("click", ".previewBtn", function() {
                var linkInput = $(this).data("link");
                var linkPreview = $(this).data("preview");
                var closePreviewBtn = $(this).siblings(".closePreviewBtn");
                var iframe = $(linkPreview);
                var url = $(linkInput).val();

                iframe.show();
                closePreviewBtn.show();
                iframe.attr("src", url);
            });

            $("#module-container").on("click", ".closePreviewBtn", function() {
                var linkPreview = $(this).siblings("iframe[id^='linkPreview']");
                linkPreview.hide();
                $(this).hide();
            });
        });
    </script>
</body>
</html>
