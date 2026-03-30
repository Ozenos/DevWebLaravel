<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    //
    protected $table = "tickets";
    protected $fillable = [
        'title', 'time', 'advancement', 'facturation', 'user_id', 'description'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function collaborators(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function displayAdvancement(): string
    {
        switch ($this->advancement) {
            case "open": return "Ouvert";
            case "progress": return "En cours";
            case "completed": return "Terminé";
            default: return $this->advancement;
        } 
    }
    public function displayFacturation(): string
    {
        switch ($this->facturation) {
            case "included": return "Inclus";
            case "facturable": return "Facturable";
            default: return $this->facturation;
        }
    }
    public function convertAdvancement(String $adv): string
    {
        switch ($adv) {
            case "Ouvert": return "open";
            case "En cours": return "progress";
            case "Terminé": return "completed";
            default: return "error";
        } 
    }
    public function convertFacturation(String $fac): string
    {
        switch ($fac) {
            case "Inclus": return "included";
            case "Facturable": return "facturable";
            default: return "error";
        }
    }
}
