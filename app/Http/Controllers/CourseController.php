<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
            'modules' => 'required|array',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.contents' => 'required|array',
            'modules.*.contents.*.type' => 'required|string|in:text,image,video,link',
            'modules.*.contents.*.content_data' => 'required_unless:modules.*.contents.*.type,image',
            'module_images.*.*' => 'required_if:modules.*.contents.*.type,image|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $course = Course::create([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
            ]);

            $courseImagesPath = 'course_images/' . $course->id;
            if (!file_exists(public_path($courseImagesPath))) {
                mkdir(public_path($courseImagesPath), 0777, true);
            }

            // Process each module
            foreach ($request->modules as $moduleIndex => $moduleData) {
                $module = $course->modules()->create([
                    'title' => $moduleData['title'],
                ]);

                foreach ($moduleData['contents'] as $contentIndex => $contentData) {
                    $contentType = $contentData['type'];
                    $contentDataValue = $contentData['content_data'];

                    if ($contentType === 'image' && isset($request->module_images[$moduleIndex][$contentIndex])) {
                        $image = $request->module_images[$moduleIndex][$contentIndex];
                        $imageName = time() . '_' . $moduleIndex . '_' . $contentIndex . '.' . $image->extension();
                        $image->move(public_path($courseImagesPath), $imageName);
                        $contentDataValue = $courseImagesPath . '/' . $imageName;
                    }

                    $module->contents()->create([
                        'type' => $contentType,
                        'content_data' => $contentDataValue,
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Course created successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}

