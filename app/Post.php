<?php

namespace App;

// use Illuminate\Database\Eloquent\Model; - instead extend our own model
use Carbon\Carbon;

class Post extends Model
{  // note the use of "$this" because we are in an instance
    public function comments() {
      return $this->hasMany(Comment::class);  // (php >5) = (string) 'App\Comment'
    }

    public function user() { // $post->user->name
      return $this->belongsTo(User::class);
    }

    public function addComment($body) {
/* may need this for below to give user_id 11/9/17:
$this->comments()->create([
   'body' => $body,
   'user_id' => auth()->id()
 ]);
*/
      $this->comments()->create(compact('body'));

      // above is more effective than:
      // Comment::create([
      //   'body' => $body,
      //   'post_id' => $this->id
      // ]);
    }

    public function scopeFilter($query, $filters){
      if (isset($filters['month'])) {  // instructor did NOT have to use isset()
        $month = $filters['month']; // instructor had this in if clause
        $query->whereMonth('created_at', Carbon::parse($month)->month);
      }

      if (isset($filters['year'])) {
        $year = $filters['year'];
        $query->whereYear('created_at', $year);
      }
    }

    public static function archives(){
      return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
      ->groupBy('year', 'month')
      ->orderByRaw('min(created_at) desc')
      ->get()
      ->toArray();
    }
    public function tags() {
        // any post may have many tags
        // any tag may be applied to many posts
        return $this->belongsToMany(Tag::class);
    }
}
