<?php use Illuminate\Database\Seeder;

class HaircutStylesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stylesMapping = [
            'long1' => 'Retro',
            'long21' => ' Long Bob',
            'long2' => 'Layered',
            'long22' => 'Curly',
            'long3' => 'Retro',
            'long23' => 'Curly',
            'long4' => ' Retro',
            'long24' => ' Wacky',
            'long5' => 'Layered',
            'long25' => 'Layered',
            'long6' => 'Layered',
            'long26' => 'Braid',
            'long7' => 'Curly',
            'long27' => 'Feathered',
            'long8' => 'Layered',
            'long28' => 'Layered',
            'long9' => 'Wacky',
            'long29' => 'Bangs and Fringes',
            'long10' => 'Wacky',
            'long30' => 'Wavy',
            'long11' => 'Long Bob',
            'long31' => 'Bangs and Fringes',
            'long12' => 'Bangs and Fringes',
            'long32' => 'Layered',
            'long13' => 'Layered',
            'long33' => 'Wacky',
            'long14' => ' Afro Textured',
            'long34' => ' Wavy',
            'long15' => 'Bangs and Fringes',
            'long35' => 'Bangs and Fringes',
            'long16' => 'Retro',
            'long36' => 'Wavy',
            'long17' => 'Wacky',
            'long37' => 'Retro',
            'long18' => ' Long Textured',
            'long38' => ' Wavy',
            'long19' => 'Wacky',
            'long39' => 'Bangs and Fringes',
            'long20' => 'Wacky',
            'long40' => 'Layered',
            'medium1' => '  Bob',
            'medium2' => '     Bob',
            'medium3' => ' Curly',
            'medium4' => '  Wacky',
            'medium5' => '     Retro',
            'medium6' => ' Retro',
            'medium7' => '     Curly',
            'medium8' => ' Layered',
            'medium9' => '     Wacky',
            'medium10' => ' Bob',
            'medium11' => '     Wacky',
            'medium12' => ' Bangs and Fringes',
            'medium13' => '     Updo',
            'medium14' => '    Layered',
            'medium15' => ' Curly',
            'medium16' => '     Wacky',
            'medium17' => ' updo',
            'medium18' => '  Curly',
            'medium19' => '     Retro',
            'medium20' => '  Layered',
            'medium21' => '  Layered',
            'medium22' => 'Wavy',
            'medium23' => '  Layered',
            'medium24' => 'Razor Cut',
            'medium25' => ' Bob',
            'medium26' => '  Choppy',
            'medium27' => 'Bob',
            'medium28' => '  Wacky',
            'medium29' => 'Choppy',
            'medium30' => ' Bangs and Fringes',
            'medium31' => '  Bangs and Fringes',
            'medium32' => 'Bob',
            'medium33' => '  Bob',
            'medium34' => 'Feathered',
            'medium35' => '  Bob',
            'medium36' => 'Layered',
            'medium37' => ' Choppy',
            'medium38' => '  Wacky',
            'medium39' => 'Bob',
            'medium40' => '   Wacky',

            'short1' => '   Pixie',
            'short21' => '      Short',

            'short2' => 'Razor Cut',
            'short22' => ' Pixie',

            'short3' => '   Pixie',
            'short23' => '      Short with Bangs',

            'short4' => 'updo',
            'short24' => ' Asymmetrical Pixie',

            'short5' => ' Asymmetrical Pixie',
            'short25' => '   Asymmetrical Short',

            'short6' => '   Short Bob',
            'short26' => '      Asymmetrical',
            'short' => '',
            'short7' => 'Razor Cut',
            'short8' => 'Pixie',
            'short27' => ' Updo',
            'short28' => '      Short Pixie',
            'short9' => 'Asymmetrical Pixie',
            'short29' => ' Informal short',
            'short10' => ' Short Layered',
            'short30' => '   Long Bangs',
            'short11' => '   Razor Cut',
            'short31' => '      Wacky',
            'short12' => 'Razor Cut',
            'short32' => ' Wacky',

            'short13' => '   Razor Cut',
            'short33' => '      Asymmetrical short',
            'short14' => 'Bob',
            'short34' => ' Updo',

            'short15' => '   Bangs',
            'short35' => '      Afro',

            'short16' => 'Pixie',
            'short36' => ' Afro',

            'short17' => ' Textured Short Hair',
            'short37' => '   Informal Bob',

            'short18' => '   Razor Cut',
            'short38' => '      Short Bob',

            'short19' => 'Long Bangs',
            'short39' => ' Updo',

            'short20' => '   Layered',
            'short40' => '      bangs styled to the top',
        ];
        $haircuts = \App\Models\Haircut::all();
        foreach ($haircuts as $haircut) {
            /** @var \App\Models\Haircut $haircut*/
            $type = \last(\explode('/', $haircut->wig_cloudinary_id));
            $haircut->description = \trim($stylesMapping[$type]);
            $haircut->save();
        }
    }
}
