<?php
/**
 * Copyright (C) 2013  Mohammad Niknam (intuxicated.ir)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace Intuxicated\PersianToolsBundle\Twig;

use Intuxicated\PersianToolsBundle\Lib\PersianTools;

class PersianToolsExtension extends \Twig_Extension
{
    /**
     * @var \Intuxicated\PersianToolsBundle\Lib\PersianTools
     */
    private $pt;

    public function __construct()
    {
        $this->pt = new PersianTools;
    }

    public function getFilters()
    {
        return array(
            'pdate' => new \Twig_Filter_Method($this, 'pdateFilter'),
            'pnumber'=> new \Twig_Filter_Method($this,'pnumberFilter'),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'pdate' => new \Twig_Function_Method($this, 'pdate_fnc', array('is_safe' => array('html'))),
            'pstrftime' => new \Twig_Function_Method($this,'pstrftime_fnc',array('is_safe'=>array('html'))),
            'DayOfYear' => new \Twig_Function_Method($this,'DayOfYear_fnc',array('is_safe'=>array('html'))),
            'isKabise' => new \Twig_Function_Method($this,'isKabise_fnc',array('is_safe'=>array('html'))),
            'pmktime' => new \Twig_Function_Method($this,'pmktime_fnc',array('is_safe'=>array('html'))),
            'pcheckdate' => new \Twig_Function_Method($this,'pcheckdate_fnc',array('is_safe'=>array('html'))),
            'pgetdate' => new \Twig_Function_Method($this,'pgetdate_fnc',array('is_safe'=>array('html'))),
        );
    }

    /**
     * @param null $timestamp
     * @param string $format
     * @return string
     */

    public function pdateFilter($timestamp = NULL,$format = 'Y-m-d')
    {
        return $this->pt->pdate($format,$timestamp);
    }

    /**
     * @param $string
     * @return string
     */
    public function pnumberFilter($string)
    {
        return $this->pt->pnumber($string);
    }

    /**
     * @see http://www.php.net/manual/en/function.date.php
     * @param string $format
     * @param null $timestamp
     * @return string
     */
    public function pdate_fnc($format = 'Y-m-d',$timestamp = NULL)
    {
        return $this->pt->pdate($format,$timestamp);
    }

    /**
     * @see http://www.php.net/manual/en/function.strftime.php
     * @param $format
     * @param null $timestamp
     * @return string
     */
    function pstrftime_fnc($format, $timestamp = NULL){
        return $this->pt->pstrftime($format,$timestamp);
    }

    /**
     * return days number of a month
     *
     * @param $pMonth
     * @param $pDay
     * @return int
     */
    public function DayOfYear_fnc($pMonth, $pDay)
    {
        return $this->pt->DayOfYear($pMonth,$pDay);
    }

    /**
     * return true if year is intercalary
     *
     * @param $year
     * @return int
     */
    function isKabise_fnc($year) {
        return $this->pt->isKabise($year);
    }

    /**
     * @see http://www.php.net/manual/en/function.mktime.php
     *
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param int $month
     * @param int $day
     * @param int $year
     * @param $is_dst
     * @return mixed
     */
    function pmktime_fnc($hour = 0, $minute = 0, $second = 0, $month = 0, $day = 0, $year = 0, $is_dst = -1){
        return $this->pmktime($hour, $minute, $second, $month, $day, $year, $is_dst);
    }

    /**
     * @see http://www.php.net/manual/en/function.checkdate.php
     *
     * @param $month
     * @param $day
     * @param $year
     * @return int
     */
    function pcheckdate_fnc($month, $day, $year){
        return $this->pt->pcheckdate($month,$day,$year);
    }

    /**
     * @see http://www.php.net/manual/en/function.getdate.php
     *
     * @param null $timestamp
     * @return array
     */
    function pgetdate_fnc($timestamp = NULL){
        return $this->pt->pgetdate($timestamp);
    }

    public function getName()
    {
        return 'persian_tools_extension';
    }
}
