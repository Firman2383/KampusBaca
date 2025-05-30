<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JurusanController extends Controller
{
    public function index($fakultas)
    {
        $fakultasModel = Fakultas::where('slug', $fakultas)->firstOrFail();

        $data = [
            'title' => 'Jurusan',
            'jurusan' => Jurusan::where('fakultas_id', $fakultasModel->id)->get(),
            'fakultas' => $fakultasModel,
            'no' => 1,
        ];

        return view('admin.jurusan.index', $data);
    }

    public function store(Request $request, Fakultas $fakultas)
    {
        $fakultasModel = Fakultas::where('slug', $fakultas)->firstOrFail();

        $request->validate([
            'nama_jurusan' => 'required|string|max:255|unique:jurusans,nama_jurusan',
        ], [
            'nama_jurusan.required' => 'Nama jurusan tidak boleh kosong, ya. Mohon diisi.',
            'nama_jurusan.string'   => 'Format nama jurusan sepertinya keliru, seharusnya berupa teks.',
            'nama_jurusan.max'      => 'Nama jurusan terlalu panjang. Maksimal hanya 255 karakter saja.',
            'nama_jurusan.unique'   => 'Nama jurusan ini sudah terdaftar. Coba gunakan nama lain, ya.'
        ]);

        Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
            'slug' => Str::slug($request->nama_jurusan),
            'fakultas_id' => $fakultasModel->id,
        ]);

        return redirect()->route('jurusan.index', ['fakultas' => $fakultasModel->slug])->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function update(Request $request, $fakultas, $jurusan)
    {
        $fakultasModel = Fakultas::where('slug', $fakultas)->firstOrFail();
        $jurusanModel = Jurusan::where('slug', $jurusan)->firstOrFail();

        $request->validate([
            'nama_jurusan' => 'required|string|max:255|unique:jurusan,nama_jurusan,' . $jurusanModel->id,
        ], [
            'nama_jurusan.required' => 'Nama jurusan tidak boleh kosong, ya. Mohon diisi.',
            'nama_jurusan.string'   => 'Format nama jurusan sepertinya keliru, seharusnya berupa teks.',
            'nama_jurusan.max'      => 'Nama jurusan terlalu panjang. Maksimal hanya 255 karakter saja.',
            'nama_jurusan.unique'   => 'Nama jurusan ini sudah terdaftar. Coba gunakan nama lain, ya.'
        ]);

        $jurusanModel->update([
            'nama_jurusan' => $request->nama_jurusan,
            'slug' => Str::slug($request->nama_jurusan),
        ]);

        return redirect()->route('jurusan.index', ['fakultas' => $fakultasModel->slug])->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy($fakultas, $jurusan)
    {
        $fakultasModel = Fakultas::where('slug', $fakultas)->firstOrFail();
        $jurusanModel = Jurusan::where('slug', $jurusan)->firstOrFail();

        // Check if the jurusan belongs to the fakultas
        if ($jurusanModel->fakultas_id !== $fakultasModel->id) {
            return redirect()->route('jurusan.index', ['fakultas' => $fakultasModel->slug])->with('error', 'Jurusan tidak ditemukan di fakultas ini.');
        }

        $jurusanModel->delete();

        return redirect()->route('jurusan.index', ['fakultas' => $fakultasModel->slug])->with('success', 'Jurusan berhasil dihapus.');
    }
}
