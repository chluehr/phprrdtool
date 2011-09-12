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
 * Round Robin Database
 *
 * Holds properties of a RRD.
 *
 * @author Christoph Luehr <luehr@r-pentomino.de>
 */
class Database
{

    const COMMAND_CREATE = 'create';
    const COMMAND_UPDATE = 'update';
    const COMMAND_GRAPH  = 'graph';

    const STEP_5MIN = 300;

    const DELIMITER = ':';

    protected $_rrdtool = '/usr/bin/rrdtool';

    /**
     * @var string
     */
    protected $_filename;

    /**
     * Timestamp; accept no values prior to this date
     *
     * Default: use rrtool default (now - 10 sec)
     *
     * @var null|int
     */
    protected $_start = null;

    /**
     * Interval (in seconds)
     * @var int
     */
    protected $_step = self::STEP_5MIN;

    /**
     * @var \Rrd\Source[]
     */
    protected $_sourceList = array();

    /**
     * @var \Rrd\Archive[]
     */
    protected $_archiveList = array();

    /**
     * Creates a new RR Database
     *
     * @return boolean Whether the creation has been successful
     */
    public function create()
    {
        $commandParts = array(
            $this->_rrdtool,
            self::COMMAND_CREATE,
            $this->_filename
        );

        if ($this->_start !== null) {
            $commandParts[] = '--start';
            $commandParts[] = $this->_start;
        }
        
        foreach ($this->_sourceList as $source) {

            $commandParts[] = (string)$source;
        }

        foreach ($this->_archiveList as $archive) {

            $commandParts[] = (string)$archive;
        }

        $command = join(' ', $commandParts);
        echo $command;
        $returnValue = 0;
        $ret = system($command, $returnValue);
        return $returnValue;
    }

    /**
     * @param \Rrd\Source $source
     * @return void
     */
    public function addSource(\Rrd\Source $source)
    {
        $this->_sourceList[] = $source;
    }

    /**
     * @param \Rrd\Archive $archive
     * @return void
     */
    public function addArchive(Archive $archive)
    {
        $this->_archiveList[] = $archive;
    }

    /**
     * @param \Rrd\Archive[] $archiveList
     * @return void
     */
    public function setArchiveList($archiveList)
    {
        $this->_archiveList = $archiveList;
    }


    /**
     * Updates/sets values in a RR Database
     *
     * @return boolean Whether the update has been successful
     */
    public function update($value, $timestamp = null)
    {

        if ($timestamp === null) {
            $timestamp = 'N'; // NOW
        }

        $commandParts = array(
            $this->_rrdtool,
            self::COMMAND_UPDATE,
            $this->_filename
        );

        $commandParts[] = $timestamp . self::DELIMITER. $value;

        $command = join(' ', $commandParts);
        echo $command;
        $returnValue = 0;
        $ret = system($command, $returnValue);
        return $returnValue;
    }

    /**
     * Updates/sets values in a RR Database
     *
     * @return boolean Whether the update has been successful
     */
    public function graph()
    {
        $commandParts = array(
            $this->_rrdtool,
            self::COMMAND_GRAPH,
            $this->_filename . '.png'
        );

        $commandParts[] = "DEF:myspeed=foo.rrd:testsource:AVERAGE LINE2:myspeed#FF0000";

        $command = join(' ', $commandParts);
        echo $command;
        $returnValue = 0;
        $ret = system($command, $returnValue);
        return $returnValue;
    }


    /**
     * Constructor
     */
    public function __construct($filename)
    {
        $this->_filename = $filename;
    }

    /**
     * @param int|null $start
     */
    public function setStart($start)
    {
        $this->_start = $start;
    }

    /**
     * @return int|null
     */
    public function getStart()
    {
        return $this->_start;
    }

    /**
     * @param int $step
     */
    public function setStep($step)
    {
        $this->_step = $step;
    }

    /**
     * @return int
     */
    public function getStep()
    {
        return $this->_step;
    }

}
