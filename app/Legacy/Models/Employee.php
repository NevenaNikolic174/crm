<?php

namespace App\Legacy\Models;

use App\Legacy\Models\Concerns\UsesLicenseConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $ID
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $defaultEmail
 * @property string|null $businessEmail
 * @property int|null $archived
 * @property int|null $eksterni
 * @property-read User|null $user
 */
class Employee extends Model
{
    use UsesLicenseConnection;

    protected $table = 'employee';

    protected $primaryKey = 'ID';

    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'create_date',
        'defaultEmail',
        'businessEmail',
        'remark',
        'employeeImg',
        'archived',
        'eksterni',
    ];

    /**
     * @return HasOne<User, $this>
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'FK_employee', 'ID');
    }

    public function fullName(): string
    {
        return trim(($this->firstname ?? '').' '.($this->lastname ?? ''));
    }
}
