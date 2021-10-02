<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Post extends Model
{
    use HasFactory;
    use Rateable;    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    protected $fillable = ['id', 'user_id', 'name','title','content'];

    protected $hidden = [
        'created_at', 'updated_at',
        ];


}
