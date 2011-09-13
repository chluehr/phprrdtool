<?php
/*
 * This file is part of the Rrd package.
 *
 * (c) Christoph Luehr <luehr@r-pentomino.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rrd;

/**
 * Graph
 *
 * Holds properties of a RRD.
 *
 * @author Christoph Luehr <luehr@r-pentomino.de>
 */
class GraphPlot
{
    const DELIMITER = ':';

    /**
     * @var \Rrd\GraphDef
     */
    protected $_def;

    /**
     * @var string
     */
    protected $_label;

    /**
     * DEF:<vname>=<rrdfile>:<ds-name>:<CF>[:step=<step>][:start=<time>][:end=<time>][:reduce=<CF>]
     * @return string
     */
    public function __toString()
    {
        $output = join(
            self::DELIMITER,
            array(
                'LINE2',
                $this->_def->getVname() . '#ff0000',
                '"' .$this->_label . '"'
            )
        );


}
