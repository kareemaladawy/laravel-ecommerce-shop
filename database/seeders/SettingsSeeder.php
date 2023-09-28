<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{

    protected $settings = [
        [
            'key'                       =>  'site_name',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'site_title',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'shipping_cost',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'phone_enquiry',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'currency_code',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'currency_symbol',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'site_logo',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'site_favicon',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'footer_copyright_text',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'seo_meta_title',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'seo_meta_content',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_facebook',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_twitter',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_instagram',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_linkedin',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'google_analytics',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'facebook_pixels',
            'value'                     =>  '',
        ],
    ];

    public function run(): void
    {
        foreach ($this->settings as $index => $setting) {
            $record = Setting::create($setting);
            if (!$record) {
                $this->command->info('insert failed at record ' . $index);
                return;
            }
        }
        $this->command->info('Inserted ' . count($this->settings) . 'setting');
    }
}
