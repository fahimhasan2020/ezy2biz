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

    public function adminAllBulletins(Bulletin $bulletin)
    {
        $bulletins = $bulletin->getAll();
        return view('admin.all-bulletins')->with('bulletins', $bulletins->all());
    }

    public function adminSingleBulletin($bulletinId, Bulletin $bulletin)
    {
        $bulletin = $bulletin->getSingle($bulletinId);
        return view('admin.single-bulletin')->with('bulletin', $bulletin);
    }

    public function getBulletin($bulletinId, Bulletin $bulletin)
    {
        $query = $bulletin->get($bulletinId);
        return view('admin.edit-bulletin')->with('bulletin', $query);
    }

    public function userAllBulletins(Bulletin $bulletin)
    {
        $bulletins = $bulletin->getAll();
        return view('bulletin.all')->with('bulletins', $bulletins->all());
    }

    public function userSingleBulletin($bulletinId, Bulletin $bulletin)
    {
        $bulletin = $bulletin->getSingle($bulletinId);
        return view('bulletin.single')->with('bulletin', $bulletin);
    }
}
