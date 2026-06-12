<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

final class HomepageTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $refresh = true;
    protected $namespace = 'App';
    protected $seed = \App\Database\Seeds\DatabaseSeeder::class;
    protected $basePath = APPPATH . 'Database';

    public function testHomepageIsSuccessfulAndShowsSeededContent(): void
    {
        $result = $this->get('/');

        $result->assertStatus(200);
        $result->assertSee('Balkondes Bumiharjo');
        $result->assertSee('Lihat Opsi Booking');
        $result->assertSee('Fasilitas');
        $result->assertSee('/booking');
        $result->assertSee('/gerbang-senja-bumiharjo');
    }
}
