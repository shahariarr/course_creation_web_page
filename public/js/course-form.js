$(document).ready(function () {
    var moduleIndex = 0;

    $('#add-module-btn').on('click', function () {
        var moduleHtml = `
            <div class="module-card" data-module-index="${moduleIndex}">
                <div class="module-header">
                    <div class="form-group" style="margin-bottom: 0; flex-grow: 1; margin-right: 15px;">
                        <label><i class="fas fa-folder"></i> Module Title</label>
                        <input type="text" name="modules[${moduleIndex}][title]" class="form-control" required>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-module">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>

                <div class="contents-container"></div>
                <button type="button" class="btn btn-primary btn-sm add-content-btn" style="margin-top: 15px">
                    <i class="fas fa-plus"></i> Add Content
                </button>
            </div>
        `;
        $('#modules-container').append(moduleHtml);
        moduleIndex++;
    });

    $('#modules-container').on('click', '.add-content-btn', function () {
        var moduleDiv = $(this).closest('.module-card');
        var moduleIdx = moduleDiv.data('module-index');
        var contentCount = moduleDiv.find('.content-item').length;

        var contentHtml = `
            <div class="content-item">
                <div class="content-header">
                    <h4>Content Item #${contentCount + 1}</h4>
                    <button type="button" class="btn btn-danger btn-sm remove-content">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="content-body">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label><i class="fas fa-file-alt"></i> Type</label>
                        <select name="modules[${moduleIdx}][contents][${contentCount}][type]" class="form-control content-type-select" required>
                            <option value="text">Text</option>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                            <option value="link">Link</option>
                        </select>
                    </div>
                    <div class="form-group content-data-container" style="margin-bottom: 0;">
                        <label><i class="fas fa-cube"></i> Content Data</label>
                        <textarea name="modules[${moduleIdx}][contents][${contentCount}][content_data]" class="form-control content-data" placeholder="Enter your text content here" rows="3" required></textarea>
                    </div>
                </div>
            </div>
        `;
        moduleDiv.find('.contents-container').append(contentHtml);
    });

    $('#modules-container').on('change', '.content-type-select', function() {
        var selectedType = $(this).val();
        var contentDataContainer = $(this).closest('.content-body').find('.content-data-container');
        var inputName = $(this).attr('name').replace('[type]', '[content_data]');
        var inputIndex = inputName.match(/\[contents\]\[(\d+)\]/)[1];
        var moduleIndex = $(this).closest('.module-card').data('module-index');

        contentDataContainer.html('');

        switch(selectedType) {
            case 'text':
                contentDataContainer.html(`
                    <label><i class="fas fa-paragraph"></i> Text Content</label>
                    <textarea name="${inputName}" class="form-control content-data" placeholder="Enter your text content here" rows="3" required></textarea>
                `);
                break;

            case 'image':
                contentDataContainer.html(`
                    <label><i class="fas fa-image"></i> Upload Image</label>
                    <input type="file" name="module_images[${moduleIndex}][${inputIndex}]" class="form-control content-data image-upload" accept="image/*" required>
                    <input type="hidden" name="${inputName}" value="">
                    <div class="image-preview-container" style="margin-top: 10px; display: none;">
                        <img src="" class="image-preview" style="max-width: 100%; max-height: 200px; border-radius: 5px; border: 1px solid var(--gray-300);">
                    </div>
                `);
                break;

            case 'video':
                contentDataContainer.html(`
                    <label><i class="fas fa-video"></i> Video URL</label>
                    <input type="url" name="${inputName}" class="form-control content-data" placeholder="Enter video URL (e.g., YouTube or Vimeo link)" required>
                `);
                break;

            case 'link':
                contentDataContainer.html(`
                    <label><i class="fas fa-link"></i> External Link</label>
                    <input type="url" name="${inputName}" class="form-control content-data" placeholder="Enter URL (e.g., https://example.com)" required>
                `);
                break;
        }
    });

    $('#modules-container').on('change', '.image-upload', function() {
        var file = this.files[0];
        var previewContainer = $(this).siblings('.image-preview-container');
        var previewImage = previewContainer.find('.image-preview');

        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                previewImage.attr('src', e.target.result);
                previewContainer.slideDown();
            }

            reader.readAsDataURL(file);
        } else {
            previewImage.attr('src', '');
            previewContainer.slideUp();
        }
    });

    $('#modules-container').on('click', '.remove-module', function () {
        $(this).closest('.module-card').slideUp(300, function() {
            $(this).remove();
        });
    });

    $('#modules-container').on('click', '.remove-content', function () {
        var contentItem = $(this).closest('.content-item');
        contentItem.find('.image-preview-container').slideUp();
        contentItem.find('.image-preview').attr('src', '');
        contentItem.slideUp(200, function() {
            $(this).remove();
        });
    });

    $('#add-module-btn').click();
});
