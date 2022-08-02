<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The user() function returns the user that owns the post
     * 
     * @return A collection of all the answers for the question.
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    /**
     * > The posts() function returns all the posts that belong to the user
     * 
     * @return A collection of posts.
     */
    public function posts() 
    {
        return $this->hasMany(Post::class);
    }

    /**
     * The function is called getExcerptAttribute() and it returns a substring of the description
     * attribute of the model
     * 
     * @return The first 80 characters of the description attribute.
     */
    public function getExcerptAttribute() 
    {
        return substr($this->description, 0, 80) . "...";
    }

   /**
    * > This function returns the two most recent posts in the same category as the current post
    * 
    * @return A collection of two questions with the same category_id as the current question.
    */
    public function similar() 
    {
        return $this->where('category_id', $this->category_id)->with('user')->take(2)->get();
    }
}
