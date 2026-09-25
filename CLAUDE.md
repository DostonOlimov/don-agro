# CLAUDE.md

This file guides Claude Code when it works in this repository.

## What this is

**don-agro** is a Laravel 8 monolith for grain and crop quality certification in Uzbekistan. It handles applications (*ariza*), sampling acts (AKT), lab test programs, lab results and protocols, decisions, quality certificates (*sifat sertifikati*) and storage-capacity conclusions. Most of the UI is server-rendered Blade. The domain vocabulary is Uzbek (labels, flash messages and many identifiers), so keep that language when you add user-facing strings.

It runs locally under **OSPanel** on Windows (`.osp/` is OSPanel config and is gitignored). The database is MySQL. Settings live in `.env`; `.env.example` is the template.

## Commands

```bash
composer install
php artisan serve                 # or open through the OSPanel vhost
npm install && npm run dev        # Laravel Mix: resources/js/app.js -> public/js (watch / prod also exist)
php artisan test                  # PHPUnit. Only the example tests exist; phpunit.xml uses the real DB (the sqlite lines are commented out)
php artisan test --filter=ExampleTest
php artisan route:list
```

No linter or formatter is configured apart from `.styleci.yml`, which uses the Laravel preset.

## Architecture

### Routing
- `routes/web.php` holds almost every route. They sit inside one `auth` middleware group and use the `'\App\Http\Controllers\XController@method'` string syntax, because `RouteServiceProvider` does not set `$namespace`. The URLs follow a fixed shape per module: `/{module}/list`, `/add`, `/store`, `/list/edit/{id}`, `/list/edit/update/{id}`, and `/list/delete/{id}`, where **delete is a GET request**.
- `routes/api.php` serves a REST API at `/api/v1/*`. `POST /api/v1/login` issues a Sanctum token. The other endpoints are `apiResource` controllers in `app/Http/Controllers/Api/V1`. They use the query filters in `app/Filters/V1`, the JSON resources in `app/Http/Resources/V1`, and the response helpers in `Api/Traits/ApiResponse.php`.
- `RouteServiceProvider` does **not** load `routes/admin.php` or `routes/external/*`. Those files, along with `app/Http/Controllers/Admin/*` (vehicles, invoices, driver licenses and similar), are code left over from another project. Leave them alone unless a task is about them.
- Filament v2 provides a separate admin panel at `/admin` (`app/Filament/Resources`, `config/filament.php`).

### The certification workflow
The main flow runs roughly in this order. Each step has its own controller and model:
`Application` → `AKT` (sampling act) → `TestPrograms` → `TestProgramsLaboratoryController` (the lab accepts or rejects) → `LabBayonnoma` → `LaboratoryResult` / `LaboratoryResultData` → `LaboratoryProtocol` / `LaboratoryFinalResults` → `Decision` / `FinalResult` → `Sertificate`. Separate modules handle `SifatSertificates` (online quality certificates) and `StorageCapacityConclusion`.

Reference data: `CropsName`, `CropsType`, `CropsGeneration`, `CropData`, `Nds` (standards), `Indicator`, `Requirement`, `Laboratories`, `DecisionMaker`, `OrganizationCompanies`, `PreparedCompanies`, `Region`/`Area` (states and cities).

### Implicit behavior to know about
- **Global scopes that depend on the session.** `Application`, `TestPrograms`, `Sertificate`, `FinalResult`, `LaboratoryFinalResults` and others filter by `whereYear('date', session('year') ?? date('Y'))`. The user picks the year (the *hosil yili*, harvest year) through `POST /change-year`. `Application` also hides `STATUS_DELETED` and, for `User::ROLE_CITY_EMPLOYEE`, limits rows to the user's `state_id`. `User` has a status global scope too. Use `withoutGlobalScopes()` when a query needs to cross years. To add a new harvest year, update **both** `CropData::getYear()` in `app/Models/CropData.php`, which feeds forms and reports, and the hard-coded dropdown in `resources/views/layouts/blocks/navbar.blade.php`.
- **Locale**: `POST /change-language` stores `session('language')`, and the `SetLocale` middleware applies it. Translations live in `resources/lang/{uz,ru,en,krill}`, where `krill` is Uzbek Cyrillic.
- **Roles are integer constants on `App\Models\User`**: `ROLE_CUSTOMER=30`, `STATE_EMPLOYEE=45`, `ROLE_ADMIN_EMPLOYEE=50`, `ROLE_CITY_EMPLOYEE=54`, `ROLE_SERTIFICATE_DIRECTOR=55`, `ROLE_INSPECTION_DIROCTOR=60`, `ROLE_LABORATORY_DIRECTOR=90`, `ROLE_LABORATORY_EMPLOYEE=91`, `ROLE_LABORATORY_ADMIN=99`. Controllers often branch on `$user->role` directly. Policies in `app/Policies` (registered in `AuthServiceProvider`) cover `User`, `Application`, `OrganizationCompanies`, `TestPrograms` and `LaboratoryResult`, and every policy's `before()` lets admins through.
- **Two `User` classes exist**: `App\Models\User` is the current one. `App\User` and the `App\tbl_*` classes are legacy, but some controllers still import them. Use `App\Models\User` in new code.
- Status and type values are class constants with `getStatus()`/`getType()` label helpers and `status_name`/`status_color` accessors (see `Application`).
- `app/Http/helpers.php` is autoloaded through composer `files`. It holds global constants (region IDs, date formats) and helper functions.

### Output
- PDFs come from `barryvdh/laravel-dompdf`. They go through `app/Services/PdfGenerator*.php` and use the `resources/views/layouts/pdf.blade.php` layout. QR codes come from `simplesoftwareio/simple-qrcode`.
- Excel exports use `maatwebsite/excel` (`app/Exports`). `ReportController` builds the reports and the regional and city exports.
- Uploads go through the `AttachmentService` classes (`app/Services`, `app/Http/Services`) and the `HasAttachment` model trait.
- Activity logging uses `spatie/laravel-activitylog` (see the `Models/Traits/LogsActivity` trait).

### Database
`database/migrations` covers **only part** of the schema. It has the Laravel and Passport tables plus a few 2025 additions: products, orders, customers, and storage-capacity conclusions. Most domain tables predate the migrations and exist only in the live DB. Look at the model's `$table` and `$fillable` before you assume columns, and add a migration for any new schema change.

### Frontend
Blade views are in `resources/views/<module>/`, with layouts in `resources/views/layouts/app.blade.php` and `front.blade.php`. They use Bootstrap 5 and jQuery, and AJAX endpoints such as `/getcityfromstate` and `/gettypefromname` fill the dependent dropdowns. Vue is installed but barely used.

## Conventions and quirks
- Copy the style of the controller next to the one you're editing: CRUD methods have names like `list`, `add`, `store`, `edit`, `update` and `destory` (the misspelling is intentional and route strings refer to it).
- Validation is done inline with `$request->validate()` and the custom rules in `app/Rules`, such as `UniqueAppNumber` and `CheckLaboratoryNumber`.
- `composer.lock` is gitignored.
