<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configurations';

    public function PaymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'payment_gateway');
    }
}
?>