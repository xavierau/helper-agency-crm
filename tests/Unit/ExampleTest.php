<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Modules\AgencyCore\Actions\CreateNewApplicant;
use Modules\AgencyCore\Actions\CreateNewApplicantExperience;
use Modules\AgencyCore\DataTransferObject\ApplicantDTO;
use Modules\AgencyCore\DataTransferObject\ApplicantExperienceDTO;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    private $jsonString = '{"name":"my name","date_of_birth":"1980-12-06","gender":"female","nationality":"IH","available_date":"2021-04-30","phone":"12312311","marital_status":"married","height":"160","weight":"55","email":null,"facebook":null,"father_name":null,"current_country":null,"father_age":"65","father_occupation":"Retired","mother_name":null,"mother_age":"60","mother_occupation":"Retired","spouse_name":"John Wick","spouse_age":"41","spouse_occupation":"Police","number_of_brothers":0,"number_of_sisters":0,"number_in_family":1,"number_of_sons":"2","age_of_sons":"","number_of_daughters":0,"age_of_daughters":"","duties":[4,1,3],"experience":[{"uuid":"94c4fb08-a817-4890-a4b2-2e331add3a8a","location":"indonesia","from":"2017-04-01","to":"2019-03-31","position":"Dometic Helper","house_size":"800","number_of_adult":"2","age_of_adult":"35,45","number_of_children":"1","age_of_children":"8","number_of_elderly":"0","age_of_elderly":"0","duties":[1,2,3],"status":"finished","description":"Very sgood"}],"english":"Good","cantonese":"Fair","mandarin":"Poor","other_language":"","religion":"Christian","passport":"KJ123456789","visa_expiry_date":"2022-04-25","graduation_year":"2005","school_name":"Very good university","major":"Social Work"}';

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest() {
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function create_applicant(): void {

        Artisan::call('db:seed');

        $applicantData = json_decode($this->jsonString,
                                     true);

        $action = app(CreateNewApplicant::class);

        $applicant = $action->execute(ApplicantDTO::fromArray($applicantData));

        $this->assertDatabaseHas('applicants',
                                 [
                                     'name' => 'my name',
                                 ]);

        $dutyIds = [4, 1, 3];
        collect($dutyIds)->each(function($id) use ($applicant) {
            $this->assertDatabaseHas('applicant_domestic_duty',
                                     [
                                         'applicant_id'     => $applicant->id,
                                         'domestic_duty_id' => $id,
                                     ]);
        });

    }

    /**
     * @test
     */
    public function create_applicant_experience(): void {

        Artisan::call('db:seed');

        $applicantData = json_decode($this->jsonString,
                                     true);

        $action = app(CreateNewApplicant::class);

        $applicant = $action->execute(ApplicantDTO::fromArray($applicantData));

        $createExperienceAction = app(CreateNewApplicantExperience::class);

        $exp = $createExperienceAction->execute($applicant,
                                                ApplicantExperienceDTO::fromValidatedData($applicantData['experience']));

        $this->assertDatabaseHas('applicant_experiences',
                                 [
                                     'id'           => $exp[0]->id,
                                     'applicant_id' => $applicant->id,
                                 ]);

        $duty_ids = [1, 2, 3];

        collect($duty_ids)->each(function($dutyId) use ($exp) {
            $this->assertDatabaseHas('applicant_experience_domestic_duty',
                                     [
                                         'experience_id' => $exp[0]->id,
                                         'duty_id'       => $dutyId,
                                     ]);
        });

    }
}
