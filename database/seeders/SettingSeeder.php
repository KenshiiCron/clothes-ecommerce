<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    protected $settings = [
        //        Business Info
        [
            'key' => 'site_name',
            'value' => "Ecommerce",
        ],
        [
            'key' => 'contact_email',
            'value' => 'contact@ecommerce.com',
        ],
        [
            'key' => 'default_email_address',
            'value' => 'ceo@ecommerce.com',
        ],
        [
            'key' => 'phone_1',
            'value' => 'xxx xxx xx xx xx',
        ],
        [
            'key' => 'phone_2',
            'value' => 'xxx xxx xx xx xx',
        ],
        [
            'key' => 'fax',
            'value' => 'xxx xxx xx xx xx',
        ],
        [
            'key' => 'currency_code',
            'value' => 'DZD',
        ],
        [
            'key' => 'address',
            'value' => 'Address',
        ],
        [
            'key' => 'city',
            'value' => 'City',
        ],
        [
            'key' => 'country',
            'value' => 'Country',
        ],
        [
            'key' => 'zip_code',
            'value' => '',
        ],

        //        Site Settings
        [
            'key' => 'site_logo',
            'value' => '',
        ],
        [
            'key' => 'site_favicon',
            'value' => '',
        ],
        [
            'key' => 'seo_meta_title',
            'value' => '',
        ],
        [
            'key' => 'seo_meta_keywords',
            'value' => '',
        ],
        [
            'key' => 'seo_meta_description',
            'value' => '',
        ],
        [
            'key' => 'max_upload_size',
            'value' => '5000',
        ],

        //        Social Media
        [
            'key' => 'social_facebook',
            'value' => 'https://facebook.com/',
        ],
        [
            'key' => 'facebook_pixel',
            'value' => '00000000',
        ],
        [
            'key' => 'social_twitter',
            'value' => 'https://twitter.com/',
        ],
        [
            'key' => 'social_instagram',
            'value' => 'https://instagram.com/',
        ],
        [
            'key' => 'social_youtube',
            'value' => 'https://youtube.com/',
        ],
        [
            'key' => 'social_tiktok',
            'value' => 'https://tiktok.com/',
        ],

        //        Delivery Companies API Keys (bcrypt encrypted)
        [
            'key' => 'yalidine_delivery',
            'value' => "",
        ],
        [
            'key' => 'yalidine_api_id',
            'value' => '',
        ],
        [
            'key' => 'yalidine_api_token',
            'value' => '',
        ],
        [
            'key' => 'zr_delivery',
            'value' => "",
        ],
        [
            'key' => 'zr_express_api_key',
            'value' => '',
        ],
        [
            'key' => 'zr_express_api_token',
            'value' => '',
        ],
        [
            'key' => 'noest_delivery',
            'value' => "",
        ],
        [
            'key' => 'noest_api_key',
            'value' => '',
        ],
        [
            'key' => 'noest_api_secret',
            'value' => '',
        ],
        [
            'key' => 'maystro_delivery',
            'value' => "",
        ],
        [
            'key' => 'maystro_api_key',
            'value' => '',
        ],
        [
            'key' => 'maystro_api_secret',
            'value' => '',
        ],
        [
            'key' => 'guepex_delivery',
            'value' => "",
        ],
        [
            'key' => 'guepex_api_key',
            'value' => '',
        ],
        [
            'key' => 'guepex_api_secret',
            'value' => '',
        ],

        [
            'key' => 'anderson_delivery',
            'value' => "",
        ],
        [
            'key' => 'anderson_api_key',
            'value' => '',
        ],
        [
            'key' => 'anderson_api_secret',
            'value' => '',
        ],
    ];


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->settings as $index => $setting)
        {
            $result = Setting::create($setting);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted '.count($this->settings). ' records');
    }
}
