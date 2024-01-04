<?php

namespace Modules\AgencyContract\Entities;

use Anacreation\Workflow\Contracts\HasWorkflowInterface;
use Anacreation\Workflow\Entities\Transition;
use Anacreation\Workflow\Traits\HasWorkflow;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Modules\AgencyContractDate\Entities\ContractDate;
use Modules\AgencyContractDate\Entities\ContractDateValue;
use Modules\AgencyContractDoc\Entities\ContractDoc;
use Modules\AgencyContractDoc\Entities\ContractDocValue;
use Modules\AgencyCore\DataTransferObject\GlobalSearchResult;
use Modules\AgencyCore\Entities\Account;
use Modules\AgencyCore\Entities\Address;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyCore\Entities\Requirement;
use Modules\AgencyFinance\Entities\Invoice;
use Modules\UploadDocument\Contracts\HasUploadDocuments;
use Modules\UploadDocument\Contracts\HasUploadDocumentsInterface;

/**
 * Modules\AgencyContract\Entities\Contract
 *
 * @property int
 *                    $id
 * @property string
 *                    $contract_number
 * @property string|null
 *                    $start_date
 * @property string|null
 *                    $end_date
 * @property int
 *                    $applicant_id
 * @property int
 *                    $residence_area
 * @property int
 *                    $number_of_bedrooms
 * @property int
 *                    $number_of_adult
 * @property int
 *                    $number_of_elderly
 * @property int
 *                    $number_of_children
 * @property string|null
 *                    $dayoff_arrangement
 * @property string|null
 *                    $accommodation_type
 * @property int|null
 *                    $accommodation_value
 * @property string|null
 *           $expected_arrival_date
 * @property int
 *                    $client_id
 * @property int|null
 *                    $address_id
 * @property int
 *                    $contract_type_id
 * @property \Illuminate\Support\Carbon|null
 *                    $created_at
 * @property \Illuminate\Support\Carbon|null
 *                    $updated_at
 * @property-read Account
 *                         $account
 * @property-read Address|null
 *                         $address
 * @property-read Applicant
 *                         $applicant
 * @property-read Client
 *                         $client
 * @property-read \Anacreation\Workflow\Entities\CurrentState|null
 *                         $currentState
 * @property-read \Illuminate\Database\Eloquent\Collection|ContractDate[]
 *                         $dates
 * @property-read int|null
 *                         $dates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|ContractDoc[]
 *                         $documents
 * @property-read int|null
 *                         $documents_count
 * @property-read \Anacreation\Workflow\Entities\State
 *                         $current_state
 * @property-read string
 *                         $status
 * @property-read Collection
 *                         $transitions
 * @property-read \Illuminate\Database\Eloquent\Collection|Client[]
 *                         $residents
 * @property-read int|null
 *                         $residents_count
 * @property-read \Illuminate\Database\Eloquent\Collection|ContractDocValue[]
 *                         $storedDocuments
 * @property-read int|null
 *                $stored_documents_count
 * @property-read \Modules\AgencyContract\Entities\ContractType
 *                         $type
 * @method static Builder|Contract newModelQuery()
 * @method static Builder|Contract newQuery()
 * @method static Builder|Contract query()
 * @method static Builder|Contract status($keyword)
 * @method static Builder|Contract whereAccommodationType($value)
 * @method static Builder|Contract whereAccommodationValue($value)
 * @method static Builder|Contract whereAddressId($value)
 * @method static Builder|Contract whereApplicantId($value)
 * @method static Builder|Contract whereClientId($value)
 * @method static Builder|Contract whereContractNumber($value)
 * @method static Builder|Contract whereContractTypeId($value)
 * @method static Builder|Contract whereCreatedAt($value)
 * @method static Builder|Contract whereDayoffArrangement($value)
 * @method static Builder|Contract whereEndDate($value)
 * @method static Builder|Contract whereExpectedArrivalDate($value)
 * @method static Builder|Contract whereId($value)
 * @method static Builder|Contract whereNumberOfAdult($value)
 * @method static Builder|Contract whereNumberOfBedrooms($value)
 * @method static Builder|Contract whereNumberOfChildren($value)
 * @method static Builder|Contract whereNumberOfElderly($value)
 * @method static Builder|Contract whereResidenceArea($value)
 * @method static Builder|Contract whereStartDate($value)
 * @method static Builder|Contract whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\AgencyContract\Entities\SpecialRequest[]
 *                $specialRequest
 * @property-read int|null
 *                         $special_request_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @property-read Requirement|null $requirement
 * @property-read \Illuminate\Database\Eloquent\Collection|Address[] $addresses
 * @property-read int|null $addresses_count
 * @property-read Invoice|null $invoice
 * @property string $internal_code
 * @property int $salary
 * @property int $food_subsidy
 * @property string|null $special_request_1
 * @property string|null $special_request_2
 * @property string|null $special_request_3
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\UploadDocument\Entities\Document[] $uploadDocuments
 * @property-read int|null $upload_documents_count
 * @method static Builder|Contract clientName(string $keyword)
 * @method static Builder|Contract contractTypeLabel(string $keyword)
 * @method static Builder|Contract whereFoodSubsidy($value)
 * @method static Builder|Contract whereInternalCode($value)
 * @method static Builder|Contract whereSalary($value)
 * @method static Builder|Contract whereSpecialRequest1($value)
 * @method static Builder|Contract whereSpecialRequest2($value)
 * @method static Builder|Contract whereSpecialRequest3($value)
 */
