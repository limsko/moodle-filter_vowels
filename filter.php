<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Filter converting URLs in the text to HTML links
 *
 * @package    filter
 * @subpackage vowels
 * @copyright  2015 Kamil Łuczak <kamil@limsko.pl>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class filter_vowels extends moodle_text_filter {

     /**
      * @var array global configuration for this filter
      *
      * This might be eventually moved into parent class if we found it
      * useful for other filters, too.
      */
    protected static $globalconfig;

    /**
     * Apply the filter to the text
     *
     * @see filter_manager::apply_filter_chain()
     * @param string $text to be processed by the text
     * @param array $options filter options
     * @return string text after processing
     */
    public function filter($text, array $options = array()) {

	 	  //GET filter config
		  if ($this->get_global_config('letters')) {
		  	$letters = $this->get_global_config('letters');
		  } else {
			$letters = 'aiouwzAIOUWZ';
		  }

        // TODO: Check that javascripts working good
		  // TODO2: Add Polish letters support
		  /*
		  *
		  *		Replace all spaces after configured letters
		  *
		  */
		  $expr = '\s+(\b['.$letters.']\b)\s';
		  $pattern      = '/'.$expr.'(?=[^<>]*<)/';
	 	  $replacement  = ' \1&nbsp;';
		  $text = preg_replace( $pattern, $replacement, $text );
		  /*
		  *
		  *		Replace all spaces after configured words
		  *
		  */
		  if ($this->get_global_config('wordsenable') and $this->get_global_config('words')) {
				foreach(explode(',',$this->get_global_config('words')) AS $val){
					if(is_string($val)) {
						$expr = '\s(\b'.$val.'\b)\s';
						$pattern      = '/'.$expr.'(?=[^<>]*<)/';
		    			$replacement  = ' \1&nbsp;';
						$text = preg_replace( $pattern, $replacement, $text );
					}
				}
		  }
		  /*
		  *
		  *		Replace all spaces before configured words
		  *
		  */
		  if ($this->get_global_config('wordsenable') and $this->get_global_config('words_before')) {
				foreach(explode(',',$this->get_global_config('words_before')) AS $val){
					if(is_string($val)) {
						$expr = '\s(\b'.$val.'\b)';
						$pattern      = '/'.$expr.'(?=[^<>]*<)/';
		    			$replacement  = '&nbsp;\1';
						$text = preg_replace( $pattern, $replacement, $text );
					}
				}
		  }

			return $text;
    }


    /**
     * Returns the global filter setting
     *
     * If the $name is provided, returns single value. Otherwise returns all
     * global settings in object. Returns null if the named setting is not
     * found.
     *
     * @param mixed $name optional config variable name, defaults to null for all
     * @return string|object|null
     */
    protected function get_global_config($name=null) {
        $this->load_global_config();
        if (is_null($name)) {
            return self::$globalconfig;

        } elseif (array_key_exists($name, self::$globalconfig)) {
            return self::$globalconfig->{$name};

        } else {
            return null;
        }
    }

    /**
     * Makes sure that the global config is loaded in $this->globalconfig
     *
     * @return void
     */
    protected function load_global_config() {
        if (is_null(self::$globalconfig)) {
            self::$globalconfig = get_config('filter_vowels');
        }
    }
}