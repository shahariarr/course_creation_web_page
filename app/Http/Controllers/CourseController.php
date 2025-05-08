<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'modules.*.contents.*.content_data' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $course = Course::create([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
            ]);

            foreach ($request->modules as $moduleData) {
                $module = $course->modules()->create([
                    'title' => $moduleData['title'],
                ]);

                foreach ($moduleData['contents'] as $contentData) {
                    $module->contents()->create([
                        'type' => $contentData['type'],
                        'content_data' => $contentData['content_data'],
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

