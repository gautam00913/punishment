<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Matter;
use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Models\SchoolYear;
use App\Notifications\SendCredentials;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        return view('teachers.index', ['teachers' => Teacher::with(['user', 'matter', 'classes'])->paginate(10)]);
    }

    public function form(Request $request, $action)
    {
        $this->authorize('administration');
        $teacher = $request->query('teacher') ? Teacher::find($request->query('teacher')) : new Teacher();
        $matters = Matter::all();
        $classes = $teacher->classes;
        if($classes->isEmpty())
            $classes = ClassRoom::all();
            
        return view('teachers.form', compact('action', 'teacher', 'matters', 'classes'));
    }

    public function store(TeacherRequest $request)
    {
        $teacher = Teacher::create([
            'matter_id' => $request->matter_id,
            'grade' => $request->grade,
            'is_principal' => $request->boolean('is_principal'),
            'principal_at' => $request->principal_at
        ]);
        $picture = null;
        if($request->file('picture'))
        {
            $picture = $request->file('picture')->store('public/pictures');
        }
        if($request->principal_at)
        {
            $school_year = SchoolYear::firstOrCreate(['value' => config('app.school_year')]);
            $teacher->classes()->attach($request->principal_at, ['school_year' => $school_year->value]);
        }
        $password = Str::random(8);
        $user = $teacher->user()->create([
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
            $user->notify(new SendCredentials($user->matricule, $password, 'Enseignant'));
        }

        if($teacher && $user)
        {
            session()->flash('toast', [
                'type' => 'success',
                'message' => "Enseignant $user->name créé avec succès"
            ]);
            return response()->json(['success' => $teacher]);
        }
        dd($teacher && $user, $teacher, $user);
        return null;
    }
    
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $updated1 = $teacher->update([
            'matter_id' => $request->matter_id,
            'grade' => $request->grade,
            'is_principal' => $request->boolean('is_principal'),
            'principal_at' => $request->principal_at
        ]);
        $picture = null;
        if($request->file('picture'))
        {
            $picture = $request->file('picture')->store('public/pictures');
        }
        if($request->principal_at)
        {
            $school_year = SchoolYear::firstOrCreate(['value' => config('app.school_year')]);
            $teacher->classes()->attach($request->principal_at, ['school_year' => $school_year->value]);
        }
        $updated2 = $teacher->user()->update([
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
               'message' => "Enseignant modifié avec succès"
           ]);
            return response()->json(['success' => $updated1]);
        }
            
        return null;
    }

    public function status(Teacher $teacher)
    {
        $this->authorize('administration');
        $status = !$teacher->user->active;
        $changed = $teacher->user()->update(['active' => $status]);
        if($changed)
            return back()->with('toast', [
                'type' => 'success',
                'message' => $status ? "Enseignant activé avec succès" : "Enseignant désactivé avec succès"
            ]);
        
        return back();
    }

    public function createClass(Teacher $teacher)
    {
        $this->authorize('administration');
        $classes = ClassRoom::all();
        return view('teachers.classes', compact('teacher', 'classes'));
    }

    public function associateClass(Request $request, Teacher $teacher)
    {
        $this->authorize('administration');
        $school_year = SchoolYear::firstOrCreate(['value' => config('app.school_year')]);
        $response = $teacher->classes()->syncWithPivotValues($request->classes, ['school_year' => $school_year->value]);
        if(!in_array($teacher->principal_at, $request->classes))
            $teacher->update(['principal_at' => NULL]);

        if($response)
            return back()->with('toast', [
                'type' => 'success',
                'message' => "Attribution de classe éffectuée avec succès"
            ]);
        
        return back();
    }
}
