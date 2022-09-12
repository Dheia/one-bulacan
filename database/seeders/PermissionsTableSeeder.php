<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\User;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{

    protected $permissions = [
        // User
        [
            'name' => "access user", 
            'page_name' => 'user',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create user", 
            'page_name' => 'user',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read user", 
            'page_name' => 'user',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update user", 
            'page_name' => 'user',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete user", 
            'page_name' => 'user',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "reset user password", 
            'page_name' => 'user',
            'guard_name' => 'backpack'
        ],
        // Role
        [
            'name' => "access role", 
            'page_name' => 'role',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create role", 
            'page_name' => 'role',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read role", 
            'page_name' => 'role',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update role", 
            'page_name' => 'role',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete role", 
            'page_name' => 'role',
            'guard_name' => 'backpack'
        ],
        // Permission
        [
            'name' => "access permission", 
            'page_name' => 'permission',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create permission", 
            'page_name' => 'permission',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read permission", 
            'page_name' => 'permission',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update permission", 
            'page_name' => 'permission',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete permission", 
            'page_name' => 'permission',
            'guard_name' => 'backpack'
        ],
        // Business Owner Permission
        [
            'name' => "access business owner", 
            'page_name' => 'business owner',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create business owner", 
            'page_name' => 'business owner',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read business owner", 
            'page_name' => 'business owner',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update business owner", 
            'page_name' => 'business owner',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete business owner", 
            'page_name' => 'business owner',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "reset business owner password", 
            'page_name' => 'business owner',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "activate business owner account", 
            'page_name' => 'business owner',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "deactivate business owner account", 
            'page_name' => 'business owner',
            'guard_name' => 'backpack'
        ],
        // Business Category Permissions
        [
            'name' => "access business category", 
            'page_name' => 'business category',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create business category", 
            'page_name' => 'business category',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read business category", 
            'page_name' => 'business category',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update business category", 
            'page_name' => 'business category',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete business category", 
            'page_name' => 'business category',
            'guard_name' => 'backpack'
        ],
        // Tag Permissions
        [
            'name' => "access tag", 
            'page_name' => 'tag',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create tag", 
            'page_name' => 'tag',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read tag", 
            'page_name' => 'tag',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update tag", 
            'page_name' => 'tag',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete tag", 
            'page_name' => 'tag',
            'guard_name' => 'backpack'
        ],
        // Business Permissions
        [
            'name' => "access business", 
            'page_name' => 'business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "access all business", 
            'page_name' => 'business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create business", 
            'page_name' => 'business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read business", 
            'page_name' => 'business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update business", 
            'page_name' => 'business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete business", 
            'page_name' => 'business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "verify business", 
            'page_name' => 'business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "publish business", 
            'page_name' => 'business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "draft business", 
            'page_name' => 'business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "renew business", 
            'page_name' => 'business',
            'guard_name' => 'backpack'
        ],
        // Featured Business Permission
        [
            'name' => "access featured business", 
            'page_name' => 'featured business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create featured business", 
            'page_name' => 'featured business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read featured business", 
            'page_name' => 'featured business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update featured business", 
            'page_name' => 'featured business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete featured business", 
            'page_name' => 'featured business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "unfeature business", 
            'page_name' => 'featured business',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "renew featured business", 
            'page_name' => 'featured business',
            'guard_name' => 'backpack'
        ],
         // Business Product and Services
        [
            'name' => "access business product-services", 
            'page_name' => 'Product & Services',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create business product-services", 
            'page_name' => 'Product & Services',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read business product-services", 
            'page_name' => 'Product & Services',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update business product-services", 
            'page_name' => 'Product & Services',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete business product-services", 
            'page_name' => 'Product & Services',
            'guard_name' => 'backpack'
        ],
        // Job Category Permissions
        [
            'name' => "access job category", 
            'page_name' => 'job category',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create job category", 
            'page_name' => 'job category',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read job category", 
            'page_name' => 'job category',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update job category", 
            'page_name' => 'job category',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete job category", 
            'page_name' => 'job category',
            'guard_name' => 'backpack'
        ],
        // Jobs
        [
            'name' => "access job", 
            'page_name' => 'job',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create job", 
            'page_name' => 'job',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read job", 
            'page_name' => 'job',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update job", 
            'page_name' => 'job',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete job", 
            'page_name' => 'job',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "publish job", 
            'page_name' => 'job',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "draft job", 
            'page_name' => 'job',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "reopen job", 
            'page_name' => 'job',
            'guard_name' => 'backpack'
        ],
        // Survey
        [
            'name' => "access survey", 
            'page_name' => 'survey',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create survey", 
            'page_name' => 'survey',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read survey", 
            'page_name' => 'survey',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update survey", 
            'page_name' => 'survey',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete survey", 
            'page_name' => 'survey',
            'guard_name' => 'backpack'
        ],
        // Business Visitor
        [
            'name' => "access business visitor", 
            'page_name' => 'business visitor',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read business visitor", 
            'page_name' => 'business visitor',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete business visitor", 
            'page_name' => 'business visitor',
            'guard_name' => 'backpack'
        ],
        // Sales
        [
            'name' => "access sale", 
            'page_name' => 'sale',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read sale", 
            'page_name' => 'sale',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "paid sale", 
            'page_name' => 'sale',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "verify sale", 
            'page_name' => 'sale',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "email sale", 
            'page_name' => 'sale',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "message sale", 
            'page_name' => 'sale',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "notify sale", 
            'page_name' => 'sale',
            'guard_name' => 'backpack'
        ],
        // Location/Municipality
        [
            'name' => "access location", 
            'page_name' => 'location',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create location", 
            'page_name' => 'location',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read location", 
            'page_name' => 'location',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update location", 
            'page_name' => 'location',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete location", 
            'page_name' => 'location',
            'guard_name' => 'backpack'
        ],
        // Barangay
        [
            'name' => "access barangay", 
            'page_name' => 'barangay',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create barangay", 
            'page_name' => 'barangay',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read barangay", 
            'page_name' => 'barangay',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update barangay", 
            'page_name' => 'barangay',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete barangay", 
            'page_name' => 'barangay',
            'guard_name' => 'backpack'
        ],
        // Newsletter Permissions
        [
            'name' => "access newsletter", 
            'page_name' => 'newsletter',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create newsletter", 
            'page_name' => 'newsletter',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read newsletter", 
            'page_name' => 'newsletter',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update newsletter", 
            'page_name' => 'newsletter',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete newsletter", 
            'page_name' => 'newsletter',
            'guard_name' => 'backpack'
        ],
         // Messages Permissions
        [
            'name' => "access message", 
            'page_name' => 'message',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create message", 
            'page_name' => 'message',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read message", 
            'page_name' => 'message',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update message", 
            'page_name' => 'message',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete message", 
            'page_name' => 'message',
            'guard_name' => 'backpack'
        ],
        // Log Permissions
        [
            'name' => "access log", 
            'page_name' => 'log',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read log", 
            'page_name' => 'log',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete log", 
            'page_name' => 'log',
            'guard_name' => 'backpack'
        ],
        // Setting
        [
            'name' => "access setting", 
            'page_name' => 'setting',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read setting", 
            'page_name' => 'setting',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update setting", 
            'page_name' => 'setting',
            'guard_name' => 'backpack'
        ],
         // File Manager
        [
            'name' => "access file manager", 
            'page_name' => 'file manager',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "create file manager", 
            'page_name' => 'file manager',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read file manager", 
            'page_name' => 'file manager',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update file manager", 
            'page_name' => 'file manager',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "delete file manager", 
            'page_name' => 'file manager',
            'guard_name' => 'backpack'
        ],
         // Setting
        [
            'name' => "access setting", 
            'page_name' => 'setting',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "read setting", 
            'page_name' => 'setting',
            'guard_name' => 'backpack'
        ],
        [
            'name' => "update setting", 
            'page_name' => 'setting',
            'guard_name' => 'backpack'
        ],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Truncate Permissions Table
    	Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        // Insert Data in Permissions Table
    	DB::table('permissions')->insert($this->permissions);

    }
}
