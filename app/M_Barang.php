<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_Barang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'barang';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id','nm_brg','hrg_jual','stock','foto'];

    static function cek_barang($nm_brg){
        $cek = DB::table('barang')
                ->select('*')
                ->where('nm_brg', $nm_brg)
                ->count();
        return $cek;
    }

    static function getData(){
        $data = DB::table('barang')
                ->select('id','nm_brg','hrg_jual','stock','foto')
                ->orderBy('nm_brg','ASC')
                ->get();
        return $data;
    }

    static function deleteData($id)
    {
        $data = DB::table('barang')
                ->where('id',$id)
                ->delete();
        return $data;
    }
}
