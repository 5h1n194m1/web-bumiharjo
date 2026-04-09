<?php

use CodeIgniter\Test\CIUnitTestCase;

final class WhatsappLinkHelperTest extends CIUnitTestCase
{
    public function testWhatsappLinkSanitizesNumberAndBuildsMessage(): void
    {
        helper('web_balkondes');

        $link = whatsapp_link([
            'whatsapp_number' => '0812-3456-7890',
            'whatsapp_message' => 'Halo Admin',
        ]);

        $this->assertStringContainsString('https://wa.me/6281234567890', $link);
        $this->assertStringContainsString('Halo%20Admin', $link);
    }
}
