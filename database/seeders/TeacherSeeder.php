<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacher1 = Teacher::where('username' , 'jishan')->first() ?: new Teacher();
        $teacher1->username = 'jishan';
        $teacher1->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; //password
        $teacher1->save();

        $teacher2 = Teacher::where('username' , 'tailweb')->first() ?: new Teacher();
        $teacher2->username = 'tailweb';
        $teacher2->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; //password
        $teacher2->save();
    }
}
