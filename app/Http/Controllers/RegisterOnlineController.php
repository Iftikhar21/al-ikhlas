<?php

namespace App\Http\Controllers;

use App\Models\RegisterOnline;
use Illuminate\Http\Request;

class RegisterOnlineController extends Controller
{
    public function store(Request $request)
    {
        // Validasi server-side
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birthPlace' => 'required|string|max:255',
            'birthDate' => 'required|date|before:-4 years',
            'address' => 'required|string',
            'fatherName' => 'required|string|max:255',
            'fatherOccupation' => 'nullable|string|max:255',
            'motherName' => 'required|string|max:255',
            'motherOccupation' => 'nullable|string|max:255',
            'parentPhone' => 'required|string|max:20',
            'parentEmail' => 'nullable|email',
            'agreement' => 'accepted',
        ]);

        // Simpan ke database
        try {
            RegisterOnline::create([
                'full_name' => $request->fullName,
                'gender' => $request->gender,
                'birth_place' => $request->birthPlace,
                'birth_date' => $request->birthDate,
                'address' => $request->address,
                'father_name' => $request->fatherName,
                'father_occupation' => $request->fatherOccupation,
                'mother_name' => $request->motherName,
                'mother_occupation' => $request->motherOccupation,
                'parent_phone' => $request->parentPhone,
                'parent_email' => $request->parentEmail,
                'is_approved' => false, // GANTI MENJADI is_approved
            ]);

            return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim! Kami akan menghubungi Anda untuk informasi lebih lanjut.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // List semua pendaftar
    public function index()
    {
        $registrations = RegisterOnline::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.register_online.index', compact('registrations'));
    }

    // Lihat detail pendaftar
    public function show($id)
    {
        $registration = RegisterOnline::findOrFail($id);
        return view('admin.register_online.show', compact('registration'));
    }

    // Approve pendaftar
    public function approve($id)
    {
        $registration = RegisterOnline::findOrFail($id);
        $registration->is_approved = true;
        $registration->save();

        return redirect()->route('admin.admin-register-online.index')
            ->with('success', 'Pendaftaran berhasil disetujui.');
    }

    // Hapus pendaftar
    public function destroy($id)
    {
        $registration = RegisterOnline::findOrFail($id);
        $registration->delete();

        return redirect()->route('admin.admin-register-online.index')
            ->with('success', 'Pendaftaran berhasil dihapus.');
    }
}
