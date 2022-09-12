<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingsTableSeeder extends Seeder
{

	protected $settings = [
        [
            'key'         => 'contact_email',
            'name'        => 'Contact form email address',
            'description' => 'The email address that all emails from the contact form will go to.',
            'value'       => 'info@onepampanga.com',
            'field'       => '{"name":"value","label":"Value","type":"email"}',
            'active'      => 1,
        ],
        [
            'key'           => 'contact_cc',
            'name'          => 'Contact form CC field',
            'description'   => 'Email addresses separated by comma, to be included as CC in the email sent by the contact form.',
            'value'         => '',
            'field'         => '{"name":"value","label":"Value","type":"text"}',
            'active'        => 1,

        ],
        [
            'key'           => 'contact_bcc',
            'name'          => 'Contact form BCC field',
            'description'   => 'Email addresses separated by comma, to be included as BCC in the email sent by the contact form.',
            'value'         => '',
            'field'         => '{"name":"value","label":"Value","type":"email"}',
            'active'        => 1,
        ],        
        [
            'key'           => 'contact_address',
            'name'          => 'Address',
            'description'   => 'Address',
            'value'         => '322 San Roque, Guagua, Pampanga 2003',
            'field'         => '{"name":"value","label":"Value","type":"text"}',
            'active'        => 1,
        ],
        [
            'key'           => 'telephone',
            'name'          => 'Telephone No.',
            'description'   => 'Telephone No.',
            'value'         => '045 409 8336',
            'field'         => '{"name":"value","label":"Value","type":"text"}',
            'active'        => 1,
        ],
        [
            'key'           => 'mobile',
            'name'          => 'Mobile No.',
            'description'   => 'Mobile No.',
            'value'         => '0917 510 0074',
            'field'         => '{"name":"value","label":"Value","type":"text"}',
            'active'        => 1,
        ],
        [
            'key'           => 'facebook',
            'name'          => 'Facebook',
            'description'   => 'Facebook Link',
            'value'         => 'https://www.facebook.com/onepampanga1',
            'field'         => '{"name":"value","label":"Value","type":"url"}',
            'active'        => 1,
        ],
        [
            'key'           => 'youtube',
            'name'          => 'Youtube',
            'description'   => 'Youtube Link',
            'value'         => 'https://youtube.com',
            'field'         => '{"name":"value","label":"Value","type":"url"}',
            'active'        => 1,
        ],
        [
            'key'           => 'twitter',
            'name'          => 'Twitter',
            'description'   => 'Twitter Link',
            'value'         => 'https://twitter.com',
            'field'         => '{"name":"value","label":"Value","type":"url"}',
            'active'        => 1,
        ],
        [
            'key'           => 'instagram',
            'name'          => 'Instagram',
            'description'   => 'Instagram Link',
            'value'         => 'https://instagram.com',
            'field'         => '{"name":"value","label":"Value","type":"url"}',
            'active'        => 1,
        ],
        [
            'key'           => 'pinterest',
            'name'          => 'Pinterest',
            'description'   => 'Pinterest Link',
            'value'         => 'https://pinterest.com',
            'field'         => '{"name":"value","label":"Value","type":"url"}',
            'active'        => 1,
        ],
        [
            'key'           => 'linkedin',
            'name'          => 'Linkedin',
            'description'   => 'Linkedin Link',
            'value'         => 'https://linkedin.com',
            'field'         => '{"name":"value","label":"Value","type":"url"}',
            'active'        => 1,
        ],
        [
            'key'           => 'playstore',
            'name'          => 'Play Store',
            'description'   => 'Play Store Link',
            'value'         => 'https://play.google.com/store/apps/details?id=com.onepampanga.projectone&hl=gsw',
            'field'         => '{"name":"value","label":"Value","type":"url"}',
            'active'        => 1,
        ],
        [
            'key'           => 'appstore',
            'name'          => 'App Store',
            'description'   => 'App Store Link',
            'value'         => '',
            'field'         => '{"name":"value","label":"Value","type":"url"}',
            'active'        => 1,
        ],
        [
            'key'           => 'logo',
            'name'          => 'Logo',
            'description'   => 'Logo',
            'value'         => 'images/logo.png',
            'field'         => '{"name":"value","label":"Value","type":"text"}',
            'active'        => 1,
        ],
        [
            'key'           => 'province',
            'name'          => 'Province',
            'description'   => 'Province',
            'value'         => 'Pampanga',
            'field'         => '{"name":"value","label":"Value","type":"text"}',
            'active'        => 1,
        ],
        [
            'key'           => 'global_meta_description',
            'name'          => 'Global Meta Description',
            'description'   => 'Global Meta Description',
            'value'         => 'One Pampanga is an online directory for local businesses in Pampanga. Locate the best places. Find specific products and services. Find job openings. Everything you need to find will be right here',
            'field'         => '{"name":"value","label":"Value","type":"textarea"}',
            'active'        => 1,
        ],
        [
            'key'           => 'global_meta_tags',
            'name'          => 'Global Meta Tags',
            'description'   => 'Global Meta Tags',
            'value'         => 'Pampanga, Pampanga Directory, One Pampanga, Directory, Directory in Pampanga, Directory Listing in Pampanga, SEO, Looking for',
            'field'         => '{"name":"value","label":"Value","type":"textarea"}',
            'active'        => 1,
        ]
        
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate Settings Table
        DB::table('settings')->truncate();

        // Insert Data in Settings Table
        DB::table('settings')->insert($this->settings);

        // foreach ($this->settings as $index => $setting) {
        //     $result = DB::table('settings')->insert($setting);

        //     if (!$result) {
        //         $this->command->info("Insert failed at record $index.");

        //         return;
        //     }
        // }

        // $this->command->info('Inserted '.count($this->settings).' records.');
    }
}