class Contract extends Model implements HasWorkflowInterface, HasUploadDocumentsInterface
{
    use HasWorkflow, HasUploadDocuments;

    protected $fillable = [
        'accommodation_type',
        'accommodation_value',
        'address_id',
        'client_id',
        'contract_number',
        'contract_type_id',
        'dayoff_arrangement',
        'end_date',
        'food_subsidy',
        'internal_code',
        'number_of_adult',
        'number_of_bedrooms',
        'number_of_children',
        'number_of_elderly',
        'residence_area',
        'salary',
        'special_request_1',
        'special_request_2',
        'special_request_3',
        'start_date',
    ];

    protected $cast = [
        'end_date'              => 'date',
        'expected_arrival_date' => 'date',
        'start_date'            => 'date',
    ];

    protected $appends = [
        'address',
        'status',
    ];

    protected static function booted()
    {

        parent::booted();

        static::created(fn(Contract $contract) => $contract->setInitialState());
    }

    // region Relation
    public function applicants(): BelongsToMany
    {
        return $this->BelongsToMany(Applicant::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ContractType::class,
            'contract_type_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function addresses(): belon
    {
        return $this->belongsToMany(Address::class,);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function residents(): BelongsToMany
    {
        return $this->belongsToMany(Client::class);
    }

    public function dates(): BelongsToMany
    {
        return $this->belongsToMany(ContractDate::class,
            'contract_date_values')
            ->withPivot('value')
            ->using(ContractDateValue::class)
            ->as('value');
    }

    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(ContractDoc::class,
            'contract_doc_values')
            ->withPivot('value')
            ->using(ContractDocValue::class)
            ->as('doc');
    }

    public function storedDocuments(): HasMany
    {
        return $this->hasMany(ContractDocValue::class);
    }

    public function specialRequest(): HasMany
    {
        return $this->hasMany(SpecialRequest::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function requirement(): HasOne
    {
        return $this->hasOne(Requirement::class);
    }

    // endregion

    // region Scope

    public function scopeSearchGlobally(Builder $query, ?string $value): BUilder
    {
        return $query->where('contract_number', 'like', "%{$value}%");
    }

    public function scopeStatus(Builder $query, string $keyword): Builder
    {

        if ($keyword === null) {
            return $query;
        }

        return $query->whereHas('currentState.state',
            function ($q) use ($keyword) {
                return $q->where('label',
                    'like',
                    "%{$keyword}%")
                    ->orWhere('code',
                        'like',
                        "%{$keyword}%");
            });
    }

    public function scopeContractTypeLabel(Builder $query, string $keyword): Builder
    {

        if ($keyword === null) {
            return $query;
        }

        return $query->whereHas('type',
            function ($q) use ($keyword) {
                return $q->where('label',
                    'like',
                    "%{$keyword}%");
            });
    }

    public function scopeClientName(Builder $query, string $keyword): Builder
    {

        if ($keyword === null) {
            return $query;
        }

        return $query->whereHas('client',
            function ($q) use ($keyword) {
                return $q->where('first_name',
                    'like',
                    "%{$keyword}%")
                    ->where('last_name',
                        'like',
                        "%{$keyword}%");
            });
    }

    //endregion

    // region Accessor

    public function getTransitionsAttribute(): Collection
    {
        return $this->getTransitions();
    }

    public function getAddressAttribute(): ?Address
    {
        return $this->addresses()->first();
    }

    public function getStatusAttribute(): string
    {
        return $this->currentState->label;
    }

    public function getDayoffArrangementAttribute($value): array
    {
        return [];
    }

    // endregion

    // region Mutator

    public function setDayoffArrangementAttribute($value): void
    {
        $this->attributes['dayoff_arrangement'] = serialize($value);
    }

    // endregion

    // region Helpers

    public static function globalSearch(?string $value): Collection
    {

        return (new static())
            ->searchGlobally($value)
            ->get()
            ->map(fn(Contract $contract) => new GlobalSearchResult($contract));

    }

    public function cancel(): void
    {
        $cancelState = $this->getWorkflow()->states->where('code',
            'cancelled')->first();

        $t = $this->getTransitions()->first(fn(
            Transition $trans) => $trans->to_state_id === $cancelState->id);

        $this->applyTransition($t);
    }

    public function numberOfChildren(): int
    {
        $count = $this->residents->filter(fn(Client $client) => $client->isChildren())->count();


        return $this->client->isChildren() ? $count + 1 : $count;
    }

    public function numberOfAdult(): int
    {
        $count = $this->residents->filter(fn(Client $client) => $client->isAdult())->count();


        return $this->client->isAdult() ? $count + 1 : $count;
    }

    public function numberOfElderly(): int
    {
        $count = $this->residents->filter(fn(Client $client) => $client->isElderly())->count();


        return $this->client->isElderly() ? $count + 1 : $count;
    }

    // endregion

}

