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
class GraphDef
{

    const PARAMETER = 'DEF';
    const DELIMITER = ':';

    protected $_vname;

    /**
     * @var \Rrd\Database
     */
    protected $_database;

    /**
     * @var \Rrd\Source
     */
    protected $_source;
    protected $_cf;
    protected $_step;
    protected $_start;
    protected $_end;
    protected $_reduce;



    /**
     * DEF:<vname>=<rrdfile>:<ds-name>:<CF>[:step=<step>][:start=<time>][:end=<time>][:reduce=<CF>]
     * @return string
     */
    public function __toString()
    {
        $output = join(
            self::DELIMITER,
            array(
                self::PARAMETER,
                $this->_vname . '=' . $this->_database->getFilename(),
                $this->_source->getKey()
            )
        );
    }

    /**
     * @param $vname
     * @param \Rrd\Source $source
     */
    public function __construct($vname, Source $source)
    {
        $this->_vname   = $vname;
        $this->_source  = $source;
    }

    public function getVname()
    {
        return $this->_vname;
    }

    public function setVname($vname)
    {
        $this->_vname = $vname;
    }

}
