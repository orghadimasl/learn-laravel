<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhoneController extends Controller
{
    public function index()
    {
        $phones = Phone::with('user')->get();
        return view('phone', compact('phones'));
    }
}
