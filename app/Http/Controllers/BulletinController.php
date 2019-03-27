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
