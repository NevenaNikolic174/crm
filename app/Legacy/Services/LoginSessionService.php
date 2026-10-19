<?php

namespace App\Legacy\Services;

use App\Legacy\License\LicenseConnection;
use App\Legacy\License\OfficeMasterRepository;
use App\Legacy\Models\Employee;
use App\Legacy\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Throwable;

final class LoginSessionService
{
    /**
     * @var array<string, string>
     */
    private const USER_PRIVILEGES = [
        'newDocument' => 'newDocument',
        'newFolder' => 'newFolder',
        'accept_conditions' => 'accept_conditions',
        'employeeChange' => 'employeeChange',
        'moreInfo' => 'moreInfo',
        'contactChange' => 'contactChange',
        'taskType' => 'edit_type',
        'obligationType' => 'editOblType',
        'institutions' => 'institutions',
        'locationAdd' => 'locationAdd',
        'resourcePriv' => 'resourcePriv',
        'newDelovodnik' => 'newDelovodnik',
        'delovodnikKecSend' => 'delovodnikKecSend',
        'faktureUplatePriv' => 'faktureUplatePriv',
        'employeeStatisticsPriv' => 'statisticsPriv',
        'saMozeDaSalje' => 'saMozeDaSalje',
        'saVidiPrimljene' => 'saVidiPrimljene',
        'saRacunovodja' => 'saRacunovodja',
        'hrMozeDaVidiKadrovik' => 'hrMozeDaVidiKadrovik',
        'hrMozeDaMenjaKadrovik' => 'hrMozeDaMenjaKadrovik',
        'robnoObradaZapisnika' => 'robnoObradaZapisnika',
        'robnoKalkulacija' => 'robnoKalkulacija',
        'administrationArchiveBook' => 'administrationArchiveBook',
        'eArchive' => 'eArchive',
        'saDone' => 'saDone',
        'obradaIzvoda' => 'obradaIzvoda',
        'frCreate' => 'frCreate',
        'frViewCreated' => 'frViewCreated',
        'resursAdmin' => 'resursAdmin',
        'procedureView' => 'procedureView',
        'lightPrincipal' => 'lightPrincipal',
        'eksterni' => 'eksterni',
        'crm_manager' => 'crmManager',
    ];

    /**
     * @var array<string, string>
     */
    private const SUPERVISOR_PRIVILEGES = [
        'manage_presence' => 'supManagePresence',
        'manage_absence' => 'supManageAbsence',
        'manage_orv' => 'supManageORV',
        'manage_requests_absences' => 'supManageRequestsAbsences',
        'manage_retroaktivno_godisnji_odmor_i_odsustvo_sa_mesta_rada' => 'supManageRetroaktivnoGodisnjiOdmorIOdsustvoSaMestaRada',
    ];

    public function __construct(
        private readonly OfficeMasterRepository $officeMaster,
    ) {}

    public function store(User $user): void
    {
        $db = LicenseConnection::db();
        $employee = $user->FK_employee ? Employee::query()->find($user->FK_employee) : null;
        $modules = session('licenseModule');
        $modules = is_array($modules) ? $modules : [];
        $isGuest = $user->isGuest();

        Session::put('loggedId', $user->id);
        Session::put('username', $user->username);
        Session::put('realRole', $user->role);
        Session::put('userRole', 'USER');

        Session::put('firstname', $employee?->firstname);
        Session::put('lastname', $employee?->lastname);
        Session::put('employeeID', $employee?->ID);
        Session::put('defaultName', $employee?->defaultEmail);
        Session::put('newCompanyFolder', $user->newFolder ?? null);

        foreach (self::USER_PRIVILEGES as $column => $sessionKey) {
            Session::put($sessionKey, $user->{$column} ?? null);
        }

        $finances = $user->finances ?? null;

        if ((int) ($modules['MODULE_SELFADMIN'] ?? 0) === 1 && ! $isGuest) {
            $finances = 1;
        }

        Session::put('finances', $finances);

        $module = (int) ($modules[(string) config('legacy.module', 'MODULE_CRM')] ?? 0) === 1 && ! $isGuest
            ? (string) config('legacy.module_label', 'CRM')
            : (string) config('legacy.default_module', 'Principal');

        Session::put('module', $module);

        Session::put('allAdminOrSadmin', $db->table('users')
            ->leftJoin('employee', 'users.FK_employee', '=', 'employee.ID')
            ->whereIn('users.role', ['SADMIN', 'ADMIN'])
            ->orderBy('users.role', 'desc')
            ->get());

        Session::put('usersWithHRPrivileges', $db->table('users')
            ->leftJoin('employee', 'users.FK_employee', '=', 'employee.ID')
            ->where('users.hrMozeDaMenjaKadrovik', 1)
            ->get());

        $supervisorIds = $db->table('supervisors')->pluck('employeeID')->all();
        Session::put('supervisorArr', json_encode($supervisorIds));

        $supervisor = $employee === null ? null : $db->table('supervisors')->where('employeeID', $employee->ID)->first();

        foreach (self::SUPERVISOR_PRIVILEGES as $column => $sessionKey) {
            Session::put($sessionKey, (int) ($supervisor->{$column} ?? 0));
        }

        Session::put('languages', $this->officeMaster->languagesInUse()->toJson());

        $countryCode = (string) ($db->table('general_settings')->value('CountryCode') ?? '');
        Session::put('CountryCode', $countryCode === '' || strtoupper($countryCode) === 'RS' ? 'rs' : $countryCode);

        Session::put('localeLang', $this->resolveLocale($user));

        $this->logLogin($user, $employee);

        Session::save();
    }

    private function resolveLocale(User $user): ?string
    {
        $db = LicenseConnection::db();

        $language = $user->FK_employee
            ? $db->table('app_language')->where('employee_id', $user->FK_employee)->value('language')
            : null;

        if ($language === null) {
            $language = $db->table('general_settings')->value('default_language');
        }

        return $language === null ? null : (string) $language;
    }

    private function logLogin(User $user, ?Employee $employee): void
    {
        try {
            LicenseConnection::db()->table('login_log')->insert([
                'userID' => $user->id,
                'employeeID' => $employee?->ID,
                'loginTime' => Carbon::now(),
                'ipAddress' => get_visitor_IP(),
            ]);
        } catch (Throwable) {
        }
    }
}
