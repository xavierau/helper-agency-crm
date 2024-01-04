<?php

namespace Modules\AgencyCore\Entities;

use Anacreation\Organization\Traits\InOrganization;
use App\Traits\CommonScopes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContract\Entities\ContractType;
use Modules\AgencyCore\DataTransferObject\GlobalSearchResult;
use Modules\AgencyCore\Enums\ApplicantStatus;
use Modules\AgencyCore\Services\ChineseZodiac;
use Modules\AgencyCore\Services\Horoscope;
use Modules\UploadDocument\Contracts\HasUploadDocuments;
use Modules\UploadDocument\Contracts\HasUploadDocumentsInterface;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

/**
 * Modules\AgencyCore\Entities\Applicant
 *
 * @property int
 *                     $id
 * @property string
 *                     $name
 * @property string
 *                     $ref_number
 * @property string
 *                     $vcac_number
 * @property string|null
 *                     $hk_id
 * @property string|null
 *                     $passport
 * @property \Illuminate\Support\Carbon
 *                     $date_of_birth
 * @property \Illuminate\Support\Carbon|null
 *                     $date_of_release
 * @property \Illuminate\Support\Carbon|null
 *                     $visa_expiry_date
 * @property string
 *                     $gender
 * @property string
 *                     $nationality
 * @property string
 *                     $current_country
 * @property string|null
 *                     $available_date
 * @property string
 *                     $marital_status
 * @property float|null
 *                     $height
 * @property string|null
 *                     $weight
 * @property string|null
 *                     $religion
 * @property string|null
 *                     $mobile
 * @property string|null
 *                     $email
 * @property string|null
 *                     $facebook
 * @property string|null
 *                     $father_name
 * @property float|null
 *                     $father_age
 * @property string|null
 *                     $mother_name
 * @property float|null
 *                     $mother_age
 * @property string|null
 *                     $number_of_sons
 * @property string|null
 *                     $age_of_sons
 * @property string|null
 *                     $number_of_daughters
 * @property string|null
 *                     $age_of_daughters
 * @property string|null
 *                     $primary_school
 * @property string|null
 *                     $primary_school_graduation_year
 * @property string|null
 *                     $secondary_school
 * @property string|null
 *                     $secondary_school_graduation_year
 * @property string|null
 *                     $college
 * @property string|null
 *                     $college_graduation_year
 * @property string|null
 *                     $college_major
 * @property string|null
 *                     $english
 * @property string|null
 *                     $cantonese
 * @property string|null
 *                     $mandarin
 * @property string|null
 *                     $other_language
 * @property string
 *                     $status
 * @property int
 *                     $is_approved
 * @property \Illuminate\Support\Carbon|null
 *                     $created_at
 * @property \Illuminate\Support\Carbon|null
 *                     $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Contract[]
 *                          $contracts
 * @property-read int|null
 *                          $contracts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\DomesticDuty[]
 *                       $duties
 * @property-read int|null
 *                          $duties_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\ApplicantExperience[]
 *                $experiences
 * @property-read int|null
 *                          $experiences_count
 * @property-read int
 *                          $age
 * @property-read string
 *                          $hash
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Job[]
 *                          $jobs
 * @property-read int|null
 *                          $jobs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Anacreation\Organization\Entities\Organization[]
 *                 $organizations
 * @property-read int|null
 *                          $organizations_count
 * @method static Builder|Applicant age($range)
 * @method static Builder|Applicant betweenAge($ages)
 * @method static Builder|Applicant excludeIds($ids)
 * @method static Builder|Applicant maxAge($maxAge)
 * @method static Builder|Applicant minAge($minAge)
 * @method static Builder|Applicant newModelQuery()
 * @method static Builder|Applicant newQuery()
 * @method static Builder|Applicant query()
 * @method static Builder|Applicant requestWith($keyword = null)
 * @method static Builder|Applicant search($searchColumns, $keyword = null)
 * @method static Builder|Applicant whereAgeOfDaughters($value)
 * @method static Builder|Applicant whereAgeOfSons($value)
 * @method static Builder|Applicant whereAvailableDate($value)
 * @method static Builder|Applicant whereCantonese($value)
 * @method static Builder|Applicant whereCollege($value)
 * @method static Builder|Applicant whereCollegeGraduationYear($value)
 * @method static Builder|Applicant whereCollegeMajor($value)
 * @method static Builder|Applicant whereCreatedAt($value)
 * @method static Builder|Applicant whereCurrentCountry($value)
 * @method static Builder|Applicant whereDateOfBirth($value)
 * @method static Builder|Applicant whereDateOfRelease($value)
 * @method static Builder|Applicant whereEmail($value)
 * @method static Builder|Applicant whereEnglish($value)
 * @method static Builder|Applicant whereFacebook($value)
 * @method static Builder|Applicant whereFatherAge($value)
 * @method static Builder|Applicant whereFatherName($value)
 * @method static Builder|Applicant whereGender($value)
 * @method static Builder|Applicant whereHeight($value)
 * @method static Builder|Applicant whereHkId($value)
 * @method static Builder|Applicant whereId($value)
 * @method static Builder|Applicant whereIsApproved($value)
 * @method static Builder|Applicant whereMandarin($value)
 * @method static Builder|Applicant whereMaritalStatus($value)
 * @method static Builder|Applicant whereMobile($value)
 * @method static Builder|Applicant whereMotherAge($value)
 * @method static Builder|Applicant whereMotherName($value)
 * @method static Builder|Applicant whereName($value)
 * @method static Builder|Applicant whereNationality($value)
 * @method static Builder|Applicant whereNumberOfDaughters($value)
 * @method static Builder|Applicant whereNumberOfSons($value)
 * @method static Builder|Applicant whereOtherLanguage($value)
 * @method static Builder|Applicant wherePassport($value)
 * @method static Builder|Applicant wherePrimarySchool($value)
 * @method static Builder|Applicant wherePrimarySchoolGraduationYear($value)
 * @method static Builder|Applicant whereRefNumber($value)
 * @method static Builder|Applicant whereReligion($value)
 * @method static Builder|Applicant whereSecondarySchool($value)
 * @method static Builder|Applicant whereSecondarySchoolGraduationYear($value)
 * @method static Builder|Applicant whereStatus($value)
 * @method static Builder|Applicant whereUpdatedAt($value)
 * @method static Builder|Applicant whereVcacNumber($value)
 * @method static Builder|Applicant whereVisaExpiryDate($value)
 * @method static Builder|Applicant whereWeight($value)
 * @mixin \Eloquent
 * @property string|null
 *                                                       $thumbnail
 * @property string|null
 *                                                       $full_body_photo
 * @method static Builder|Applicant whereFullBodyPhoto($value)
 * @method static Builder|Applicant whereThumbnail($value)
 * @property string|null
 *                                                       $passport_number
 * @property \Illuminate\Support\Carbon|null
 *                                                       $passport_issued_date
 * @property \Illuminate\Support\Carbon|null
 *                                                       $passport_expiring_date
 * @property string|null
 *                                                       $passport_issued_place
 * @property string|null
 *                                                       $place_of_birth
 * @property string|null
 *                                                       $hk_mobile
 * @property string|null
 *                                                       $emergency_contact_name
 * @property string|null
 *                                                       $emergency_contact_relation
 * @property string|null
 *                                                       $emergency_contact_number
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyCore\Entities\Address[]
 *                                                            $addresses
 * @property-read int|null
 *                                                            $addresses_count
 * @property-read \Modules\AgencyCore\Entities\Address|null
 *                                                            $address
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[]
 *                $media
 * @property-read int|null
 *                                                            $media_count
 * @method static Builder|Applicant inOrganization(\Anacreation\Organization\Entities\Organization $organization, bool $include_sub_org = false)
 * @method static Builder|Applicant whereEmergencyContactName($value)
 * @method static Builder|Applicant whereEmergencyContactNumber($value)
 * @method static Builder|Applicant whereEmergencyContactRelation($value)
 * @method static Builder|Applicant whereHkMobile($value)
 * @method static Builder|Applicant wherePassportExpiringDate($value)
 * @method static Builder|Applicant wherePassportIssuedDate($value)
 * @method static Builder|Applicant wherePassportIssuedPlace($value)
 * @method static Builder|Applicant wherePassportNumber($value)
 * @method static Builder|Applicant wherePlaceOfBirth($value)
 * @property string $hk_code
 * @property string $pt_code
 * @property int|null $supplier_id
 * @property string|null $location
 * @property string|null $surname
 * @property string|null $middle_name
 * @property string|null $given_name
 * @property string $sex
 * @property string|null $zodiac
 * @property string|null $horoscope
 * @property bool $afraid_of_dog
 * @property bool $eat_pork
 * @property string|null $spouse_name
 * @property int|null $spouse_age
 * @property string|null $spouse_occupation
 * @property string|null $father_occupation
 * @property string|null $mother_occupation
 * @property int|null $number_of_brothers
 * @property int|null $number_of_sisters
 * @property int|null $position_in_family
 * @property int|null $number_of_children
 * @property int|null $number_of_boy
 * @property string|null $age_of_boy
 * @property int|null $number_of_girl
 * @property string|null $age_of_girl
 * @property string|null $hkid
 * @property string|null $place_of_issue
 * @property \Illuminate\Support\Carbon|null $passport_expiry_date
 * @property string|null $highest_education
 * @property string|null $graduation_year
 * @property string|null $major
 * @property string|null $school_name
 * @property bool $is_featured
 * @property string|null $random_identifier
 * @property-read ContractType|null $defaultContractType
 * @property-read mixed $all_duties
 * @property-read string $current_location
 * @property-read string $full_body
 * @property-read \Modules\AgencyCore\Entities\Supplier|null $supplier
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\UploadDocument\Entities\Document[] $uploadDocuments
 * @property-read int|null $upload_documents_count
 * @method static Builder|Applicant available()
 * @method static Builder|Applicant currentLocation(string $location)
 * @method static Builder|Applicant featured()
 * @method static Builder|Applicant isApproved(?bool $value)
 * @method static Builder|Applicant name(?string $value)
 * @method static Builder|Applicant status(?string $value)
 * @method static Builder|Applicant whereAddress($value)
 * @method static Builder|Applicant whereAfraidOfDog($value)
 * @method static Builder|Applicant whereAgeOfBoy($value)
 * @method static Builder|Applicant whereAgeOfGirl($value)
 * @method static Builder|Applicant whereEatPork($value)
 * @method static Builder|Applicant whereFatherOccupation($value)
 * @method static Builder|Applicant whereGivenName($value)
 * @method static Builder|Applicant whereGraduationYear($value)
 * @method static Builder|Applicant whereHighestEducation($value)
 * @method static Builder|Applicant whereHkCode($value)
 * @method static Builder|Applicant whereHoroscope($value)
 * @method static Builder|Applicant whereIsFeatured($value)
 * @method static Builder|Applicant whereLocation($value)
 * @method static Builder|Applicant whereMajor($value)
 * @method static Builder|Applicant whereMiddleName($value)
 * @method static Builder|Applicant whereMotherOccupation($value)
 * @method static Builder|Applicant whereNumberOfBoy($value)
 * @method static Builder|Applicant whereNumberOfBrothers($value)
 * @method static Builder|Applicant whereNumberOfChildren($value)
 * @method static Builder|Applicant whereNumberOfGirl($value)
 * @method static Builder|Applicant whereNumberOfSisters($value)
 * @method static Builder|Applicant wherePassportExpiryDate($value)
 * @method static Builder|Applicant wherePlaceOfIssue($value)
 * @method static Builder|Applicant wherePositionInFamily($value)
 * @method static Builder|Applicant wherePtCode($value)
 * @method static Builder|Applicant whereRandomIdentifier($value)
 * @method static Builder|Applicant whereSchoolName($value)
 * @method static Builder|Applicant whereSex($value)
 * @method static Builder|Applicant whereSpouseAge($value)
 * @method static Builder|Applicant whereSpouseName($value)
 * @method static Builder|Applicant whereSpouseOccupation($value)
 * @method static Builder|Applicant whereSupplierId($value)
 * @method static Builder|Applicant whereSurname($value)
 * @method static Builder|Applicant whereZodiac($value)
 */
