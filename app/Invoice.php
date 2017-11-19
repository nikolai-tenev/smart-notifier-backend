<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $with = ['recipient', 'items', 'generatedInvoices'];

    /**
     * Get the post that owns the comment.
     */
    public function recipient()
    {
        return $this->belongsTo(InvoiceRecipient::class);
    }

    /**
     * Get the post that owns the comment.
     */
    public function generatedInvoices()
    {
        return $this->hasMany(GeneratedInvoice::class);
    }

    /**
     * Get the post that owns the comment.
     */
    public function items()
    {
        return $this->belongsToMany(InvoiceItem::class)->as('details')->withPivot(['number', 'quantity', 'price']);
    }
}
