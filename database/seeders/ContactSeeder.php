<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\ContactName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('contacts')->delete();
        \DB::table('contact_names')->delete();

        for ($i = 0; $i < 50; $i++) {
            $number = mt_rand(100000000, 999999999);

            $contact = Contact::create([
                'phone_number' => 966 . $number
            ]);
            for ($x = 0; $x < 5; $x++) {

                ContactName::create([
                    'contact_id' => $contact->id,
                    'name' => fake()->name
                ]);
            }
        }
    }
}