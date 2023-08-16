<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\TutorRequest;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendCredentials;

class TutorController extends Controller
{
    public function index()
    {
        return view('tutors.index', ['tutors' => Tutor::with(['user'])->withCount('childreen')->paginate(10)]);
    }

    public function form(Request $request, $action)
    {
        $this->authorize('administration');
        $tutor = $request->query('tutor') ? Tutor::find($request->query('tutor')) : new Tutor();
        $students = Student::all();
        return view('tutors.form', compact('action', 'students', 'tutor'));
    }

    public function store(TutorRequest $request)
    {
        $tutor = Tutor::create([
            'address' => $request->address,
        ]);
        $picture = null;
        if($request->file('picture'))
        {
            $picture = $request->file('picture')->store('public/pictures');
        }
        if($request->students)
        {
            foreach($request->students as $student)
            {
                Student::where("id", $student)->update(['tutor_id' => $tutor->id]);
            }
        }
        $matricule = $request->email ?? Str::random(10);
        $password = Str::random(8);
        $user = $tutor->user()->create([
            'matricule' => $matricule,
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
            $user->notify(new SendCredentials($user->matricule, $password, 'Parent d\'élève'));
        }

        if($tutor && $user)
        {
            session()->flash('toast', [
                'type' => 'success',
                'message' => "Parent d'élève $user->name créé avec succès"
            ]);
            return response()->json(['success' => $tutor]);
        }
        dd($tutor && $user, $tutor, $user);
        return null;
    }
    
    public function update(TutorRequest $request, Tutor $tutor)
    {
        $updated1 = $tutor->update([
            'address' => $request->address,
        ]);
        $picture = null;
        if($request->file('picture'))
        {
            $picture = $request->file('picture')->store('public/pictures');
        }
        if($request->students)
        {
            foreach($request->students as $student)
            {
                Student::where("id", $student)->update(['tutor_id' => $tutor->id]);
            }
        }

        $updated2 = $tutor->user()->update([
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
               'message' => "Parent d'élève modifié avec succès"
           ]);
            return response()->json(['success' => $updated1]);
        }
            
        return null;
    }

    public function status(Tutor $tutor)
    {
        $this->authorize('administration');
        $status = $tutor->user->active ? 0 : 1;
        $changed = $tutor->user()->update(['active' => $status]);
        if($changed)
            return back()->with('toast', [
                'type' => 'success',
                'message' => $status ? "Parent d'élève activé avec succès" : "Parent d'élève désactivé avec succès"
            ]);
        
        return back();
    }

    public function createStudent($tutor)
    {
        $this->authorize('administration');
        $tutor = Tutor::with(['childreen', 'childreen.user'])->find($tutor);
        $students = Student::with('user')->whereNotIn('id', $tutor->childreen->pluck('id')->all())->get();
        return view('tutors.students', compact('tutor', 'students'));
    }

    public function associateStudent(Request $request, Tutor $tutor)
    {
        $this->authorize('administration');
        if($request->students)
        {
            foreach($request->students as $student)
            {
                Student::where("id", $student)->update(['tutor_id' => $tutor->id]);
            }
        }
     
        return back()->with('toast', [
            'type' => 'success',
            'message' => "Association d'élèves au parent éffectuée avec succès"
        ]);
    }
}
