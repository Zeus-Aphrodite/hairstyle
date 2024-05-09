<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class HomepageController extends Controller
{
    public function index()
    {
        return \redirect(\route('admin.homepage'));
    }

   function clear($custom_command = null)
    {
        if ($custom_command){
            Artisan::call($custom_command);
        }
        else{
            //  Artisan::call('cache:clear');
            // Artisan::call('config:clear');
            //  Artisan::call('config:cache');
            Artisan::call('route:cache');
            //    Artisan::call('view:clear');
        }
        return "Cleared!";

    }

}
