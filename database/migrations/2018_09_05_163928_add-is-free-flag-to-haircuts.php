<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsFreeFlagToHaircuts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $freeHaircutWigIds = [
            'long2',
            'long6',
            'long23',
            'long25',
            'long31',
            'long33',
            'medium7',
            'medium19',
            'medium22',
            'medium25',
            'medium27',
            'medium37',
            'short2',
            'short5',
            'short17',
            'short18',
            'short12',
            'short35',
        ];
        Schema::table('haircuts', function (Blueprint $table) {
            $table->boolean('is_free')->default(false)->after('description');
        });
        $haircuts = \App\Models\Haircut::all();
        foreach ($haircuts as $haircut) {
            /** @var \App\Models\Haircut $haircut */
            $type = \last(\explode('/', $haircut->wig_cloudinary_id));
            if (!\in_array($type, $freeHaircutWigIds)) {
                continue;
            }
            $haircut->update([
                'is_free' => true,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('haircuts', function (Blueprint $table) {
            $table->dropColumn('is_free');
        });
    }
}
