<?php

namespace App\Legacy\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ID
 * @property string|null $appCode
 * @property string|null $DBHost
 * @property string|null $DataBaseName
 * @property string|null $DataBaseUser
 * @property string|null $DataBasePassword
 * @property string|null $DataBaseVersion
 * @property int|null $DBTrue
 * @property string|null $ExpirationDate
 * @property string|null $RegistrationDate
 * @property string|null $LastLoginDate
 * @property string|null $licenseType
 * @property int|null $TimeAvailabilityGroup
 */
class License extends Model
{
    protected $table = 'office_license';

    protected $primaryKey = 'ID';

    public $timestamps = false;

    public function getConnectionName(): ?string
    {
        return (string) config('legacy.office_master_connection', 'office_master');
    }

    public function isUsable(): bool
    {
        return (int) ($this->DBTrue ?? 0) === 1
            && $this->DataBaseVersion !== null
            && $this->DataBaseVersion !== '0.0'
            && ($this->ExpirationDate === null || $this->ExpirationDate >= now()->format('Y-m-d'));
    }
}
