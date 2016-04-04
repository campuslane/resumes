<?php

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Resume;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ItemsTableSeeder::class);
        $this->call(ResumesTableSeeder::class);
    }
}


class ItemsTableSeeder extends Seeder 
{
	public function run()
	{

		Item::truncate();

		$data = [


			['resume_id'=>1, 'type'=>'section_header', 'section_header'=>'Professional Experience'], 
			
			[
				'resume_id' => 1, 
				'type'=>'job', 
				'job_company'=>'ABC Company', 
				'job_role'=>'SAP Consultant', 
				'job_start_month'=>'January', 
				'job_start_year'=>'2015',
				'job_end_month'=>'March', 
				'job_end_year'=>'2016', 
				'job_content'=>'

					<ul>
						<li>Bullet Point One</li>
						<li>Bullet Point Two</li>
						<li>Bullet Point Three</li>
					</ul>

				', 

			], 

			[
				'resume_id' => 1,
				'type'=>'job', 
				'job_company'=>'XYZ Company', 
				'job_role'=>'SAP Consultant', 
				'job_start_month'=>'October', 
				'job_start_year'=>'2015',
				'job_end_month'=>'January', 
				'job_end_year'=>'2016', 
				'job_content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum ut aliquam praesentium impedit nisi possimus asperiores officiis, a suscipit ratione voluptatum odio, illo cupiditate quisquam harum natus magni quidem laboriosam?', 

			], 

			[
				'resume_id' => 1,
				'type'=>'job', 
				'job_company'=>'DEF Company', 
				'job_role'=>'SAP Consultant', 
				'job_start_month'=>'November', 
				'job_start_year'=>'2012',
				'job_end_month'=>'March', 
				'job_end_year'=>'2016', 
				'job_content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum ut aliquam praesentium impedit nisi possimus asperiores officiis, a suscipit ratione voluptatum odio, illo cupiditate quisquam harum natus magni quidem laboriosam?', 

			], 

		];


			foreach ($data as $item) {
				Item::insert($item);
			}
		
	}
}


class ResumesTableSeeder extends Seeder 
{
	public function run()
	{

		Resume::truncate();

		$data = [

			'name' => 'Frank Matull', 

		];

		Resume::insert($data);
		
	}
}
