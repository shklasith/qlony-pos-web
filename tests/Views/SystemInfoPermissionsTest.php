<?php

namespace Tests\Views;

use CodeIgniter\Test\CIUnitTestCase;

class SystemInfoPermissionsTest extends CIUnitTestCase
{
    public function testSystemInfoRendersWhenCustomerImportTemplateIsMissing(): void
    {
        $templatePath = WRITEPATH . 'uploads/importCustomers.csv';

        if (is_file($templatePath)) {
            $this->markTestSkipped('The customer import template exists; this test must not alter it.');
        }

        $serverValues = [
            'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'] ?? null,
            'SERVER_SOFTWARE' => $_SERVER['SERVER_SOFTWARE'] ?? null,
            'SERVER_PORT'     => $_SERVER['SERVER_PORT'] ?? null,
        ];

        $_SERVER['HTTP_USER_AGENT'] = 'PHPUnit';
        $_SERVER['SERVER_SOFTWARE'] = 'PHPUnit';
        $_SERVER['SERVER_PORT'] = '80';

        try {
            $output = view('configs/system_info', [
                'dbVersion' => 'test',
                'config'    => ['timezone' => 'UTC'],
            ]);
        } finally {
            foreach ($serverValues as $key => $value) {
                if ($value === null) {
                    unset($_SERVER[$key]);
                } else {
                    $_SERVER[$key] = $value;
                }
            }
        }

        $this->assertStringContainsString('[importCustomers.csv:]', $output);
        $this->assertStringContainsString('Unavailable', $output);
        $this->assertStringContainsString('Not Readable', $output);
    }
}
