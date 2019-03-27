<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\ParameterBag;

class Bulletin extends Model
{
    public function add(ParameterBag $bulletinData, $publisherId)
    {
        return
            DB::table('bulletins')
                ->insert([
                   'title'          => $bulletinData->get('title'),
                   'description'    => $bulletinData->get('description'),
                   'publish_date'   => date('Y-m-d'),
                   'publisher_id'   => $publisherId
                ]);
    }

    public function edit(ParameterBag $bulletinData, $bulletinId)
    {
        return
            DB::table('bulletins')
                ->where('id', '=', $bulletinId)
                ->update([
                    'title'         => $bulletinData->get('title'),
                    'description'   => $bulletinData->get('description')
                ]);
    }

    public function remove($bulletinId)
    {
        return
            DB::table('bulletins')
                ->where('id', '=', $bulletinId)
                ->delete();
    }

    public function getAll()
    {
        return
            DB::table('bulletins')
                ->join('admins', 'bulletins.publisher_id', '=', 'admins.id')
                ->select('bulletins.*', 'admins.first_name', 'admins.last_name')
                ->get();
    }

    public function get($bulletinId)
    {
        return
            DB::table('bulletins')
                ->select('id', 'title', 'description')
                ->where('id', '=', $bulletinId)
                ->first();
    }

    public function getSingle($bulletinId)
    {
        return
            DB::table('bulletins')
                ->join('admins', 'bulletins.publisher_id', '=', 'admins.id')
                ->select('bulletins.*', 'admins.first_name', 'admins.last_name')
                ->where('bulletins.id', '=', $bulletinId)
                ->first();
    }

    public function countTotal()
    {
        return DB::table('bulletins')->select('id')->count();
    }

    public function paginate($limit, $offset)
    {
        return
            DB::table('bulletins')
                ->join('admins', 'bulletins.publisher_id', '=', 'admins.id')
                ->select('bulletins.*', 'admins.first_name', 'admins.last_name')
                ->limit($limit)
                ->offset($offset)
                ->get();
    }

    public function getLatest()
    {
        return DB::table('bulletins')
            ->select('id', 'title')
            ->orderBy('publish_date', 'desc')
            ->limit(5)
            ->get();
    }
}
