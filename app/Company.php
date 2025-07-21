<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exhibitors;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'phone_code', 'company_id', 'created_by'];

    public function exhibitors()
    {
        return $this->hasMany(Exhibitors::class, 'company_id', 'id');
    }
}
?>