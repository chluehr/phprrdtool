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
 * Round Robin Datasource
 *
 * Holds properties of "what" to store
 *
 * @author Christoph Luehr <luehr@r-pentomino.de>
 */
class Source
{

    const PARAMETER = 'DS';
    const DELIMITER = ':';

    const UNKNOWN = 'U';

    /**
     * Types
     */
    const GAUGE     = 'GAUGE';
    const COUNTER   = 'COUNTER';
    const DERIVE    = 'DERIVE';
    const ABSOLUTE  = 'ABSOLUTE';
    const COMPUTE   = 'COMPUTE';

    /**
     * the "name" of the source
     * @var string [a-z][a-z0-9]*
     */
    protected $_key;

    /**
     * the type of the source
     * @var string
     */
    protected $_type = self::GAUGE;

    /**
     * In seconds
     * @var int
     */
    protected $_heartbeat = 300;

    /**
     * Minimum value
     * @var float|string
     */
    protected $_min = self::UNKNOWN;

    /**
     * Maximum value
     * @var float|string
     */
    protected $_max = self::UNKNOWN;

    /**
     * @return string
     */
    public function __toString()
    {
        $output = join(
            self::DELIMITER,
            array(
                self::PARAMETER,
                $this->_key,
                $this->_type,
                $this->_heartbeat,
                $this->_min,
                $this->_max,
            )
        );

        return $output;
    }

    /**
     * @param $key string
     */
    public function __construct($key)
    {
        $this->_key = $key;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param float|string $min
     */
    public function setMin($min)
    {
        $this->_min = $min;
    }

    /**
     * @return float|string
     */
    public function getMin()
    {
        return $this->_min;
    }

    /**
     * @param float|string $max
     */
    public function setMax($max)
    {
        $this->_max = $max;
    }

    /**
     * @return float|string
     */
    public function getMax()
    {
        return $this->_max;
    }

    /**
     * @param int $heartbeat
     */
    public function setHeartbeat($heartbeat)
    {
        $this->_heartbeat = $heartbeat;
    }

    /**
     * @return int
     */
    public function getHeartbeat()
    {
        return $this->_heartbeat;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->_key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->_key = $key;
    }
}