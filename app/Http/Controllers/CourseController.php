<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with(['instances.cohort'])->get();

        $courses->transform(function($course) {
            $learner_count = $course->instances->flatMap(function($instance) {
                return $instance->cohort->learners;
            })->unique('id')->count();

            return [
                'id' => $course->id,
                'name' => $course->name,
                'learner_count' => $learner_count,
            ];
        });

        $courses = $courses->sortByDesc('learner_count');

        // $courses = DB::table('courses')
        // ->join('instances', 'instances.course_id', '=', 'courses.id')
        // ->join('cohorts', 'cohorts.id', '=', 'instances.cohort_id')
        // ->select('courses.*', DB::raw('COUNT(learners.id) as learner_count'))
        // ->leftJoin('learners', 'learners.cohort_id', '=', 'cohorts.id')
        // ->groupBy('courses.id')
        // ->paginate(10);

       return Inertia::render('Admin/Courses/Courses', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Courses/CourseCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        Course::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('courses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);

        $instances = $course->instances()->with(['cohort' => function($query) {
            $query->select('id', 'name')
                ->withCount('learners');
        }])
        ->get();

        return Inertia::render('Admin/Courses/CourseShow', compact('course', 'instances'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
       return Inertia::render('Admin/Courses/CourseEdit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $course->update([
            'name'=> $request->name
        ]);

        return redirect()->route('courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses');
    }
}
