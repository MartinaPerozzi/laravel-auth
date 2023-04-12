<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // FILLABLE
    protected $fillable = ['title', 'text', 'image'];

    // ABSTRACT FUNCTION
    public function getAbstract($max = 50)
    {
        return substr($this->text, 0, $max) . "...";
    }
    // FUNZIONE GESTIONE SLUG
    public static function generateUniqueSlug($title)
    {
        $possible_slug = Str::of($title)->slug('-');
        $projects = Project::where('slug', $possible_slug)->get();
        $original_slug = $possible_slug;
        $i = 2;
        // CICLO in cui entro solo se la collection è != da 0 quindi non è vuota e lo slug non è unico (quindi si ripete).
        while (count($projects)) {
            // Allora aggiungi allo slug originale un trattino e un numero
            $possible_slug = $original_slug . "-" . $i;
            // Riprendi nel singolo progetto lo slug e il possibile slug;
            $projects = Project::where('slug', $possible_slug)->get();
            // Incrementa di uno il numero ogni volta
            $i++;
        }
        // RETURN
        return $possible_slug;
    }
}
