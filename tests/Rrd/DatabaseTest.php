<?php
/**
 * This file is part of the Rrd package.
 *
 * (c) Christoph Luehr <luehr@r-pentomino.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rrd;

class DatabaseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Rrd\Database::create()
     */
    public function testAll()
    {
        $db = new Database('foo.rrd');
#/ *
        $source = new Source('testsource');
        $db->setStart(time()-(60*60*24*14));
        $db->addSource($source);
        $db->setArchiveList(Archive::listFactory());
        $ret = $db->create();

        for ($t=1000; $t>0; $t--) {
            $ret = $db->update(rand(1,100), (time()-($t*300)));
        }

        #$this->assertEquals(0, $ret);
#* /
        $db->graph();
    }
}