<?php

namespace Functional\EOffice;

use EOffice\Packages\Testing\FunctionalTestCase;

/**
 * @covers \EOffice\Packages\Core\Providers\EOfficeServiceProvider
 * @covers \EOffice\Packages\Core\Providers\RouteServiceProvider
 * @covers \EOffice\Packages\Core\Providers\AuthServiceProvider
 * @covers route_register_api
 * @covers route_register_web
 */
class HomepageTest extends FunctionalTestCase
{
    public function test_its_homepage_should_be_accessible(): void
    {
        $response = $this->get('/');
        $response->assertResponseOk();
    }

    public function test_its_api_page_should_be_accessible(): void
    {
        $response = $this->get('/api');
        $response->assertResponseOk();
    }
}
