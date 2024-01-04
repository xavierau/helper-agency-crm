<?php

namespace Modules\AgencyCore\Database\Seeders;

use App\Imports\ApplicantImport;
use Faker\Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ApplicantTableSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    private Generator $faker;

    /**
     * ApplicantTableSeeder constructor.
     * @param \Faker\Generator $faker
     */
    public function __construct(Generator $faker) {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     */
    public function run() {
        Model::unguard();


        Excel::import(new ApplicantImport,
                      storage_path('tmp/Employee_27-4-2021.csv'));


        //        $numberOfApplicants = 200;
        //        $data = [];
        //
        //
        //        $duties = DomesticDuty::all();
        //
        //        for($i = 0; $i < $numberOfApplicants; $i++) {
        //            $country = 'hong_kong';
        //
        //            $isOverseas = rand(0,
        //                               9) < 8;
        //
        //            if($isOverseas) {
        //                $data['supplier_id'] = Supplier::inRandomOrder()->first()->id;
        //                $country = [
        //                               "philippines",
        //                               "indonesia",
        //                               "bangladesh",
        //                               "sri_lanka",
        //                               "cambodia",
        //                           ][rand(0,
        //                                  4)];
        //            }
        //
        //            $data['current_country'] = $country;
        //
        //            $applicant = factory(Applicant::class)
        //                ->create($data);
        //
        //            $ids = $duties->random()
        //                          ->take(rand(3,
        //                                      7))
        //                          ->pluck('id')
        //                          ->toArray();
        //
        //            $applicant->duties()->sync($ids);
        //
        //            factory(ApplicantExperience::class,
        //                    rand(1,
        //                         3))->create(['applicant_id' => $applicant->id]);
        //
        //            factory(Address::class)->create([
        //                                                'owner_type' => get_class($applicant),
        //                                                'owner_id'   => $applicant->id,
        //                                                'country'    => $country,
        //                                            ]);

        //    }

    }
}
