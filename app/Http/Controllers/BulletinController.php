<?php

namespace App\Http\Controllers;

use App\Model\Bulletin;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    public function addBulletin(Request $request, Bulletin $bulletin)
    {
        $publisherId = $request->session()->get('admin');
        $bulletin->add($request->request, $publisherId);
        return redirect('/a/bulletins');
    }

    public function editBulletin($bulletinId, Request $request, Bulletin $bulletin)
    {
        $bulletin->edit($request->request, $bulletinId);
        return redirect('/a/bulletins');
    }

    public function deleteBulletin(Request $request, Bulletin $bulletin)
    {
        $bulletin->remove($request->get('id'));
        return redirect('/a/bulletins');
    }

    public function allBulletins(Bulletin $bulletin)
    {
        $bulletins = $bulletin->getAll();
        return view('admin.all-bulletins')->with('bulletins', $bulletins->all());
    }

    public function getBulletin($bulletinId, Bulletin $bulletin)
    {
        $query = $bulletin->get($bulletinId);
        return view('admin.edit-bulletin')->with('bulletin', $query);
    }
}
