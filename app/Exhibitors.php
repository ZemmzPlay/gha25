<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;

class Exhibitors extends Model
{
    protected $table = 'exhibitors';
    protected $fillable = ['title', 'places'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
?>