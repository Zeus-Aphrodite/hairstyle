<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHairstylePacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('haircut_packs', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name');
//            $table->boolean('is_paid');
//            $table->timestamps();
//        });
//
//        Schema::table('haircuts', function (Blueprint $table) {
//            $table->unsignedInteger('haircut_pack_id')->nullable()->after('id');
//            $table->foreign('haircut_pack_id')
//                ->references('id')
//                ->on('haircut_packs')
//                ->onUpdate('CASCADE')
//                ->onDelete('SET NULL');
//        });
        \App\Models\HaircutPack::create([
            'name' => 'Free',
            'is_paid' => false,
        ]);
        \App\Models\HaircutPack::create([
            'name' => 'Celebrity',
            'is_paid' => true,
        ]);
        \App\Models\HaircutPack::create([
            'name' => 'Latest',
            'is_paid' => true,
        ]);
        \App\Models\HaircutPack::create([
            'name' => 'Alternative',
            'is_paid' => true,
        ]);
        \App\Models\HaircutPack::create([
            'name' => 'Most popular',
            'is_paid' => true,
        ]);


        $this->createHaircutsForType('free', 1, 30);
        $this->createHaircutsForType('celebrity', 2, 45);
        $this->createHaircutsForType('latest', 3, 51);
        $this->createHaircutsForType('alternative', 4, 52);
        $this->createHaircutsForType('most_popular', 5, 45);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('haircuts', function (Blueprint $table) {
            $table->dropForeign(['haircut_pack_id']);
            $table->dropColumn('haircut_pack_id');
        });
        Schema::drop('haircut_packs');
    }

    private function createHaircutsForType(string $type, int $packId, int $range)
    {
        $cloudinaryImageId = $type;
        if ($type === 'most_popular') {
            $cloudinaryImageId = 'popular';
        }
        foreach (range(1, $range) as $index) {
            \App\Models\Haircut::create([
                'name' => 'Packed Haircut ' . $index,
                'type' => 'long',
                'haircut_pack_id' => $packId,
                'wig_cloudinary_id' => 'haircuts/' . $type . '/' . 'wigs/' . $index . '-' . $cloudinaryImageId,
                'preview_cloudinary_id' => 'haircuts/' . $type . '/' . 'thumb/' . $index . '-' . $cloudinaryImageId . '-3',
            ]);
        }
    }
}
