<?php

namespace App\Legacy\Models;

use App\Legacy\Models\Concerns\UsesLicenseConnection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string|null $username
 * @property string|null $password
 * @property int $FK_employee
 * @property string|null $role USER | ADMIN | SADMIN
 * @property int|null $userLoggedIn 1 dok je korisnik ulogovan na Kancelarku
 * @property int|null $eksterni gost nalog
 * @property int|null $lightPrincipal
 * @property int|null $accept_conditions
 * @property int|null $crm_manager
 * @property string|null $remember_token
 * @property-read Employee|null $employee
 */
class User extends Authenticatable
{
    use Notifiable;
    use UsesLicenseConnection;

    protected $table = 'users';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'password',
        'FK_employee',
        'role',
        'registrationTime',
        'previewPreviousVersions',
        'newDocument',
        'newFolder',
        'newDelovodnik',
        'notification',
        'templates',
        'keywords',
        'documentType',
        'employeeChange',
        'contactChange',
        'moreInfo',
        'career',
        'termination_type',
        'termination_reason',
        'engagement_type',
        'engagement_reason',
        'businessPartner',
        'where_is_document',
        'absence',
        'taskType',
        'obligationType',
        'administrationOIS',
        'previewOIS',
        'accept_conditions',
        'geolocation',
        'finances',
        'institutions',
        'remember_token',
        'resourcePriv',
        'locationAdd',
        'faktureUplatePriv',
        'emailCreated',
        'saVidiPrimljene',
        'saMozeDaSalje',
        'employeeStatisticsPriv',
        'mozeDaSaljePostar',
        'vidiPrimljenePostar',
        'eksterni',
        'robnoObradaZapisnika',
        'robnoKalkulacija',
        'administrationArchiveBook',
        'eArchive',
        'saDone',
        'obradaIzvoda',
        'crm_manager',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return BelongsTo<Employee, $this>
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'FK_employee', 'ID');
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'SADMIN';
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['ADMIN', 'SADMIN'], true);
    }

    public function isGuest(): bool
    {
        return (int) ($this->eksterni ?? 0) === 1;
    }

    public function isCrmManager(): bool
    {
        return $this->isSuperAdmin() || (int) ($this->crm_manager ?? 0) === 1;
    }
}
