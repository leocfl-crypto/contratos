<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractFile extends Model
{
    public const TYPE_TERMO_REFERENCIA = 'termo_referencia';
    public const TYPE_ADITIVO = 'aditivo';
    public const TYPE_CONTRATO = 'contrato';
    public const TYPE_OUTROS = 'outros';

    public const TYPES = [
        self::TYPE_TERMO_REFERENCIA => 'Termo de Referência',
        self::TYPE_ADITIVO => 'Aditivo',
        self::TYPE_CONTRATO => 'Contrato',
        self::TYPE_OUTROS => 'Outros',
    ];

    protected $fillable = [
        'contract_id',
        'original_name',
        'file_path',
        'file_type',
        'file_size',
        'mime_type',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    /**
     * Get the contract that owns the file.
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    /**
     * Get human-readable file type name.
     */
    public function getTypeNameAttribute(): string
    {
        return self::TYPES[$this->file_type] ?? $this->file_type;
    }

    /**
     * Get formatted file size.
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        $index = 0;

        while ($bytes >= 1024 && $index < count($units) - 1) {
            $bytes /= 1024;
            $index++;
        }

        return round($bytes, 2) . ' ' . $units[$index];
    }
}
