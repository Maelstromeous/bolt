<?php

namespace Bolt\Tests\Twig;

use Bolt\Tests\BoltUnitTest;
use Bolt\Twig\Handler\AdminHandler;

/**
 * Class to test Bolt\Twig\Handler\AdminHandler
 *
 * @author Gawain Lynch <gawain.lynch@gmail.com>
 */
class AdminHandlerTest extends BoltUnitTest
{
    public function testAddDataEmpty()
    {
        $app = $this->getApp();
        $handler = new AdminHandler($app);

        $handler->addData('', '');
        $this->assertEmpty($app['jsdata']);
    }

    public function testAddDataValid()
    {
        $app = $this->getApp();
        $handler = new AdminHandler($app);

        $handler->addData('drop.bear', 'Johno');
        $this->assertArrayHasKey('drop', $app['jsdata']);
        $this->assertArrayHasKey('bear', $app['jsdata']['drop']);
        $this->assertSame('Johno', $app['jsdata']['drop']['bear']);
    }

    public function testIsChangelogEnabled()
    {
        $app = $this->getApp();
        $handler = new AdminHandler($app);

        $app['config']->set('general/changelog/enabled', false);
        $result = $handler->isChangelogEnabled();
        $this->assertFalse($result);

        $app['config']->set('general/changelog/enabled', true);
        $result = $handler->isChangelogEnabled();
        $this->assertTrue($result);
    }
}
