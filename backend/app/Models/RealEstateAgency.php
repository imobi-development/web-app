<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

/**
 * Model RealEstateAgency - Imobiliária
 * 
 * Perfil de uma imobiliária. Pode ter uma equipe de corretores e cadastrar imóveis próprios.
 * 
 * @property string $id - ID único (ULID)
 * @property string $user_id - ID do usuário dono deste perfil (FK: users)
 * @property string $trade_name - Nome fantasia da imobiliária (como é conhecida)
 * @property string $legal_name - Razão social (nome jurídico da empresa)
 * @property string $cnpj - CNPJ da empresa (apenas números ou formatado)
 * @property string $creci_company - Número de registro CRECI da empresa
 * @property string|null $logo - URL do logotipo da imobiliária
 * @property \Carbon\Carbon $created_at - Data de criação do registro
 * @property \Carbon\Carbon $updated_at - Data da última atualização
 * 
 * @property-read User $user - Usuário dono deste perfil
 * @property-read \Illuminate\Database\Eloquent\Collection|Broker[] $brokers - Corretores que fazem parte desta imobiliária
 * @property-read \Illuminate\Database\Eloquent\Collection|Property[] $properties - Imóveis de propriedade desta imobiliária
 */
class RealEstateAgency extends Model
{
    use HasUlids;

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
        'user_id',        // ID do usuário (relacionamento)
        'trade_name',     // Nome fantasia
        'legal_name',     // Razão social
        'cnpj',           // CNPJ da empresa
        'creci_company',  // CRECI da empresa
        'logo',           // URL do logo
    ];

    // ==================== RELACIONAMENTOS ====================

    /**
     * Usuário dono deste perfil de imobiliária
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Corretores que fazem parte desta imobiliária (Many-to-Many)
     * 
     * Pivot (broker_agency):
     * - status: pending|accepted|rejected
     * - commission_split: % que a imobiliária fica quando o corretor vende
     */
    public function brokers()
    {
        return $this->belongsToMany(Broker::class, 'broker_agency')
            ->withPivot('status', 'commission_split')
            ->withTimestamps();
    }

    /**
     * Imóveis de propriedade desta imobiliária (polimórfico)
     */
    public function properties()
    {
        return $this->morphMany(Property::class, 'owner');
    }
}