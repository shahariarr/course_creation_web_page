<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --light: #f8f9fa;
            --dark: #212529;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-800: #343a40;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7ff;
            color: var(--gray-800);
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 25px 0;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header h1 {
            font-weight: 600;
            margin: 0;
            font-size: 28px;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--gray-800);
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: border 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        .btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #e01e72;
            transform: translateY(-1px);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .module-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .module-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .module-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .content-item {
            background-color: var(--gray-100);
            border-radius: 6px;
            padding: 15px;
            margin: 10px 0;
            border-left: 3px solid var(--success);
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .content-body {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 15px;
            align-items: center;
        }

        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .divider {
            height: 1px;
            background-color: var(--gray-200);
            margin: 25px 0;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .content-body {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-graduation-cap"></i> Create New Course</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="form-group">
                    <label for="title"><i class="fas fa-heading"></i> Course Title</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description"><i class="fas fa-align-left"></i> Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="category"><i class="fas fa-tag"></i> Category</label>
                    <select id="category" name="category" class="form-control">
                        <option value="" selected disabled>Select a category</option>
                        <option value="development">Web Development</option>
                        <option value="mobile">Mobile Development</option>
                        <option value="programming">Programming Languages</option>
                        <option value="database">Database Design</option>
                        <option value="design">Graphic Design</option>
                        <option value="marketing">Digital Marketing</option>
                        <option value="business">Business</option>
                        <option value="finance">Finance & Accounting</option>
                        <option value="it">IT & Software</option>
                        <option value="personal">Personal Development</option>
                        <option value="photography">Photography</option>
                        <option value="health">Health & Fitness</option>
                        <option value="music">Music</option>
                        <option value="teaching">Teaching & Academics</option>
                        <option value="data">Data Science</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <div class="divider"></div>
            <h3><i class="fas fa-book"></i> Course Modules</h3>
            <p class="text-muted">Add modules to structure your course content</p>

            <div id="modules-container"></div>

            <button type="button" class="btn btn-primary" id="add-module-btn">
                <i class="fas fa-plus-circle"></i> Add Module
            </button>

            <div class="divider"></div>
            <button type="submit" class="btn btn-primary" style="padding: 12px 30px;">
                <i class="fas fa-save"></i> Save Course
            </button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
    </script>
</body>
</html>
