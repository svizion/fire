<?php

/**
* Inflector for pluralize and singularize English nouns.
*
* This Inflector is a port of Ruby on Rails Inflector.
*
* It can be really helpful for developers that want to
* create frameworks based on naming conventions rather than
* configurations.
*
* It was ported to PHP for the Akelos Framework, a
* multilingual Ruby on Rails like framework for PHP that will
* be launched soon.
*
* Note from Aziz Light:
*  I modified this class a bit, I actually removed all of its
*  methods except singularize. I kept the method in the Inflector
*  class because in the future I might add back some other methods to it.
*
* @author Bermi Ferrer Martinez <bermi akelos com>
* @copyright Copyright (c) 2002-2006, Akelos Media, S.L. http://www.akelos.org
* @license GNU Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
* @since 0.1
* @version $Revision 0.1 $
*/
class Inflector
{
    /**
    * Singularizes English nouns.
    *
    * @access public
    * @static
    * @param string $word : English noun to singularize
    * @return string : Singular noun.
    */
    public static function singularize($word)
    {
        $singular = array(
            '/(quiz)zes$/i' => '\\1',
            '/(matr)ices$/i' => '\\1ix',
            '/(vert|ind)ices$/i' => '\\1ex',
            '/^(ox)en/i' => '\\1',
            '/(alias|status)es$/i' => '\\1',
            '/([octop|vir])i$/i' => '\\1us',
            '/(cris|ax|test)es$/i' => '\\1is',
            '/(shoe)s$/i' => '\\1',
            '/(o)es$/i' => '\\1',
            '/(bus)es$/i' => '\\1',
            '/([m|l])ice$/i' => '\\1ouse',
            '/(x|ch|ss|sh)es$/i' => '\\1',
            '/(m)ovies$/i' => '\\1ovie',
            '/(s)eries$/i' => '\\1eries',
            '/([^aeiouy]|qu)ies$/i' => '\\1y',
            '/([lr])ves$/i' => '\\1f',
            '/(tive)s$/i' => '\\1',
            '/(hive)s$/i' => '\\1',
            '/([^f])ves$/i' => '\\1fe',
            '/(^analy)ses$/i' => '\\1sis',
            '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\\1\\2sis',
            '/([ti])a$/i' => '\\1um',
            '/(n)ews$/i' => '\\1ews',
            '/s$/i' => '',
        );

        $uncountable = array('equipment', 'information', 'rice', 'money', 'species', 'series', 'fish', 'sheep');

        $irregular = array(
            'person' => 'people',
            'man' => 'men',
            'child' => 'children',
            'sex' => 'sexes',
            'move' => 'moves'
        );

        $lowercased_word = strtolower($word);
        foreach ($uncountable as $_uncountable)
        {
            if (substr($lowercased_word, (-1 * strlen($_uncountable))) == $_uncountable)
            {
                return $word;
            }
        }

        foreach ($irregular as $_plural => $_singular)
        {
            if (preg_match('/(' . $_singular . ')$/i', $word, $arr))
            {
                return preg_replace('/(' . $_singular . ')$/i', substr($arr[0], 0, 1) . substr($_plural, 1), $word);
            }
        }

        foreach ($singular as $rule => $replacement)
        {
            if (preg_match($rule, $word))
            {
                return preg_replace($rule, $replacement, $word);
            }
        }
        return $word;
    } // End of singularize

} // End of Inflector
