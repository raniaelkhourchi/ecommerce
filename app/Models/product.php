<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class product extends Model
{
    use HasFactory;


   /* protected $fillable=[
    
        'Product_name',
        'section_name',
        'description',
        'section_id'
     ];*/

     
     protected $guarded = [];

 //section est le nom de fonction qu on utilise dans .blade <td>{{$P->Section->section_name }}</td>
     public function Section(): BelongsTo
     {

         return $this->belongsTo('App\Models\section');
     }

}
