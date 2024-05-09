<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Haircut;
use App\Models\HaircutPack;
use App\Models\PackedHaircutSelection;
use App\Models\QuizAnswer;

class DashboardController extends Controller
{
    public function index()
    {
        $response = \Cache::rememberForever('dashboard', function () {
            $totalAnswersCount = QuizAnswer::count();
            $quiz2Options = [
                '11-14',
                '15-18',
                '19-22',
                '23-25',
                '26-29',
                '30-33',
                '34-37',
                '38-41',
                '42-45',
                '46-48',
                '49-52',
                'More than 52',
            ];
            $haircuts = Haircut::notPacked()->get();
            $renderedView = \view('admin.dashboard',[
                'totalAnswersCount' => $totalAnswersCount,
                'quiz2Options' => $quiz2Options,
                'haircuts' => $haircuts,
            ])->render();
            return str_replace(["\r\n", "\r", "\n", '\r\n', '\r','\n'], ' ', $renderedView);
        });
        return response($response);
    }

    public function selections()
    {
        return \view('admin.selections', [
            'packs' => HaircutPack::with('haircuts')->get(),
            'allSelectionsCount' => PackedHaircutSelection::pluck('count')->sum(),
        ]);
    }

    public function resetPackStats(HaircutPack $pack)
    {
        $pack->resetPickings();
        \Session::flash('success', 'Pickings were successfully reset!');
        return \back();
    }
}
