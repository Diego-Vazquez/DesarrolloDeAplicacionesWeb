<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Nft;
use Hash;

class ProductosController extends Controller
{
    public function __construct()
    {
        //verificar si esta logeado
        $this->middleware('auth');
    }
    
    public function miFuncion(){
        $categorias = \DB::table('categories')->get();
        $productos = \DB::table('nfts')->orderBy('id','DESC')->get();
        //dd($categorias);
        return view('dash.productos')
        ->with('nfts',$productos)
        ->with('categorias',$categorias);
    }

    public function insertar(Request $req){
        //dd($req->name);
        $validacion = Validator::make($req->all(),[
            'name'=>'required|min:4|max:100',
            'description'=>'required|min:5',
            'price'=>'required',
            'img'=>'required|mimes:jpg,jpeg,png,webp|max:2000',
            'btype'=>'required',
            'cate'=>'required'
        ]);
        if($validacion->fails()){
            return back()->withInput()->with('ErrorInsert',"llena todo")->withErrors($validacion);
        }else{
            //echo "si furulo";
            $ti = Hash::make(rand(0,9999999999));
            $ts = Hash::make(rand(0,9999999999));
            $imagen = $req->file('img');
            $name = time(). '.' .$imagen->getClientOriginalExtension();
            $destination_path = public_path('nfts');
            $req->img->move($destination_path,$name);
            $nuevo = Nft::create([
                'name'=>$req->name,
                'description'=>$req->description,
                'base_price'=>$req->price,
                'img'=>$name,
                'blockchain_type'=>$req->btype,
                'id_category'=>$req->cate,
                'token_id'=>$ti,
                'token_standar'=>$ts,
                'metadata'=>'',
                'id_user'=>1,
                'likes'=>0
            ]);
            return back()->with('listo','se ha insertado correctamente');
        }
    }
}
