<?php

namespace App\Legacy\Module;

final class AppModule
{
    public const MODULE_TOTAL = 'MODULE_TOTAL';

    public const MODULE_PRINCIPAL = 'MODULE_PRINCIPAL';

    public const MODULE_DELOVODNIK = 'MODULE_DELOVODNIK';

    public const MODULE_KADROVIK = 'MODULE_KADROVIK';

    public const MODULE_KADROVIK_LITE = 'MODULE_KADROVIK_LITE';

    public const MODULE_SELFADMIN = 'MODULE_SELFADMIN';

    public const MODULE_SELFADMIN_LITE = 'MODULE_SELFADMIN_LITE';

    public const MODULE_OBRADA_IZVODA = 'MODULE_OBRADA_IZVODA';

    public const MODULE_POSTMAN = 'MODULE_POSTMAN';

    public const MODULE_RP = 'MODULE_RP';

    public const MODULE_PROCEDURE = 'MODULE_PROCEDURE';

    public const MODULE_TEXTS = 'MODULE_TEXTS';

    public const MODULE_PREUZIMANJE_PODATAKA = 'MODULE_PREUZIMANJE_PODATAKA';

    public const MODULE_DOGADJAJI = 'MODULE_DOGADJAJI';

    public const MODULE_ELMS = 'MODULE_ELMS';

    public const MODULE_FISKALNI = 'MODULE_FISKALNI';

    public const MODULE_CRM = 'MODULE_CRM';

    public const MODULE_TICKETING = 'MODULE_TICKETING';

    public const MODULE_TIKETI = 'MODULE_TIKETI';

    public const MODULE_OBRASCI = 'MODULE_OBRASCI';

    public const MODULE_TROSKOVNIK = 'MODULE_TROSKOVNIK';

    public const MODULE_OTPREMNICE = 'MODULE_OTPREMNICE';

    /**
     * @var array<string, list<string>>
     */
    private const MODULE_HIERARCHY = [
        self::MODULE_TOTAL => [
            self::MODULE_PRINCIPAL,
            self::MODULE_DELOVODNIK,
            self::MODULE_KADROVIK,
            self::MODULE_KADROVIK_LITE,
            self::MODULE_SELFADMIN,
            self::MODULE_SELFADMIN_LITE,
            self::MODULE_POSTMAN,
            self::MODULE_RP,
            self::MODULE_PROCEDURE,
            self::MODULE_TEXTS,
            self::MODULE_OBRADA_IZVODA,
            self::MODULE_PREUZIMANJE_PODATAKA,
            self::MODULE_DOGADJAJI,
            self::MODULE_ELMS,
            self::MODULE_FISKALNI,
            self::MODULE_CRM,
            self::MODULE_TICKETING,
            self::MODULE_TIKETI,
            self::MODULE_OBRASCI,
            self::MODULE_TROSKOVNIK,
            self::MODULE_OTPREMNICE,
        ],
        self::MODULE_PRINCIPAL => [self::MODULE_PRINCIPAL],
        self::MODULE_DELOVODNIK => [self::MODULE_DELOVODNIK],
        self::MODULE_KADROVIK => [self::MODULE_KADROVIK],
        self::MODULE_KADROVIK_LITE => [self::MODULE_KADROVIK_LITE],
        self::MODULE_SELFADMIN => [self::MODULE_SELFADMIN],
        self::MODULE_SELFADMIN_LITE => [self::MODULE_SELFADMIN_LITE],
        self::MODULE_POSTMAN => [self::MODULE_POSTMAN],
        self::MODULE_RP => [self::MODULE_RP],
        self::MODULE_PROCEDURE => [self::MODULE_PROCEDURE],
        self::MODULE_TEXTS => [self::MODULE_TEXTS],
        self::MODULE_OBRADA_IZVODA => [self::MODULE_OBRADA_IZVODA],
        self::MODULE_PREUZIMANJE_PODATAKA => [self::MODULE_PREUZIMANJE_PODATAKA],
        self::MODULE_DOGADJAJI => [self::MODULE_DOGADJAJI],
        self::MODULE_ELMS => [self::MODULE_ELMS],
        self::MODULE_FISKALNI => [self::MODULE_FISKALNI],
        self::MODULE_CRM => [self::MODULE_CRM],
        self::MODULE_TICKETING => [self::MODULE_TICKETING],
        self::MODULE_TIKETI => [self::MODULE_TIKETI],
        self::MODULE_OBRASCI => [self::MODULE_OBRASCI],
        self::MODULE_TROSKOVNIK => [self::MODULE_TROSKOVNIK],
        self::MODULE_OTPREMNICE => [self::MODULE_OTPREMNICE],
    ];

    /**
     * @var array<string, string>
     */
    private const MODULE_NAMES = [
        self::MODULE_PRINCIPAL => 'Principal',
        self::MODULE_DELOVODNIK => 'e-Delovodnik',
        self::MODULE_SELFADMIN => 'e-Fakture',
        self::MODULE_SELFADMIN_LITE => 'e-Fakture-lite',
        self::MODULE_POSTMAN => 'e-Poštar',
        self::MODULE_KADROVIK => 'Kadrovik',
        self::MODULE_KADROVIK_LITE => 'Kadrovik-lite',
        self::MODULE_RP => 'Robno poslovanje',
        self::MODULE_PROCEDURE => 'e-Procedure',
        self::MODULE_DOGADJAJI => 'Događaji',
        self::MODULE_ELMS => 'ELMS',
        self::MODULE_CRM => 'CRM',
        self::MODULE_TICKETING => 'e-Tiketi',
        self::MODULE_OBRASCI => 'Obrasci',
        self::MODULE_TROSKOVNIK => 'Troškovnik',
        self::MODULE_OTPREMNICE => 'e-Otpremnice',
    ];

    /**
     * @return list<string>
     */
    public static function getAllowedModules(string $module): array
    {
        return self::MODULE_HIERARCHY[$module] ?? [];
    }

    /**
     * @return list<string>
     */
    public static function getModuleList(): array
    {
        return self::MODULE_HIERARCHY[self::MODULE_TOTAL];
    }

    public static function getModuleName(string $module): string
    {
        return self::MODULE_NAMES[$module] ?? $module;
    }
}