class Applicant extends Model implements HasMedia, HasUploadDocumentsInterface
{
    protected $table = "applicants";

    use CommonScopes, InOrganization, InteractsWithMedia, HasUploadDocuments, SoftDeletes;

    private const hashKey = '12sdfasdf';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['age', 'hash'];

    protected $casts = [
        'afraid_of_dog'                      => 'boolean',
        'smoke_and_drink'                    => 'boolean',
        'eat_pork'                           => 'boolean',
        'date_of_birth'                      => 'date',
        'date_of_release'                    => 'date',
        'education'                          => SchemalessAttributes::class,
        'emergency'                          => SchemalessAttributes::class,
        'family'                             => SchemalessAttributes::class,
        'holiday_arrangement'                => SchemalessAttributes::class,
        'is_approved'                        => 'boolean',
        'is_featured'                        => 'boolean',
        'personal_document'                  => SchemalessAttributes::class,
        'preference'                         => SchemalessAttributes::class,
        'status'                             => ApplicantStatus::class,
        'questions'                          => SchemalessAttributes::class,
    ];

    const ThumbnailMediaCollection = "thumbnail";
    const FullBodyMediaCollection = "full_body";

    // region Medialibrary Collection Definition

    public function registerMediaCollections(): void
    {

        // you can define as many collections as needed
        $this->addMediaCollection(static::ThumbnailMediaCollection);
        $this->addMediaCollection(static::FullBodyMediaCollection);
    }


