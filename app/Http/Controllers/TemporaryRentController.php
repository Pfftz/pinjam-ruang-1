<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Room;

class TemporaryRentController extends Controller
{
    public function index()
    {
        return view('dashboard.temporaryRents.index', [
            'title' => "Konfirmasi Pinjaman",
            'rents' => Rent::where('status', 'pending')->latest()->paginate(10),
        ]);
    }

    public function acceptRents($id)
    {
        $rentStatus = [
            'status' => 'dipinjam',
        ];

        $rent = Rent::where('id', $id)->update($rentStatus);

        return redirect('/dashboard/temporaryRents');
    }

    public function declineRents($id)
    {
        $rentStatus = [
            'status' => 'ditolak',
        ];

        Rent::where('id', $id)->update($rentStatus);

        return redirect('/dashboard/temporaryRents');
    }
}
