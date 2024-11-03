<?php

namespace App\Http\Controllers;
use App\Models\Ilustrasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function homeUser()
{
    // Ambil data video terbaru yang dimasukkan ke dalam database
    $ilustrasi = Ilustrasi::latest()->first();

    // Kirim data ilustrasi terbaru ke view 'user.home'
    return view('user.home', compact('ilustrasi'));
}
}