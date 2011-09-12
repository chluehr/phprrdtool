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
 * Round Robin Archive
 *
 * Holds properties of "how" to store the data
 *
 * @author Christoph Luehr <luehr@r-pentomino.de>
 */
class Archive
{

    const PARAMETER = 'RRA';
    const DELIMITER = ':';

    /**
     * Consolidation functions
     */
    const CF_AVERAGE   = 'AVERAGE';
    const CF_MIN       = 'MIN';
    const CF_MAX       = 'MAX';
    const CF_LAST      = 'LAST';

    /**
     * Factory presets:
     */
    const FP_DAILY     = 1;
    const FP_WEEKLY    = 2;
    const FP_YEARLY    = 3;

    /**
     * Consolidation function
     * 
     * @var string
     */
    protected $_cf = self::CF_AVERAGE;

    /**
     * defines how many of these primary data points are used to build a
     * consolidated data point which then goes into the archive
     * @var int
     */
    protected $_steps;

    /**
     * defines how many generations of data values are kept in an RRA.
     * Obviously, this has to be greater than zero
     * @var int
     */
    protected $_rows;

    /**
     * the "X Files Factor"
     * a number between 0 and 1 to indicate when data is to be considered unknown
     * @var float
     */
    protected $_xff;

    /**
     *
     * Presets are based on a 5 minute data entry!
     *
     * @static
     * @return \Rrd\Archive
     */
    public static function factory($preset)
    {
        $archive = new Archive();
        $archive->setXff(0.5);
        $archive->setCf(self::CF_AVERAGE);

        switch ($preset) {

            case self::FP_YEARLY:
                $archive->setSteps(228); // average a day of data ...
                $archive->setRows(365);  // ... and keep for a year
                break;

            case self::FP_WEEKLY:
                $archive->setSteps(12); // average an hour of data ...
                $archive->setRows(168); // ... and keep for a week
                break;

            case self::FP_DAILY:
            default:
                $archive->setSteps(1);  // keep every datapoint (every 5 minutes) ..
                $archive->setRows(288); // .. and keep for a day
        }

        return $archive;
    }

    /**
     * Returns an array of the usual default presets used for monitoring
     *
     * Presets are based on a 5 minute data entry!
     *
     * @static
     * @return \Rrd\Archive[]
     */
    public static function listFactory()
    {
        $defaultList = array(
            self::factory(self::FP_DAILY),
            self::factory(self::FP_WEEKLY),
            self::factory(self::FP_YEARLY),
        );
        
        return $defaultList;
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        $output = join(
            self::DELIMITER,
            array(
                self::PARAMETER,
                $this->_cf,
                $this->_xff,
                $this->_steps,
                $this->_rows,
            )
        );

        return $output;
    }

    /**
     * @param int $rows
     */
    public function setRows($rows)
    {
        $this->_rows = $rows;
    }

    /**
     * @return int
     */
    public function getRows()
    {
        return $this->_rows;
    }

    /**
     * @param int $steps
     */
    public function setSteps($steps)
    {
        $this->_steps = $steps;
    }

    /**
     * @return int
     */
    public function getSteps()
    {
        return $this->_steps;
    }

    /**
     * @param float $xff
     */
    public function setXff($xff)
    {
        $this->_xff = $xff;
    }

    /**
     * @return float
     */
    public function getXff()
    {
        return $this->_xff;
    }

    /**
     * @param string $cf
     */
    public function setCf($cf)
    {
        $this->_cf = $cf;
    }

    /**
     * @return string
     */
    public function getCf()
    {
        return $this->_cf;
    }

}