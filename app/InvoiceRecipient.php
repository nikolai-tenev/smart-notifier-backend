<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class InvoiceRecipient extends Model
{
    use Translatable;

    public $translatedAttributes = ['name', 'address', 'mol'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
     protected $with = ['translations'];
}
