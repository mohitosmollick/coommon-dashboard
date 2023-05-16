<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientConroller extends Controller
{
    public function customers(){
        $clients = Client::all();
        $total_clients = Client::count();
//        $trash_clients = Client::onlyTrashed()->get();
        return view('dashboard.Customer.customerList',[
            'clients' => $clients,
            'total_clients' => $total_clients,
        ]);

    }

}
