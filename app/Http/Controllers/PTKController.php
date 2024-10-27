<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PTKController extends Controller
{
    public function submitJudulProposal(Request $request)
    {
        // dd($request);
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:10240',  // Maksimal 10MB
        ]);

        // Simpan berkas proposal ke storage
        $filePath = $request->file('file')->store('proposals', 'public');

        // Menggunakan DB transaction untuk menghindari inkonsistensi data
        DB::beginTransaction();

        try {
            // Simpan data judul ke tabel 'judul'
            $judulId = DB::table('judul')->insertGetId([
                'judul' => $validatedData['judul'],
                'user_id' => auth()->user()->id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Simpan data proposal ke tabel 'proposal' dengan foreign key dari tabel 'judul'
            DB::table('proposal')->insert([
                'judul_id' => $judulId,
                'file_path' => $filePath,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Commit transaction jika semua proses berhasil
            DB::commit();

            return response()->json([
                'message' => 'Judul dan Proposal PTK berhasil diajukan',
                'data' => [
                    'judul_id' => $judulId,
                    'file_path' => $filePath,
                ],
            ], 201);
        } catch (\Exception $e) {
            // Rollback transaction jika ada kesalahan
            DB::rollBack();

            return response()->json([
                'message' => 'Gagal mengajukan Judul dan Proposal PTK',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // Function untuk menampilkan judul yang sedang aktif dan riwayat revisi
    public function showJudul()
    {
        // Ambil judul terbaru yang belum di-soft delete
        $judul = DB::table('judul')
            ->where('user_id', auth()->id())
            ->whereNull('deleted_at')
            ->first();

        // Ambil semua judul (termasuk yang di-soft delete) sebagai riwayat revisi
        $revisi = DB::table('judul')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil dosen berdasarkan dosen_id pengguna yang sedang login
        $dosen = DB::table('dosens')->where('id', auth()->user()->dosen_id)->first();

        return view('ptk.judul.index', [
            'judul' => $judul,
            'revisi' => $revisi,
            'dosen' => $dosen, // Kirimkan data dosen ke view
        ]);
    }


    // Function untuk menampilkan form revisi judul
    public function showRevisiForm()
    {
        // Ambil judul aktif (yang belum di-soft delete)
        $judul = DB::table('judul')
            ->where('user_id', auth()->id())
            ->whereNull('deleted_at')
            ->first();

        // Jika tidak ada judul, arahkan pengguna untuk membuat judul terlebih dahulu
        if (!$judul) {
            return redirect()->route('PTK-judul')->with('error', 'Tidak ada judul yang tersedia untuk direvisi.');
        }

        // Cek apakah status judul masih "pending"
        if ($judul->status === 'pending') {
            return redirect()->back()->with('error', 'Judul masih dalam status pending. Anda tidak bisa mengajukan revisi saat ini.');
        }

        // Jika tidak pending, tampilkan form revisi
        return view('ptk.judul.revisi', compact('judul'));
    }


    // Function untuk mengajukan revisi judul
    public function revisiJudul(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        // Lakukan soft delete untuk judul yang lama
        DB::table('judul')
            ->where('user_id', auth()->id())
            ->whereNull('deleted_at')
            ->update(['deleted_at' => Carbon::now()]);

        // Menyimpan judul baru ke dalam tabel judul
        DB::table('judul')->insert([
            'user_id' => auth()->id(),
            'judul' => $validatedData['judul'],
            'status' => 'pending', // Judul baru dimulai dengan status pending
            'catatan' => null, // Belum ada catatan untuk judul baru
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Redirect ke halaman status judul dengan pesan sukses
        return redirect()->route('PTK-judul')->with('success', 'Revisi judul berhasil diajukan!');
    }


    // Function untuk menampilkan proposal yang sedang aktif
    public function showProposal()
    {
        // Ambil proposal yang terbaru (belum di-soft delete) berdasarkan user_id dari tabel judul
        $proposal = DB::table('proposal')
            ->join('judul', 'proposal.judul_id', '=', 'judul.id')
            ->where('judul.user_id', auth()->id())
            ->whereNull('proposal.deleted_at')
            ->select('proposal.*', 'judul.judul as judul_proposal', 'judul.status as judul_status', 'judul.catatan as judul_catatan')
            ->first();

        // Jika tidak ada proposal, arahkan pengguna untuk mengajukan proposal terlebih dahulu
        if (!$proposal) {
            return redirect()->route('PTK-detail')->with('error', 'Tidak ada proposal yang tersedia.');
        }

        // Ambil data dosen pembimbing berdasarkan dosen_id dari tabel users
        $dosen = DB::table('dosens')
            ->join('users', 'dosens.id', '=', 'users.dosen_id') // Join ke tabel users
            ->where('users.id', auth()->id()) // Gunakan user_id dari tabel users yang sedang login
            ->select('dosens.name as dosen_nama') // Ambil nama dosen
            ->first();

        // Ambil semua riwayat revisi terkait proposal berdasarkan judul_id
        $revisi = DB::table('proposal')
            ->where('judul_id', $proposal->judul_id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Tampilkan halaman detail proposal
        return view('ptk.index', compact('proposal', 'dosen', 'revisi'));
    }


    // Function untuk menampilkan form revisi proposal
    public function showRevisiProposalForm()
    {
        // Ambil proposal yang sedang aktif (belum di-soft delete)
        $proposal = DB::table('proposal')
            ->join('judul', 'proposal.judul_id', '=', 'judul.id')
            ->where('judul.user_id', auth()->id())
            ->whereNull('proposal.deleted_at')
            ->select('proposal.*', 'judul.judul as judul_proposal')
            ->first();

        // // Cek apakah status proposal masih "pending"
        if ($proposal && $proposal->status === 'pending') {
            return redirect()->back()->with('error', 'Proposal masih dalam status pending. Anda tidak bisa mengajukan revisi saat ini.');
        }

        // Ambil data dosen berdasarkan dosen_id dari tabel users
        $dosen = DB::table('dosens')
            ->join('users', 'dosens.id', '=', 'users.dosen_id') // Join ke tabel users
            ->where('users.id', auth()->id()) // Gunakan user_id dari pengguna yang sedang login
            ->select('dosens.name as dosen_nama') // Ambil nama dosen
            ->first();

        // Jika tidak pending, tampilkan form revisi
        return view('ptk.revisi', compact('proposal', 'dosen'));
    }


    // Function untuk mengajukan revisi proposal
    public function revisiProposal(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'file' => 'required|file|mimes:pdf|max:10240',  // Maksimal 10MB
        ]);

        // Simpan berkas proposal baru ke storage
        $filePath = $request->file('file')->store('proposals', 'public');

        // Lakukan soft delete untuk proposal yang lama
        DB::table('proposal')
            ->join('judul', 'proposal.judul_id', '=', 'judul.id')
            ->where('judul.user_id', auth()->id())
            ->whereNull('proposal.deleted_at')
            ->update(['proposal.deleted_at' => Carbon::now()]);

        // Menyimpan proposal baru ke dalam tabel proposal
        DB::table('proposal')->insert([
            'judul_id' => $request->judul_id, // Ambil judul_id dari input atau session
            'file_path' => $filePath,
            'status' => 'pending', // Proposal baru dimulai dengan status pending
            'catatan' => null, // Belum ada catatan untuk proposal baru
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Redirect ke halaman status proposal dengan pesan sukses
        return redirect()->route('PTK-proposal')->with('success', 'Revisi proposal berhasil diajukan!');
    }
}
