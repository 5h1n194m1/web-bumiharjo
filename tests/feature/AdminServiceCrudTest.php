<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

final class AdminServiceCrudTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $refresh = true;
    protected $namespace = 'App';
    protected $seed = \App\Database\Seeds\DatabaseSeeder::class;
    protected $basePath = APPPATH . 'Database';

    public function testAdminCanCreateService(): void
    {
        $result = $this
            ->withSession([
                'admin_logged_in' => true,
                'admin_id' => 1,
                'admin_name' => 'Admin Web Balkondes',
                'admin_email' => 'admin@web-balkondes.test',
            ])
            ->post('/admin/services', [
                'icon' => '☕',
                'title' => 'Kopi Sawah',
                'description' => 'Ngopi santai di tepi sawah.',
                'sort_order' => 99,
                'is_active' => '1',
            ]);

        $result->assertRedirectTo('/admin/services');
        $this->seeInDatabase('services', ['title' => 'Kopi Sawah', 'sort_order' => 99]);
    }
}
