<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    public function PaymentGateway()
    {
        return $this->belongsTo(PaymentGateway::class, 'payment_gateway');
    }

    public function registration()
    {
        return $this->hasOne(Registration::class, 'payment_id');
    }
}
?>