<?php

namespace App\Http\Controllers;

use App\Model\Bulletin;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    public function addBulletin(Request $request, Bulletin $bulletin)
    {
        $publisherId = $request->session()->get('admin');
        if ($bulletin->add($request->request, $publisherId)) {

            $request->session()->flash('s', 'Bulletin was successfully added');
            return redirect('/a/bulletins?page=1');
        }

        $request->session()->flash('e', 'Sorry! Bulletin could not be added');
        return redirect()->back();
    }

    public function editBulletin($bulletinId, Request $request, Bulletin $bulletin)
    {
        if ($bulletin->edit($request->request, $bulletinId)) {

            $request->session()->flash('s', 'Bulletin was successfully updated');
            return redirect('/a/bulletins?page=1');
        }

        $request->session()->flash('e', 'Sorry! Bulletin could not be updated');
        return redirect()->back();
    }

    public function deleteBulletin(Request $request, Bulletin $bulletin)
    {
        if ($bulletin->remove($request->get('id'))) {

            $request->session()->flash('s', 'Bulletin was successfully removed');
            return redirect('/a/bulletins?page=1');
        }

        $request->session()->flash('e', 'Sorry! Bulletin could not be deleted');
        return redirect()->back();
    }

    public function adminAllBulletins(Request $request, Bulletin $bulletin)
    {
        if (!$request->get('page') || !(int) $request->get('page')) {
            return redirect('/a/bulletins?page=1');
        } else {
            $curPage = (int) $request->get('page');
        }

        $count = $bulletin->countTotal();
        $perPage = 10;
        $totalPages = ceil($count / $perPage);
        $offset = $perPage * ($curPage - 1);

        if (1 <= $curPage - 1) {
            $prevPage = $curPage - 1;
        } else {
            $prevPage = null;
        }

        if ($curPage + 1 <= $totalPages) {
            $nexPage = $curPage + 1;
        } else {
            $nexPage = null;
        }

        $bulletins = $bulletin->paginate($perPage, $offset)->all();

        return view('admin.all-bulletins')
            ->with('bulletins', $bulletins)
            ->with('totalPages', $totalPages)
            ->with('curPage', $curPage)
            ->with('prevPage', $prevPage)
            ->with('nextPage', $nexPage);
    }

    public function getBulletin($bulletinId, Bulletin $bulletin)
    {
        $query = $bulletin->get($bulletinId);
        return view('admin.edit-bulletin')->with('bulletin', $query);
    }

    public function userAllBulletins(Request $request, Bulletin $bulletin)
    {
        if (!$request->get('page') || !(int) $request->get('page')) {
            return redirect('/bulletins?page=1');
        } else {
            $curPage = (int) $request->get('page');
        }

        $count = $bulletin->countTotal();
        $perPage = 5;
        $totalPages = ceil($count / $perPage);
        $offset = $perPage * ($curPage - 1);

        if (1 <= $curPage - 1) {
            $prevPage = $curPage - 1;
        } else {
            $prevPage = null;
        }

        if ($curPage + 1 <= $totalPages) {
            $nextPage = $curPage + 1;
        } else {
            $nextPage = null;
        }

        $bulletins = $bulletin->paginate($perPage, $offset)->all();

        return view('bulletin.all')
            ->with('bulletins', $bulletins)
            ->with('totalPages', $totalPages)
            ->with('prevPage', $prevPage)
            ->with('nextPage', $nextPage);
    }

    public function userSingleBulletin($bulletinId, Bulletin $bulletin)
    {
        $bulletin = $bulletin->getSingle($bulletinId);
        return view('bulletin.single')->with('bulletin', $bulletin);
    }
}
