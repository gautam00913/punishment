<?php

namespace App\Console\Commands;

use App\Models\Administration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class RegisterAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:register-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save in the database the first admin of the website';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line('Creating user ...');
        
        $admin = Administration::where('role', 'Directeur')->first();
        if($admin)
        {
            $this->error('Admin user already registered with the matricule '. $admin->user->matricule);
        }
        else
        {
            $admin = Administration::create([
                'role' => 'Directeur'
            ]);
            $password = 'admin@admin' ;
            $user = $admin->user()->create([
                'matricule' => 'dir'. date('mY'),
                'firstname' => 'admin',
                'lastname' => 'ADMIN',
                'gender' => 'M',
                'age' => date('Y'),
                'password' => Hash::make($password),
            ]);
    
            $this->info('Admin User created successfully');
            $this->newLine();
            $this->info('Matricule : '. $user->matricule);
            $this->info('Password : '. $password);
        }
        return 1;
    }
}
