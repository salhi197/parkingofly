<?php

namespace App\Http\Controllers;

use App\Commune;
use App\Wilaya;
use Carbon\Carbon;
use Hash;
use App\Setting;
use App\Categorie;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SettingController extends Controller
{


    public function index()
    {
        $settings = Setting::all();
        return view('settings.index',compact('settings'));
    }

    public function type($type)
    {
        $settings = Setting::where('type',$type)->get();
        return view('settings.index',compact('settings'));
    }


    public function createType($type)
    {
        return view('settings.create',compact('type'));
    }

    public function create()
    {
        $type = "";
        return view('settings.create',compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $setting = new Setting();   
            $setting->determination = $request['value'];
            $setting->duree = $request['duree'];
            $setting->prix = $request['prix'];
            $setting->valeur = $request['valeur'];
            $setting->type = $request['type'];
            try {
                $setting->save();
            } catch (\Throwable $th) {
                return response()->json(['success'=>0]);
            }
            return response()->json(['success'=>1]);
        }else{
            $setting = new Setting();   
            $setting->determination = $request['determination'];
            $setting->duree = $request['duree'];
            $setting->prix = $request['prix'];
            // $setting->valeur = $request['valeur'];
            $setting->type = $request['type'] ?? '';
            $setting->reference = $request['reference'] ?? '';
            $setting->unite = $request['unite'] ?? '';
            $setting->norme = $request['norme'] ?? '';
    
            $setting->save();
            return redirect()->back()->with('success', 'Inséré avec succés ');            
        }
    }

        public function show($id_setting)

    {
        $setting = Setting::find($id_setting);
        return view('settings.view',compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit($id_setting)
    {
        $setting = Setting::find($id_setting);
        return view('settings.edit',compact('setting'));
    }

    public function update(Request $request,$setting_id)
    {
        $setting = Setting::find($setting_id);  
        $setting->determination = $request['determination'];
        $setting->determination = $request['determination'];
        $setting->duree = $request['duree'];
        $setting->prix = $request['prix'];
        // $setting->valeur = $request['valeur'];
        $setting->type = $request['type'] ?? '';
        $setting->reference = $request['reference'] ?? '';
        $setting->unite = $request['unite'] ?? '';
        $setting->norme = $request['norme'] ?? '';
    $setting->save();
        
        return redirect()->route('setting.index')->with('success', 'reservation inséré avec succés ');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_setting)
    {
        $setting = Setting::find($id_setting);
        $setting->delete();
        return redirect()->route('setting.index')->with('success', 'le Setting a été supprimé ');        
    }


}
