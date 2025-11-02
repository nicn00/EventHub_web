<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
    'name', // Diubah
    'description', // Diubah
    'date', // Diubah
    'location', // Diubah
    'price', // Diubah
    'image',
];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}