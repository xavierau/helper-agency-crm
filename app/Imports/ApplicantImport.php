<?php

namespace App\Imports;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Supplier;

class ApplicantImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {

        $row = collect($row)->reduce(function ($carry, $val, $key) {

            $carry[$key] = trim($val);

            return $carry;

        }, []);

        $sanitized = $this->sanitize($row);

        $applicant = Applicant::create($sanitized);

        $applicant->education = $this->getEducationInfo($row);
        $applicant->family = $this->getFamilyInfo($row);
        $applicant->personal_document = $this->getPersonalDocument($row);
        $applicant->questions = $this->getQuestions($row);

        $applicant->save();
        return $applicant;

    }

    private function sanitize(array $row)
    {
        return [
            "hk_code"        => $row["hk_code"],
            "pt_code"        => $row["ptat_code"],
            "supplier_id"    => $this->getSupplierId($row["supplier_code"]),
            "location"       => $row["location"],
            "surname"        => $row["surname"] === "NO" ? null : $row["surname"],
            "given_name"     => $row["given_name"] === "NO" ? null : $row["given_name"],
            "middle_name"    => $row["middle_name"] === "NO" ? null : $row["middle_name"],
            "nationality"    => Str::lower($row["nationality"]),
            "sex"            => Str::lower($row["sex"]),
            "date_of_birth"  => Carbon::createFromFormat('j/n/Y', $row["birthday"]),
            "religion"       => $row["religion"],
            "height"         => $row["height_cm"],
            "weight"         => $row["weight_kgs"],
            "marital_status" => Str::lower($row["marital_status"]),
            //            "application_status"            => $row["application_status"] "NO",
            "english"        => Str::lower($row["english"]),
            "mandarin"       => Str::lower($row["mandarin"]),
            "cantonese"      => Str::lower($row["cantonese"]),
            "other_language" => $row["other_language"] === "NA" ? null : $row["other_language"],


            "address"         => $row["address"] === "NO" ? null : $row["address"],

            "date_of_release" => $row["available_date"] === "No" ? null : Carbon::createFromFormat('j/n/Y', $row["available_date"]),

            "status"=>"active"

        ];
    }

    private function getSupplierId(mixed $supplier_code)
    {
        $supplier = Supplier::firstOrCreate([
            "code" => $supplier_code,
        ], [
            "name" => $supplier_code,
        ]);

        return $supplier->id;
    }

    private function getEducationInfo($row)
    {
        return [
            "highest_education" => $row["highest_education"]
        ];
    }

    private function getPersonalDocument($row)
    {
        return [
            "hk_id"                   => $row["hkid"] === "NO" ? null : $row["hkid"],
            "passport_no"             => $row["passport_no"] === "NO" ? null : $row["passport_no"],
            "passport_place_of_issue" => $row["place_of_issue"] === "NO" ? null : $row["place_of_issue"],
            "passport_issued"         => $row["ppt_issued"] === "NO" ? null : Carbon::createFromFormat('j/n/Y', $row["ppt_issued"]),
            "passport_expiry_date"    => $row["ppt_valid_date"] === "NO" ? null : Carbon::createFromFormat('j/n/Y', $row["ppt_valid_date"]),
            "visa_expiry_date"        => $row["visa_expiry_date"] === "No" ? null : Carbon::createFromFormat('j/n/Y', $row["visa_expiry_date"]),
        ];
    }

    private function getFamilyInfo($row): array
    {
        return [
            "spouse_name"            => $row["spouse_name"] === "NO" ? null : $row["spouse_name"],
            "spouse_age"             => $row["spouse_age"] === "NO" ? null : $row["spouse_age"],
            "spouse_occupation"      => $row["spouse_occupation"] === "NO" ? null : $row["spouse_occupation"],
            "father_name"            => $row["father_name"] === "NO" ? null : $row["father_name"],
            "father_age"             => $row["father_age"] === "NO" ? null : $row["father_age"],
            "father_occupation"      => $row["father_occupation"] === "NO" ? null : $row["father_occupation"],
            "mother_name"            => $row["mother_name"] === "NO" ? null : $row["mother_name"],
            "mother_age"             => $row["mother_age"] === "NO" ? null : $row["mother_age"],
            "mother_occupation"      => $row["mother_occupation"] === "NO" ? null : $row["mother_occupation"],
            "number_of_brother"      => $row["no_of_brother"] === "NO" ? null : $row["no_of_brother"],
            "number_of_sister"       => $row["no_of_sister"] === "NO" ? null : $row["no_of_sister"],
            "position_in_the_family" => $row["position_in_the_family"] === "NO" ? null : $row["position_in_the_family"],
            "number_of_children"     => $row["no_of_children"] === "NO" ? null : $row["no_of_children"],
            "number_of_boy"          => $row["no_of_boy"] === "NO" ? null : $row["no_of_boy"],
            "age_of_boy"             => $row["b_age"] === "NO" ? null : $row["b_age"],
            "number_of_girl"         => $row["no_of_girl"] === "NO" ? null : $row["no_of_girl"],
            "age_of_girl"            => $row["g_age"] === "NO" ? null : $row["g_age"],
        ];
    }

    private function getQuestions($row): array
    {
        return [
            "afraid_of_dog" => $row["afriad_of_dog"] === "YES",
            "eat_pork"      => $row["eat_pork"] === "YES",
        ];
    }
}
