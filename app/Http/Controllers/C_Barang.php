<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\M_Barang;
use DataTables;
class C_Barang extends Controller
{
    public function save(Request $request){
        $nm_brg = $request->input('nm_brg');
        $hrg_jual = $request->input('hrg_jual');
        $stock = $request->input('stock');

        //Cek nama barang
        $cek = M_Barang::cek_barang($nm_brg);
        if($cek > 0 ){
            return Response::json(['msg' => 'exist'],200);
        }
        else{
            $image = $request->file('foto');
            $imageName = time().'.'.request()->foto->getClientOriginalExtension();
            $destinationPath = public_path('/gambar');
            $upload = $image->move($destinationPath, $imageName);
            if($upload){
                $save = new M_Barang;
                $save->id           = bcrypt(rand(100, 10000));
                $save->nm_brg       = $nm_brg;
                $save->hrg_jual     = $hrg_jual;
                $save->stock        = $stock;
                $save->foto         = $imageName;
                $save->save();
                return Response::json(['msg' => 'success'],200);
            }
            else{
                return Response::json(['msg' => 'error'],400);
            }
        }
    }

    public function createData(){

        $data = M_Barang::getData();
        return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
    }

    public function delete(Request $request){
        $delete = M_Barang::deleteData($request->input('id'));
        if($delete){
            return Response::json(['msg' => 'success'],200);
        }
        else{
            return Response::json(['msg' => 'success'],400);
        }
    }

    public function simpan_update(Request $request){

        $image = $request->file('foto1');
        $data = array();
        $imageName='';  $destinationPath='';
        if($image === null)
        {
            $data = array(
                'nm_brg'    => $request->input('nm_brg'),
                'hrg_jual'  => $request->input('hrg_jual'),
                'stock'     => $request->input('stock')
            );


            $update = M_Barang::where('id', trim($request->input('id')))->update($data);
            if($update){
                return Response::json(['msg' => 'success'],200);
            }
            else{
                return Response::json(['msg' => 'error'],400);
            }
        }
        else{
            $imageName = time().'.'.request()->foto1->getClientOriginalExtension();
            $destinationPath = public_path('/gambar');

            $data = array(
                'nm_brg'    => $request->input('nm_brg'),
                'hrg_jual'  => $request->input('hrg_jual'),
                'stock'     => $request->input('stock'),
                'foto'      => $imageName
            );

            $update = M_Barang::where('id', trim($request->input('id')))->update($data);

            if($update){
                $upload = $image->move($destinationPath, $imageName);
                return Response::json(['msg' => 'success'],200);
            }
            else{
                return Response::json(['msg' => 'error'],400);
            }
        }

    }
}
