<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function processForm(Request $request)
    {
        $request->validate([
            'inputText' => [
                'required',
                'regex:/^[a-zA-Z\s]+(\d+)(th|tahun)[a-zA-Z\s]+$/u' // Hanya huruf alphabet dan spasi diizinkan
            ],
        ], [
            'inputText.regex' => 'Format tidak valid. Pastikan nama dan kota hanya berisi karakter alphabet.',
        ]);

        $inputText = $request->input('inputText');

        // Pemrosesan data sesuai dengan aturan yang diberikan

        // Menghapus kata "th" atau "tahun" dari usia
        $inputText = preg_replace("/(th|tahun)\b/i", '', $inputText);

        // Memisahkan nama, usia, dan kota
        preg_match('/^([a-zA-Z\s]+)(\d+)([a-zA-Z\s]+)$/', $inputText, $matches);

        // Mengambil data yang ditemukan
        $nama = $matches[1] ?? '';
        $usia = $matches[2] ?? '';
        $kota = $matches[3] ?? '';

        // Menampilkan data dalam bentuk tabel
        return view('result', compact('nama', 'usia', 'kota'));
    }


    public function generateCodes()
    {
        $startDate = new \DateTime('2021-01-01');
        $endDate = new \DateTime('2021-03-30');

        $generatedCodes = [];
        $currentDate = clone $startDate;

        while ($currentDate <= $endDate) {
            $code = $this->generateUniqueCode();
            $generatedCodes[$currentDate->format('Y-m-d')] = $code;
            $currentDate->modify('+1 day');
        }

        session(['generated_codes' => $generatedCodes]);

        return redirect()->route('codes.index');
    }

    private function generateUniqueCode()
    {
        $code = '';

        do {
            $code = Str::random(6);
        } while (ctype_digit($code) || ctype_alpha($code));

        return $code;
    }

    public function index()
    {
        $generatedCodes = session('generated_codes', []);
        return view('generatecode', compact('generatedCodes'));
    }

    public function showDetail($date)
    {
        $generatedCodes = session('generated_codes', []);

        if (array_key_exists($date, $generatedCodes)) {
            $code = $generatedCodes[$date];
            return response()->json(['code' => $code]);
        }

        return response()->json(['error' => 'Code not found.'], 404);
    }
}
