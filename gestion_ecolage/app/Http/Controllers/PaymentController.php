<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Receipt;
use App\Models\Student;
use App\Models\FeeType;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['student', 'feeType', 'processedBy', 'academicYear'])->orderByDesc('created_at');
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('student', function($subq) use ($search) {
                    $subq->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%")
                         ->orWhere('registration_number', 'like', "%{$search}%");
                })
                ->orWhereHas('feeType', function($subq) use ($search) {
                    $subq->where('name', 'like', "%{$search}%");
                })
                ->orWhere('reference', 'like', "%{$search}%");
            });
        }
        
        $payments = $query->paginate(7);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $students = Student::with('classroom.level')->get();
        $feeTypes = FeeType::all();
        $academicYears = AcademicYear::all();
        return view('payments.create', compact('students', 'feeTypes', 'academicYears'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_type_id' => 'required|exists:fee_types,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_mode' => 'required|in:cash,check,transfer,mobile_money',
            'reference' => 'nullable|string|max:255',
            'academic_year_id' => 'required|exists:academic_years,id',
            'notes' => 'nullable|string',
        ]);

        $validated['processed_by'] = auth()->id();

        $payment = Payment::create($validated);

        // Générer le reçu
        $receiptNumber = $this->generateReceiptNumber();
        Receipt::create([
            'payment_id' => $payment->id,
            'receipt_number' => $receiptNumber,
        ]);

        return redirect()->route('payments.show', $payment)->with('success', 'Paiement enregistré avec succès.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['student.classroom.level', 'feeType', 'processedBy', 'academicYear', 'receipt']);
        return view('payments.show', compact('payment'));
    }

    public function printReceipt(Receipt $receipt)
    {
        $receipt->incrementPrintCount();
        $receipt->load('payment.student.classroom', 'payment.feeType');
        return view('receipts.print', compact('receipt'));
    }

    private function generateReceiptNumber()
    {
        $year = now()->year;
        $lastReceipt = Receipt::whereYear('created_at', $year)->latest()->first();
        $number = $lastReceipt ? intval(substr($lastReceipt->receipt_number, -3)) + 1 : 1;
        return sprintf('REC-%d-%03d', $year, $number);
    }
}
