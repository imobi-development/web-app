<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Broker - Corretor de Imóveis
 * 
 * Perfil profissional de um corretor. Cada corretor tem um User associado.
 * Pode trabalhar de forma autônoma ou fazer parte de uma ou mais imobiliárias.
 * 
 * @property string $id - ID único (ULID)
 * @property string $user_id - ID do usuário dono deste perfil (FK: users)
 * @property string $creci - Número de registro no CRECI (Conselho Regional de Corretores)
 * @property string $cpf - CPF do corretor (apenas números ou formatado)
 * @property string|null $bio - Biografia ou descrição profissional do corretor
 * @property float $commission - Percentual padrão de comissão (ex: 3.00 = 3%)
 * @property \Carbon\Carbon $created_at - Data de criação do registro
 * @property \Carbon\Carbon $updated_at - Data da última atualização
 * 
 * @property-read User $user - Usuário dono deste perfil
 * @property-read \Illuminate\Database\Eloquent\Collection|RealEstateAgency[] $agencies - Imobiliárias que este corretor faz parte
 * @property-read \Illuminate\Database\Eloquent\Collection|Property[] $properties - Imóveis de propriedade deste corretor
 */
class Broker extends Model
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
        'user_id',     // ID do usuário (relacionamento)
        'creci',       // Registro CRECI
        'cpf',         // CPF do corretor
        'bio',         // Biografia/descrição
        'commission',  // Comissão padrão (%)
    ];

    /**
     * Conversão automática de tipos
     */
    protected $casts = [
        'commission' => 'decimal:2', // Garante 2 casas decimais
    ];

    // ==================== RELACIONAMENTOS ====================

    /**
     * Usuário dono deste perfil de corretor
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Imobiliárias que este corretor faz parte (Many-to-Many)
     * 
     * Pivot (broker_agency):
     * - status: pending|accepted|rejected
     * - commission_split: % que a imobiliária fica
     */
    public function agencies()
    {
        return $this->belongsToMany(RealEstateAgency::class, 'broker_agency')
            ->withPivot('status', 'commission_split')
            ->withTimestamps();
    }

    /**
     * Imóveis de propriedade deste corretor (polimórfico)
     */
    public function properties()
    {
        return $this->morphMany(Property::class, 'owner');
    }
}