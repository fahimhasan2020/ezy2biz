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
}
