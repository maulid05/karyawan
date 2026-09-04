<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    User,
    DataPribadi,
    Kependudukan,
    Kontak,
    Kepegawaian,
    Keluarga,
    LainLain,
    PasFoto,
    ProfilAkademik
};
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        if ($user->hasRoles(['superadmin'])) {
            return redirect()->route('index');
        }

        if ($user->hasRoles(['client'])) {
            return redirect()->route('homepage');
        }

        if ($user->hasRoles(['admin'])) {
            return redirect()->route('dashboard');
        }

        abort(403);
    }

    public function show(string $id)
    {
        $user = DataPribadi::where('user_id', Auth::id())->first();

        if ($user === null) {

            DataPribadi::create([
                'user_id' => Auth::id(),
                'NUPTK' => '-',
                'NIDN' => '-',
                'Nama' => Auth::user()->name,
                'Jenis_Kelamin' => '-',
                'Tempat_Lahir' => '-',
                'Tanggal_Lahir' => '-',
                'NIP' => '-',
            ]);

            Kependudukan::create([
                'user_id' => Auth::id(),
                'NIK' => '-',
                'Agama' => '-',
                'Kewarganegaraan' => '-',
            ]);

            Keluarga::create([
                'user_id' => Auth::id(),
                'Status_Perkawinan' => '-',
                'Nama_Suami_Atau_Istri' => '-',
                'NIP_Suami_Atau_Istri' => '-',
                'Pekerjaan_Suami_Atau_Istri' => '-',
            ]);

            Kontak::create([
                'user_id' => Auth::id(),
                'Email' => Auth::user()->email,
                'Alamat' => '-',
                'RT' => '-',
                'RW' => '-',
                'Desa_atau_Kelurahan' => '-',
                'Kecamatan' => '-',
                'Kabupaten_atau_Kota' => '-',
                'Provinsi' => '-',
                'Kode_Pos' => '-',
                'No_Telepon_Rumah' => '-',
                'No_Handphone' => '-',
            ]);

            Kepegawaian::create([
                'user_id' => Auth::id(),
                'Nomor_SK' => '-',
                'Tanggal_Masuk' => '-',
                'Sumber_Gaji' => '-',
                'Nama_Jabatan' => '-',
            ]);
        }

        return redirect()->route('profile', Auth::user()->id);
    }
}