    // endregion

    //region Relation

    public function contracts(): BelongsToMany
    {
        return $this->belongsToMany(Contract::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(ApplicantExperience::class);
    }

    public function duties(): BelongsToMany
    {
        return $this->belongsToMany(DomesticDuty::class);
    }

    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class)
            ->withPivot([
                'status',
                'channel',
            ])
            ->withTimestamps();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function defaultContractType(): BelongsTo
    {
        return $this->belongsTo(
            ContractType::class,
            'default_contract_type_id'
        );
    }

    //endregion

    //region Accessor
    public function getAgeAttribute(): int
    {
        return Carbon::now()->diffInyears($this->attributes['date_of_birth']);
    }

    public function getHashAttribute(): string
    {
        if ($this->random_identifier) {
            return $this->random_identifier;
        }

        $this->random_identifier = Str::random(8);
        $this->save();


        return $this->random_identifier;
    }

    public function getThumbnailAttribute($value): string
    {
        return $this->getMedia(static::ThumbnailMediaCollection)?->last()?->getUrl() ?? ($value ?? '');
    }

    public function getFullBodyAttribute($value): string
    {
        return $this->getMedia(static::FullBodyMediaCollection)?->last()?->getUrl() ?? ($value ?? '');
    }

    public function getNameAttribute()
    {
        return collect([
            $this->given_name,
            $this->middle_naem,
            $this->surname
        ])
            ->map(fn($name) => trim($name))
            ->map(fn($name) => ucwords($name))
            ->join(' ');
    }

