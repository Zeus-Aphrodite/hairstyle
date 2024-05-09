<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Haircut;
use App\Models\HaircutPack;
use Illuminate\Http\Request;

class HaircutsController extends Controller
{
    public function index()
    {
        $haircutsPaginator = Haircut::notPacked()->orderBy('created_at', 'desc')->paginate(20);
        $isForPackedHaircuts = false;
        if ($this->isForPackedHaircuts()) {
            $isForPackedHaircuts = true;
            $haircutsPaginator = Haircut::packed()->orderBy('created_at', 'desc')->paginate(20);
        }
        return \view('admin.haircuts.index', [
            'haircuts' => $haircutsPaginator,
            'isForPackedHaircuts' => $isForPackedHaircuts,
        ]);
    }

    public function create()
    {
        return \view('admin.haircuts.create', [
            'availablePacks' => HaircutPack::pluck('name', 'id'),
            'isPackedHaircut' => $this->isForPackedHaircuts(),
        ]);
    }

    public function edit(Haircut $haircut)
    {
        return \view('admin.haircuts.create', [
            'haircut' => $haircut,
            'availablePacks' => HaircutPack::pluck('name', 'id'),
            'isPackedHaircut' => $this->isForPackedHaircuts(),
        ]);
    }

    public function update(Request $request, Haircut $haircut)
    {
        $this->createOrUpdateHaircut($request, $haircut);
        \Session::flash('success', 'Haircut was successfully updated!');
        $routeName = $this->isForPackedHaircuts() ? 'admin.packed-haircuts.index' : 'admin.haircuts.index';
        return \redirect()->route($routeName);
    }

    public function store(Request $request)
    {
        $this->createOrUpdateHaircut($request, new Haircut);
        \Session::flash('success', 'Haircut was successfully created!');
        $routeName = $this->isForPackedHaircuts() ? 'admin.packed-haircuts.index' : 'admin.haircuts.index';
        return \redirect()->route($routeName);
    }

    public function delete(Haircut $haircut)
    {
        $haircut->delete();
        \Session::flash('success', 'Haircut was successfully deleted!');
        return \back();
    }

    private function createOrUpdateHaircut(Request $request, Haircut $haircut)
    {
        // FIXME move this service class someday
        $haircut->name = (string)$request->get('name');
        $haircut->type = (string)$request->get('type') ?: 'long';
        $haircut->wig_cloudinary_id = (string)$request->get('wig_image');
        $haircut->preview_cloudinary_id = (string)$request->get('preview_image');
        $haircut->description = (string)$request->get('description');
        $haircut->is_free = $request->has('is_free');
        $haircut->haircut_pack_id = $request->get('pack') ?: null;
        $haircut->save();
    }

    private function isForPackedHaircuts(): bool
    {
        return \Route::is('admin.packed-haircuts*');
    }
}
