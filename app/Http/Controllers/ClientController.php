<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\client ;
use Validator;


class ClientController extends Controller
{

    protected function index()
    {
        $client = client::orderBy('id','asc')->paginate(10);
        return view('clients.index' ,compact('client'));
    }

    public function getall(){
        $client = client::all();
        if ($client == null) {
          return response()->json([
                  'message'  => "Aucun client(s) trouvé(s)!",
            ], 422);
       } else{
          return response()->json($client, 201);
      }
    }
    
 public function show($id)
 {
     $client = client::find($id);
     if ($client == null) {
         return response()->json([
                 'message'  => "client dont l'id :".$id." est introuvable!",
         ], 422);
     } else{
         return response()->json([
             'client'  => $client,
         ], 200);
     }
 }
public function store(Request $request)
{
$validator = Validator::make($request->all(), [ 
  'photos' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
  'nom' => 'required',
  'email' => 'required|email',
]);
if ($validator->fails()) {   
   return response()->json(['error'=>$validator->errors()], 401);     
  }
else{
  $photos = time().'.'.$request->photos->extension();  
  $request->photos->move(public_path('images'), $photos);
  $input = array(
     'photos' =>  'images\\'.$photos,
      'nom' => $request->nom,
      'prenom' => $request->prenom,
      'email' => $request->email,
      'telepohne' => $request->telepohne,
      'ville' => $request->ville,
      'adress' => $request->adress
  );
  $client = client::create($input);
  return response()->json([
      'message' =>'client bien ajouté',
      'client'  => $client,
  ], 200);
}
}

public function update(Request $request, $id)
{
    $client = client::find($id);
    if ($client == null) {
        return response()->json([
            'message'  => "client dont l'id :".$id." est introuvable!",
          ], 422);
     } else{
        $validator = Validator::make($request->all(), [ 
            'photos' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'nom' => 'required',
            'email' => 'required|email',
        ]);
         if ($validator->fails()) {   
             return response()->json(['error'=>$validator->errors()], 401);     
            }
        else{
            $photos = time().'.'.$request->photos->extension();  
            $request->photos->move(public_path('images'), $photos);
            
            
                $input = array(
                    'photos' =>  'images\\'.$photos,
                     'nom' => $request->nom,
                     'prenom' => $request->prenom,
                     'email' => $request->email,
                     'telepohne' => $request->telepohne,
                     'ville' => $request->ville,
                     'adress' => $request->adress
                 );

                $client->update($input);
                return response()->json([
                    'message' =>'client bien modifié',
                    'client'  => $client,
                ], 200);
            }
    }
}
}
