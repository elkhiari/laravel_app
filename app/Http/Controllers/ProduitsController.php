<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produits;
use validate;

class ProduitsController extends Controller
{
    protected function index()
    {
        $Produit = Produits::orderBy('id','asc')->paginate(10);
        return view('produits.index' ,compact('Produit'));
    }
    protected function create()
    {
        return view('produits.create');
    }
    protected function store(Request $req)
    {
        $req->validate([
            'ref'=>'required',
            'libelle'=>'required',
            'prix'=>'required',
            'qtedispo'=>'required',
            'description'=>'required',
            'code'=>'required'
        ]);
        produits::create($req->post());
        return redirect()->route('produits.index')->with('success','Produits bien ajoutée!.');;
    }
    public function edit(Produits $produit)
    {
        return view('produits.edit',compact('produit'));
    }
    public function update(Request $req, Produits $produit)
    {
        $req->validate([
            'ref'=>'required',
            'libelle'=>'required',
            'prix'=>'required',
            'qtedispo'=>'required',
            'description'=>'required',
            'code'=>'required'
        ]);
        
        $produit->fill($req->post())->save();

        return redirect()->route('produits.index')->with('success','produit bien modifiée!');
    }
    public function destroy(Produits $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success','Produit bien supprimée!');
    }


}
