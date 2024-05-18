<?php

namespace App\Http\Controllers;
use App\Mail\VerificationMail;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\login;
use App\Models\mdpoublie;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
class registrecontroller extends Controller 

{
    public function register(){
    return view('login.register');}
    public function login(){
        return view('login.login');}
        public function oubli(){
            return view('login.oubli');}
            public function nouveau(){
                
                return view('login.nouveau');}
            
        public function mdpoublie(){
            return view('login.mdpoublie');}
        public function registerPost(Request $request)
        { 
            // Validation des données d'inscription
            $validator = Validator::make($request->all(), [
                'name' => 'required',
              
                'password' => 'required|confirmed', // Cette règle vérifie que password_confirmation correspond à password
            ], [
               
                'password.confirmed' => 'Les mots de passe ne correspondent pas.', // Message d'erreur personnalisé
            ]);
        
            $login = User::create([
                'name' => $request->input('name'),
                
                'password' => Hash::make($request->input('password')),
                
            ]);
    
            $userId = $login->id;

            return view('login.mdpoublie', compact('userId'))
           ;

        }
        
        public function mdpoubliePost(Request $request)
        { 
            // Validation des données d'inscription
            $validator = Validator::make($request->all(), [
                'mdpo' => 'required',
              
                'idu' => 'required',
            ]);
        
            $mdpoublie = mdpoublie::create([
                'motcle' => $request->input('mdpo'),
                
                'iduser' => $request->input('idu'),
                
            ]);
    
        
            return view('login.login')
           ;

        }
      
    public function loginPost(Request $request)
    {
        $credentials = [
            'name'=>$request->name,
            'password'=>$request->password,
        ];  
 
        if(Auth::attempt($credentials))
        {
           
            return redirect()->route('boutique.tbl');

        }
        return back()->with('error', 'erreur');
    }

    public function oublPost(Request $request)
    {
        // Validation des données de récupération de mot de passe
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cle' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Récupération de l'utilisateur basé sur le nom
        $user = User::where('name', $request->input('name'))->first();
        $userId = $user->id;
        if (!$user) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }
    
        // Vérification du mot-clé dans la table mdpoublie pour l'ID d'utilisateur correspondant
        $mdpOublie = mdpoublie::where('iduser', $user->id)
                                    ->where('motcle', $request->input('cle'))
                                    ->first();
    
        if (!$mdpOublie) {
            return redirect()->back()->with('error', 'La clé de récupération du mot de passe est incorrecte.');
        }
    
        
        return view('login.nouveau', compact('userId'));

    }

    public function npost(Request $request)
    {
        // Validation des données du formulaire de réinitialisation du mot de passe
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        
        $userId = $request->input('idu');
      
    
        $user = User::find($userId);
    
        if (!$user) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }
    
        // Mettez à jour le mot de passe de l'utilisateur avec le nouveau mot de passe saisi
        $user->password = Hash::make($request->input('password'));
        $user->save();
    
        // Redirection avec un message de succès
        return redirect()->route('login.login')->with('success', 'Mot de passe réinitialisé avec succès. Vous pouvez vous connecter avec votre nouveau mot de passe.');
    }
    
    
    public function privacy()
{
    return view('/login/privacy'); 
}
public function term()
{
    return view('/login/term'); 
}
public function logout()
{
    Auth::logout();
    return redirect()->route('login.login');
}

}