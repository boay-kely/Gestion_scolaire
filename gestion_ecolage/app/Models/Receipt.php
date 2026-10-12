<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'receipt_number',
        'print_count',
        'printed_at',
    ];

    protected $dates = ['printed_at'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function student()
    {
        return $this->payment?->student;
    }

    public function incrementPrintCount()
    {
        $this->increment('print_count');
        $this->update(['printed_at' => now()]);
    }
}
