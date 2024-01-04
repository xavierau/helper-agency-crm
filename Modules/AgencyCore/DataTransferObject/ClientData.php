<?php
/**
 * Author: A & A Creation Co.
 * Date: 24/9/2020
 * Time: 10:57 PM
 */

namespace Modules\AgencyCore\DataTransferObject;


use Carbon\Carbon;

class ClientData
{
    private ?string $prefix;
    private ?string $first_name;
    private ?string $last_name;
    private ?string $chinese_first_name;
    private ?string $chinese_last_name;
    private ?string $occupation;
    private ?string $date_of_birth;
    private ?string $place_of_birth;
    private ?bool $is_male;
    private ?string $email;
    private ?string $tel;
    private ?string $mobile;
    private ?string $company_name;
    private ?string $marital_status;
    private ?string $hk_id;
    private ?string $nationality;
    private ?string $client_number;
    private ?string $is_primary;


    private ?string $address_1;
    private ?string $address_2;
    private ?string $address_3;
    private ?string $state;
    private ?string $country;
    private ?string $postal_code;

    public static function fromFormData(array $validatedData): ClientData {
        $instance = new self;
        $instance->prefix = $validatedData['prefix'] ?? null;
        $instance->first_name = $validatedData['first_name'] ?? null;
        $instance->last_name = $validatedData['last_name'] ?? null;
        $instance->chinese_first_name = $validatedData['chinese_first_name'] ?? null;
        $instance->chinese_last_name = $validatedData['chinese_last_name'] ?? null;
        $instance->occupation = $validatedData['occupation'] ?? null;
        $instance->date_of_birth = $validatedData['date_of_birth'] ?? null;
        $instance->place_of_birth = $validatedData['place_of_birth'] ?? null;
        $instance->is_male = $validatedData['is_male'] ?? null;
        $instance->email = $validatedData['email'] ?? null;
        $instance->tel = $validatedData['tel'] ?? null;
        $instance->mobile = $validatedData['mobile'] ?? null;
        $instance->company_name = $validatedData['company_name'] ?? null;
        $instance->marital_status = $validatedData['marital_status'] ?? null;
        $instance->hk_id = $validatedData['hk_id'] ?? null;
        $instance->nationality = $validatedData['nationality'] ?? null;
        $instance->client_number = $validatedData['client_number'] ?? rand(1000000,
                                                                           9999999);
        $instance->is_primary = $validatedData['is_primary'] ?? null;

        $instance->address_1 = $validatedData['address_1'] ?? null;
        $instance->address_2 = $validatedData['address_2'] ?? null;
        $instance->address_3 = $validatedData['address_3'] ?? null;
        $instance->state = $validatedData['state'] ?? null;
        $instance->country = $validatedData['country'] ?? null;
        $instance->postal_code = $validatedData['postal_code'] ?? null;

        return $instance;
    }

    public function getClientData(): array {
        $data = [
            "prefix"             => $this->prefix,
            "first_name"         => $this->first_name,
            "last_name"          => $this->last_name,
            "chinese_first_name" => $this->chinese_first_name,
            "chinese_last_name"  => $this->chinese_last_name,
            "occupation"         => $this->occupation,
            "place_of_birth"     => $this->place_of_birth,
            "is_male"            => $this->is_male,
            "email"              => $this->email,
            "tel"                => $this->tel,
            "mobile"             => $this->mobile,
            "company_name"       => $this->company_name,
            "marital_status"     => $this->marital_status,
            "hk_id"              => $this->hk_id,
            "nationality"        => $this->nationality,
            "client_number"      => $this->client_number,
            "is_primary"         => $this->is_primary,
        ];

        if($this->date_of_birth) {
            $data["date_of_birth"] = Carbon::parse($this->date_of_birth);
        }

        return $data;
    }

    public function getAddressData(): array {
        return [
            'address_1'   => $this->address_1,
            'address_2'   => $this->address_2,
            'address_3'   => $this->address_3,
            'state'       => $this->state,
            'country'     => $this->country,
            'postal_code' => $this->postal_code,
        ];
    }
}
