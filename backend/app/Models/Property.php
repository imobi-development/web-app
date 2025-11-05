<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model Property - Imóvel
 * 
 * Representa um imóvel cadastrado no sistema. Pode pertencer a um Corretor ou Imobiliária.
 * Usa relacionamento polimórfico para permitir diferentes tipos de proprietários.
 * 
 * @property string $id - ID único (ULID)
 * @property string $owner_type - Tipo do proprietário: 'App\Models\Broker' ou 'App\Models\RealEstateAgency'
 * @property string $owner_id - ID do proprietário (Broker ou RealEstateAgency)
 * @property string $title - Título do anúncio (ex: "Apartamento no Centro")
 * @property string $description - Descrição completa do imóvel
 * @property bool $is_active - Indica se o anúncio está ativo/publicado
 * @property \Carbon\Carbon $created_at - Data de criação do registro
 * @property \Carbon\Carbon $updated_at - Data da última atualização
 * @property \Carbon\Carbon|null $deleted_at - Data de exclusão suave (soft delete)
 * 
 * @property-read Broker|RealEstateAgency $owner - Proprietário do imóvel (polimórfico)
 */
class Property extends Model
{
    use HasUlids, SoftDeletes;

    /** 
     * Desabilita auto-increment (usamos ULID) 
     */
    public $incrementing = false;
    
    /** 
     * Define que a chave primária é string 
     */
    protected $keyType = 'string';

    /**
     * Campos que podem ser preenchidos em massa
     */
    protected $fillable = [
        'owner_type',   // Tipo do dono: Broker ou RealEstateAgency
        'owner_id',     // ID do dono
        'title',        // Título do anúncio
        'description',  // Descrição do imóvel
        'is_active',    // Status ativo/inativo
    ];

    /**
     * Conversão automática de tipos
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ==================== RELACIONAMENTOS ====================

    /**
     * Proprietário do imóvel (polimórfico)
     * 
     * Pode ser:
     * - Broker (corretor proprietário)
     * - RealEstateAgency (imobiliária proprietária)
     */
    public function owner()
    {
        return $this->morphTo();
    }
}