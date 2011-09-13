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
class Graph
{

    protected $_title;
    protected $_verticalLabel;
    protected $_width = 400;
    protected $_height = 100;
    protected $_imgFormat = 'PNG';

    // --end now
    // --start end-120000s

    /*
    PRINT:vname:format
    GPRINT:vname:format
    COMMENT:text
    VRULE:time#color[:legend][:dashes[=on_s[,off_s[,on_s,off_s]...]][:dash-offset=offset]]
    HRULE:value#color[:legend][:dashes[=on_s[,off_s[,on_s,off_s]...]][:dash-offset=offset]]
    LINE[width]:value[#color][:[legend][:STACK]][:dashes[=on_s[,off_s[,on_s,off_s]...]][:dash-offset=offset]]
    AREA:value[#color][:[legend][:STACK]]
    TICK:vname#rrggbb[aa][:fraction[:legend]]
    SHIFT:vname:offset
    TEXTALIGN:{left|right|justified|center}
    PRINT:vname:CF:format (deprecated)
    GPRINT:vname:CF:format (deprecated)
    STACK:vname#color[:legend] (deprecated)
    */

}
