<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use PDF;

class StudentController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = Student::with(['media'])->get();

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.students.create');
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());

        if ($request->input('photo', false)) {
            
            $student->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $student->id]);
        }

        return redirect()->route('admin.students.index');
    }

    public function edit(Student $student)
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());

        if ($request->input('photo', false)) {
            if (! $student->photo || $request->input('photo') !== $student->photo->file_name) {
                if ($student->photo) {
                    $student->photo->delete();
                }
                $student->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($student->photo) {
            $student->photo->delete();
        }

        return redirect()->route('admin.students.index');
    }

    
    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.students.show', compact('student'));
    }
    public function showHallTicket(Request $request, string $id)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       ;
        //dd($id);
        $student = Student::findOrFail($id);
       
        $rollno_formatted = substr_replace($student->roll_number, " ", 4, 0);
        $rollno_formatted = substr_replace($rollno_formatted, " ", 7, 0);
        $rollno_formatted = substr_replace($rollno_formatted, " ", 10, 0);
  
  
        $pdf = PDF::loadView('frontend.hallTickets.show', compact('student', 'rollno_formatted'));
                   
        return $pdf->stream( $student->roll_number . '_hallticket.pdf');
        
    }
    public function destroy(Student $student)
    {
        abort_if(Gate::denies('student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentRequest $request)
    {
        $students = Student::find(request('ids'));

        foreach ($students as $student) {
            $student->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Student();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function uploadPhotos(Request $request)
    {
       /*  $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]); */
        $path = storage_path('app/public');
       // dd($request);

       if($files = $request->file('images')){
          
            foreach($files as $file) {
              
                $name = trim($file->getClientOriginalName());
                $name = str_replace(' ', '', $name);
                $file->move($path, $name);
              //$file->storeAs($path, $name); 
            }
        }
       
        return redirect()->back()->with('message', 'Image(s) successfully uploaded.');;

    }

}
