<?php

namespace App\Http\Controllers;

use App\Models\Ilustrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IlustrasiController extends Controller
{
  public function update(Request $request)
  {
    $request->validate([
      'ilustrasi' => 'nullable|image|mimes:png',
      'tujuan_pbl' => 'required|string',
    ]);

    $ilustrasi = Ilustrasi::first() ?? new Ilustrasi();

    if ($request->hasFile('ilustrasi')) {
      // Hapus ilustrasi lama jika ada
      if ($ilustrasi->ilustrasi) {
        Storage::delete('public/illustrations/' . $ilustrasi->ilustrasi);
      }
      $ilustrasiPath = $request->file('ilustrasi')->store('public/illustrations');
      $ilustrasi->ilustrasi = basename($ilustrasiPath);
    }

    $ilustrasi->tujuan_pbl = $request->tujuan_pbl;
    $ilustrasi->save();

    // Tambahkan session flash untuk alert sukses
    return redirect()->back()->with('success', 'Background illustration and learning objective updated successfully.');
  }
}
