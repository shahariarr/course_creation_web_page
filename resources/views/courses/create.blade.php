<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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
    <script src="{{ asset('js/course-form.js') }}"></script>
</body>
</html>
