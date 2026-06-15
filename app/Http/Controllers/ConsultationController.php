<?php

// Controller: ConsultationController — handle booking konsultasi (konsul.png, jadwal konsultasi.png)
namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\User;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    // Tampilkan halaman konsultasi
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'counselor') {
            $consultations = Consultation::with('student')
                ->where('counselor_id', $user->id)
                ->orderBy('consultation_date', 'desc')
                ->paginate(20);
        } else {
            $consultations = Consultation::with('counselor')
                ->where('student_id', $user->id)
                ->orderBy('consultation_date', 'desc')
                ->paginate(20);
        }

        $counselors = User::where('role', 'counselor')->get();

        return view('consultation.index', compact('consultations', 'counselors'));
    }

    // Buat booking konsultasi — khusus student
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'student') {
            abort(403);
        }

        $request->validate([
            'counselor_id' => ['required', 'exists:users,id', function ($attr, $val, $fail) {
                if (!User::where('id', $val)->where('role', 'counselor')->exists()) {
                    $fail('Konselor tidak valid.');
                }
            }],
            'topic' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'consultation_date' => ['required', 'date', 'after:now'],
        ]);

        Consultation::create([
            'student_id' => auth()->id(),
            'counselor_id' => $request->counselor_id,
            'topic' => $request->topic,
            'description' => $request->description,
            'consultation_date' => $request->consultation_date,
        ]);

        return redirect()->route('consultation.index')->with('success', 'Booking konsultasi berhasil!');
    }

    // Update status konsultasi (khusus konselor yang memiliki)
    public function update(Request $request, Consultation $consultation)
    {
        if (auth()->user()->role !== 'counselor' || $consultation->counselor_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => ['required', 'in:approved,completed,cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        $consultation->update($request->only(['status', 'notes']));

        return redirect()->route('consultation.index')->with('success', 'Status konsultasi diperbarui!');
    }
}
