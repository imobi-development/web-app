<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Model User - Usuário do Sistema
 * 
 * Tabela central de autenticação. Todos os usuários (corretores, imobiliárias, admins)
 * têm um registro nesta tabela e um perfil específico em outra tabela relacionada.
 * 
 * @property string $id - ID único (ULID)
 * @property string $name - Nome completo do usuário
 * @property string $email - Email para login (único)
 * @property string $password - Senha hasheada
 * @property string|null $phone - Telefone de contato
 * @property string|null $avatar - URL da foto de perfil
 * @property string $user_type - Tipo de usuário: 'broker' (corretor), 'agency' (imobiliária), 'admin'
 * @property bool $is_active - Indica se o usuário está ativo no sistema
 * @property \Carbon\Carbon|null $email_verified_at - Data/hora de verificação do email
 * @property string|null $remember_token - Token para "lembrar-me"
 * @property \Carbon\Carbon $created_at - Data de criação do registro
 * @property \Carbon\Carbon $updated_at - Data da última atualização
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids;

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
        'name',        // Nome completo
        'email',       // Email para login
        'password',    // Senha
        'phone',       // Telefone
        'avatar',      // URL da foto
        'user_type',   // Tipo: broker|agency|admin
        'is_active',   // Status ativo/inativo
    ];

    /**
     * Campos ocultos (não aparecem no JSON)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversão automática de tipos
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // ==================== RELACIONAMENTOS ====================

    /**
     * Perfil de Corretor (apenas se user_type = 'broker')
     */
    public function broker()
    {
        return $this->hasOne(Broker::class);
    }

    /**
     * Perfil de Imobiliária (apenas se user_type = 'agency')
     */
    public function agency()
    {
        return $this->hasOne(RealEstateAgency::class);
    }
}