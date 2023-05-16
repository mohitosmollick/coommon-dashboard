<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function addServices(){
        $all_service = Service::all();
        $trash_service = Service::onlyTrashed()->get();
        return view('dashboard.Service.AddService',[
            'all_service' => $all_service,
            'trash_service' => $trash_service,
        ]);
    }

    public function serviceInsert(Request $request){
        Service::insert([
            'service_name' => $request->service_name,
            'desc' => $request->desc,
            'icon' => $request->icon,
            'service_slug' => strtolower(str_replace(' ','_',$request->service_name)),
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success','-> added successfully');
    }




}
