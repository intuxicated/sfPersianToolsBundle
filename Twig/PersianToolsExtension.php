<?php
/**
 * Copyright (C) 2013  Mohammad Niknam (intuxicated.ir)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
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
            'pdate' =>  new \Twig_Filter_Method($this, 'pdateFilter'),
            'pnumber'=> new \Twig_Filter_Method($this,'pnumberFilter'),
            'pletter'=> new \Twig_Filter_Method($this, 'pletterFilter'),
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
            'pnumber' => new \Twig_Function_Method($this,'pnumber_fnc',array('is_safe'=>array('html'))),
            'pletter' => new \Twig_Function_Method($this,'pletter_fnc',array('is_safe'=>array('html'))),
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
     * Convert arabic and english numbers to persian number
     *
     * @param $string
     * @return string
     */
    public function pnumberFilter($string)
    {
        return $this->pt->pnumber($string);
    }

    /**
     * Convert arabic letters to persian
     *
     * @param $string
     * @return mixed
     */
    public function pletterFilter($string)
    {
        return $this->pt->pletter($string);
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
     * return days
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

    /**
     * Convert English/Arabic numbers to Persian numbers
     *
     * @param $string
     * @return mixed
     */
    public function pnumber_fnc($string)
    {
        return $this->pt->pnumber($string);
    }

    /**
     * Convert Arabic letters to Persian Letters
     *
     * @param $string
     * @return mixed
     */
    public function pletter_fnc($string)
    {
        return $this->pt->pletter($string);
    }

    public function getName()
    {
        return 'persian_tools_extension';
    }
}
