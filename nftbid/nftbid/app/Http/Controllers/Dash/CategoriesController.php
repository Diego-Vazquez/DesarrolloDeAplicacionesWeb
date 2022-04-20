<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Category;
use File;
class CategoriesController extends Controller
{
    public function __construct()
    {
        //verificar si esta logeado
        $this->middleware('auth');
    }

    //
    public function index(){
        $cates = \DB::table('categories')->get();
        return view('dash.categories')->with('cates',$cates);
    }

    public function store(Request $req){
        $validacion = Validator::make($req->all(),[
            'name'=>'required|min:4|max:100',
            'img'=>'required|mimes:jpg,jpeg,png,webp|max:2000'
        ]);
        if($validacion->fails()){
            return back()->withInput()->with('ErrorInsert',"llena todo")->withErrors($validacion);
        }else{
            $imagen = $req->file('img');
            $name = time(). '.' .$imagen->getClientOriginalExtension();
            $destination_path = public_path('categories');
            $req->img->move($destination_path,$name);
            Category::create([
                'category'=>$req->name,
                'img'=>$name
            ]);
            return back()->with('listo','se ha insertado correctamente');
        }
    }

    public function destroy($id){
        $categoria = Category::find($id);
        if($categoria->img != 'default.jpg'){
            if(File::exists(public_path('categories/'.$categoria->img))){
                unlink(public_path('categories/'.$categoria->img));
            }
        }
        $categoria -> delete();
        return back()->with('Listo','El registro se elimino correctamente');
    }

    public function update(Request $req){
        $validacion = Validator::make($req->all(),[
            'name'=>'required|min:4|max:100',
            //'img'=>'required|mimes:jpg,jpeg,png,webp|max:2000'
        ]);
        if($validacion->fails()){
            return back()->withInput()->with('ErrorInsert',"llena todo")->withErrors($validacion);
        }else{
            $validation2 = Validator::make($req->all(),[
                'img'=>'required|mimes:jpg,jpeg,png,webp|max:2000'
            ]);
            $registro = Category::find($req->idEdit);
            if($validation2->fails()){
                $registro->category = $req->name;
                $registro->save();
            }else{
                if($registro->img != 'default.jpg'){
                    if(File::exists(public_path('categories/'.$registro->img))){
                        unlink(public_path('categories/'.$registro->img));
                    }
                }
                $imagen = $req->file('img');
                $name = time(). '.' .$imagen->getClientOriginalExtension();
                $destination_path = public_path('categories');
                $req->img->move($destination_path,$name);
                $registro->category = $req->name;
                $registro->img = $name;
                $registro->save();
            }
            return back()->with('listo','se ha actualizado correctamente');
        }
    }
}
