<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;

class Dashboard extends Controller
{

    public function Index(){
        $salesData = Sales::selectRaw('SUM(amount) as total, MONTHNAME(sale_date) month')
        ->groupBy('month')
        ->orderBy('sale_date')
        ->get();

        $labels = $salesData->pluck('month');
        $data = $salesData->pluck('total')->map(fn($sv) => (float) $sv);
        return view('dashboard', compact('labels', 'data'));
    }
    
}
