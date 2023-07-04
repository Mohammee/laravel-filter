# Laravel Filter
A laravel package to filter via your models .

installation : 

`composer require mohammadabusultan/laravel-filter`

Usage :

- use `Filterable` trait in your model
- Define `$filters`  array property in your model to select which columns to filter in

Example :

```  
useMohammadabusultan\LaravelFilter\Filterable;

class User extends Model {

  use Filterable ;
  protected $filters = ['name' => 'like', 'status' => '=', 'posts.title' => 'like'];
  
  public function posts(){
    return $this->hasMany(Post::class);
  }
