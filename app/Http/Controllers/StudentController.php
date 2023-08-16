<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\SchoolYear;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StudentRequest;
use App\Models\Tutor;
use App\Notifications\SendCredentials;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index', ['students' => Student::with(['user', 'tutor', 'classes'])->paginate(10)]);
    }

    public function form(Request $request, $action)
    {
        $this->authorize('administration');
        $student = $request->query('student') ? Student::find($request->query('student')) : new Student();
        $classes = ClassRoom::all();
        $tutors = Tutor::all();
        return view('students.form', compact('action', 'student', 'tutors', 'classes'));
    }

    public function store(StudentRequest $request)
    {
        $student = Student::create([
            'tutor_id' => $request->tutor_id,
        ]);
        $picture = null;
        if($request->file('picture'))
        {
            $picture = $request->file('picture')->store('public/pictures');
        }
        if($request->class)
        {
            $school_year = SchoolYear::firstOrCreate(['value' => config('app.school_year')]);
            $student->classes()->attach($request->class, ['school_year' => $school_year->value]);
        }
        $password = Str::random(8);
        $user = $student->user()->create([
            'matricule' => $request->matricule,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'age' => $request->age,
            'email' => $request->email,
            'phone' => $request->phone,
            'picture' => $picture,
            'password' => Hash::make($password),
        ]);

        //send credentials to user
        if($user->email || $user->phone)
        {
            $user->notify(new SendCredentials($user->matricule, $password, 'Elève'));
        }

        if($student && $user)
        {
            session()->flash('toast', [
                'type' => 'success',
                'message' => "Elève $user->name créé avec succès"
            ]);
            return response()->json(['success' => $student]);
        }
        dd($student && $user, $student, $user);
        return null;
    }
    
    public function update(StudentRequest $request, Student $student)
    {
        $updated1 = $student->update([
            'tutor_id' => $request->tutor_id,
        ]);
        $picture = null;
        if($request->file('picture'))
        {
            $picture = $request->file('picture')->store('public/pictures');
        }
        if($request->class)
        {
            if(!$student->classes->pluck('id')->contains($request->class))
            {
                $school_year = SchoolYear::firstOrCreate(['value' => config('app.school_year')]);
                $student->classes()->attach($request->class, ['school_year' => $school_year->value]);
            }
        }
        $updated2 = $student->user()->update([
            'matricule' => $request->matricule,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'age' => $request->age,
            'email' => $request->email,
            'phone' => $request->phone,
            'picture' => $picture,
        ]);

        if($updated1 && $updated2)
        {
            session()->flash('toast', [
               'type' => 'success',
               'message' => "Elève modifié avec succès"
           ]);
            return response()->json(['success' => $updated1]);
        }
            
        return null;
    }

    public function status(Student $student)
    {
        $this->authorize('administration');
        $status = $student->user->active ? 0 : 1;
        $changed = $student->user()->update(['active' => $status]);
        if($changed)
            return back()->with('toast', [
                'type' => 'success',
                'message' => $status ? "Elève activé avec succès" : "Elève désactivé avec succès"
            ]);
        
        return back();
    }

    public function createClass(Student $student)
    {
        $this->authorize('administration');
        $classes = ClassRoom::all();
        return view('students.classes', compact('student', 'classes'));
    }

    public function associateClass(Request $request, Student $student)
    {
        $this->authorize('administration');
        if(!$student->classes->pluck('id')->contains($request->class))
        {
            $school_year = SchoolYear::firstOrCreate(['value' => config('app.school_year')]);
            $student->classes()->attach($request->class, ['school_year' => $school_year->value]);
            return back()->with('toast', [
                'type' => 'success',
                'message' => "Attribution de classe éffectuée avec succès"
            ]);
        }

        return back();
    }
}
