<?php use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = 'test@test.com';
        \App\Models\Admin::create([
            'name' => 'Admin',
            'password' => \bcrypt($email),
            'email' => $email,
        ]);
    }
}