    public function getChineseZodiacAttribute(): string
    {
        return $this->date_of_birth ? __(ChineseZodiac::get($this->date_of_birth)) : '';
    }

    public function getAllDutiesAttribute()
    {

        return $this->experiences
            ->reduce(function ($carry, $experience) {
                $carry->push($experience->duties);
                return $carry;
            }, collect([]))
            ->flatten()
            ->map(fn($i) => __(ucwords($i->label)))
            ->unique()
            ->sort();
    }

    public function getCurrentLocationAttribute(): string
    {

        return $this->location ?? "";
    }

    public function getHighestEducationAttribute(): string
    {
        return $this->education?->highest_education ?? '';
    }

    public function getHoroscopeAttribute(): string
    {
        return $this->getHoroscope();
    }


    //endregion

    //region Scope

    public function scopeSearchGlobally(Builder $query, ?string $value): Builder
    {
        return $query
            ->whereRaw("LOWER(CONCAT(given_name,' ' ,middle_name,' ',surname)) LIKE LOWER(CONCAT('%','{$value}','%'))")
            ->orWhere('personal_document->hk_id', 'like', "%{$value}%");
    }

    public function scopeSearch(Builder $query, Request $request): Builder
    {
        return $query
            ->when($request->get('hk_code'), fn($query, $keyword) => $query->where('hk_code', 'like', "%{$keyword}%"))
            ->when($request->get('overseas'), fn($query, $keyword) => $query->whereHas('experiences', function ($q) use ($keyword) {
                $q->whereIn('location', $keyword);
            }))
            ->when($request->get('marital_status'), fn($query, $keyword) => $query->where(
                'marital_status',
                $keyword
            ))
            ->when($request->get('religion'), fn($query, $keyword) => $query->where(
                'religion',
                $keyword
            ))
            ->when($request->get('nationality'), fn($query, $keyword) => $query->where(
                'nationality',
                $keyword
            ))
            ->when($request->get('education') and $request->get('education') !== 'any', fn($query) => $query->where(
                'education->highest_education',
                $request->get('education')
            ))
            ->when($request->get('min_height') || $request->get('max_height'), fn($query) => $query->whereBetween('height', [$request->get('min_height') ?? 0, $request->get('max_height') ?? PHP_INT_MAX]))
            ->when($request->get('min_weight') || $request->get('max_weight'), fn($query) => $query->whereBetween('weight', [$request->get('min_weight') ?? 0, $request->get('max_weight') ?? PHP_INT_MAX]))
            ->when($request->get('duties'), fn($query, array $labels) => $query->whereHas('experiences.duties', fn($sq) => $sq->whereIn(
                'label',
                $labels
            )))
            ->when(($request->get('min_weight') || $request->get('max_weight')), fn($query) => $query->whereBetween('weight', [$request->query('min_weight') ?? 0, $request->query('max_weight') ?? PHP_INT_MAX]))
            ->when(($request->get('min_height') || $request->get('max_height')), fn($query) => $query->whereBetween('height', [$request->query('min_height') ?? 0, $request->query('max_height') ?? PHP_INT_MAX]));
    }

