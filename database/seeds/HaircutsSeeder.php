<?php

use Illuminate\Database\Seeder;

class HaircutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createHaircutsForType('long');
        $this->createHaircutsForType('medium');
        $this->createHaircutsForType('short');
    }

    private function createHaircutsForType(string $type)
    {
        foreach (range(1, 40) as $index) {
            \App\Models\Haircut::create([
                'name' => 'Haircut ' . $index,
                'type' => $type,
                'wig_cloudinary_id' => 'haircuts/' . $type . '/' . $type . $index,
                'preview_cloudinary_id' => 'haircuts/' . $type . '/' . $type . $index . '-thumb',
            ]);
        }
    }
}