    public function scopeWithExtraAttributes(): Builder
    {
        return $this->family->modelScope();
    }

    public function scopeAge(Builder $query, string $range): Builder
    {
        $array = explode(
            ',',
            $range
        );
        $start = $array[0] ?? null;
        $end = $array[1] ?? null;

        if (!$start) {
            return $query;
        }

        $startDate = Carbon::now()->addYears(-$start)->startOfDay();


        if ($end) {
            $endDate = Carbon::now()->addYears(-$end)->startOfDay();

            return $query->whereBetween(
                'date_of_birth',
                [$endDate, $startDate]
            );
        }

        return $query->where(
            'date_of_birth',
            '>',
            $startDate
        );
    }

    public function scopeMaxAge(Builder $query, string $maxAge): Builder
    {
        $date = Carbon::now()->addYears(-$maxAge)->startOfDay();

        return $query->where(
            'date_of_birth',
            '>',
            $date
        );
    }

    public function scopeMinAge(Builder $query, string $minAge): Builder
    {
        $date = Carbon::now()->addYears(-$minAge)->startOfDay();

        return $query->where(
            'date_of_birth',
            '<',
            $date
        );
    }

    public function scopeBetweenAge(Builder $query, ...$ages): Builder
    {

        $minAge = $ages[0];
        $maxAge = $ages[1];
        $end_date = Carbon::now()->addYears(-$minAge)->startOfDay();
        $start_date = Carbon::now()->addYears(-$maxAge)->startOfDay();

        return $query->whereBetween(
            'date_of_birth',
            [$start_date, $end_date]
        );
    }

    public function scopeDuties(Builder $query, array|string|null $duties): Builder
    {
        if ($duties === null) {
            return $query;
        }

        collect($duties)
            ->tap(function ($collection) {
                Log::info('duty collection: ', $collection->toArray());
            })
            ->each(function ($dutyId, $index) use ($query) {
                $query->whereHas('duties', function ($sq) use ($dutyId) {
                    $sq->where('id', $dutyId);
                });
            });

        return $query;


        return $query->whereIn(
            'id',
            function ($q) use ($array) {
                $q->select('applicant_id')
                    ->from('applicant_domestic_duty')
                    ->whereIn(
                        'domestic_duty_id',
                        $array
                    );
            }
        );
    }

    public function scopeExcludeIds(Builder $query, ...$ids): Builder
    {
        return $query->whereNotIn(
            'id',
            $ids
        );
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_approved', true)
            ->where('status', 'active');
    }

    public function scopeCurrentLocation(Builder $query, string $location): Builder
    {
        return ($location === 'local') ?
            $query->where('current_country', 'hong kong') :
            $query->where('current_country', '<>', 'hong kong');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query
            ->where('is_featured', true)
            ->latest();
    }

    public function scopeStatus(Builder $query, ?string $value): Builder
    {

        if ($value) {
            $query->where('status', $value);
        }


        return $query;

    }

    public function scopeIsApproved(Builder $query, ?bool $value): Builder
    {

        if ($value === null) {
            return $query;
        }

        $query->where('is_approved', $value);


        return $query;

    }

    public function scopeName(Builder $query, ?string $value): Builder
    {


        if ($value) {
            $sql = "LOWER(CONCAT(given_name, ' ', middle_name, ' ', surname)) LIKE CONCAT('%', LOWER('{$value}'), '%')";

            Log::debug('sql: ' . $sql);
            $query->whereRaw($sql);
        }


        return $query;

    }

    public function scopeNationality(Build $query, ?string $value): Builder
    {
        return $query->where('nationality',
            'like',
            "%{$value}%");
    }

//endregion

    // region Helper

    public static function globalSearch(?string $value): Collection
    {

        $instance = new static();

        return $instance->searchGlobally($value)
            ->get()
            ->map(fn(Applicant $applicant) => new GlobalSearchResult($applicant));

    }

    /**
     * @return \Modules\AgencyContract\Entities\ContractType
     */
    public function getContractType(): ContractType
    {
        return $this->contractType ?? $this->calculateContractType();
    }

    /**
     * @return \Modules\AgencyContract\Entities\ContractType
     */
    private function calculateContractType(): ContractType
    {
        if ($this->current_country !== "hong hong") {
            return ContractType::where(
                'label',
                'Overseas'
            )->first();
        }

        return ContractType::where(
            'label',
            'Local'
        )->first();
    }

    public function getHoroscope(): string
    {

        return $this->date_of_birth ? __(Horoscope::get($this->date_of_birth)) : '';
    }

// endregion
}
