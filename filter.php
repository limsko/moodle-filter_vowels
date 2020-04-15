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
 * Filter converting configured single characters or words and glues it with next word with non breaking character.
 *
 * @package    filter
 * @subpackage vowels
 * @copyright  2015 onwards Kamil Łuczak <kamil@limsko.pl>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class filter_vowels extends moodle_text_filter {

    /**
     * @var array global configuration for this filter
     */
    protected static $globalconfig;

    /**
     * Main filter function that apply the filter to the text.
     *
     * @param string $text to be processed by the text
     * @param array $options filter options
     * @return string text after processing
     * @throws dml_exception
     * @see filter_manager::apply_filter_chain()
     */
    public function filter($text, array $options = array()) {

        // Get filter config.
        if ($this->get_global_config('letters')) {
            $letters = $this->get_global_config('letters');
        } else {
            $letters = 'aiouwzAIOUWZ';
        }

        // First filter all single characters.
        $expr = '\s+(\b[' . $letters . ']\b)';
        $pattern = '/' . $expr . '(?![^<>]*>)\s/u';  // The expression '(?![^<>]*>)' is used to skip html tag attributes.
        $replacement = ' \1&nbsp;';
        $text = preg_replace($pattern, $replacement, $text);

        // Do it again and now fix `&nbsp;CHAR WORD` into `&nbspCHAR&nbsp;WORD`.
        $expr = '(?:\s|&nbsp;)(\b[' . $letters . ']\b)';
        $pattern = '/' . $expr . '(?![^<>]*>)\s/u';
        $replacement = '&nbsp;\1&nbsp;';
        $text = preg_replace($pattern, $replacement, $text);

        // Then replace all spaces after configured words.
        if ($this->get_global_config('wordsenable') and $this->get_global_config('words')) {
            foreach (explode(',', $this->get_global_config('words')) as $val) {
                if (is_string($val)) {
                    $expr = '(\b' . $val . '\b)';
                    $pattern = '/' . $expr . '(?![^<>]*>)\s/u';
                    $replacement = '\1&nbsp;';
                    $text = preg_replace($pattern, $replacement, $text);
                }
            }
        }

        // And at end replace all spaces before configured words.
        if ($this->get_global_config('wordsenable') and $this->get_global_config('words_before')) {
            foreach (explode(',', $this->get_global_config('words_before')) as $val) {
                if (is_string($val)) {
                    $expr = '\s(\b' . $val . '\b)';
                    $pattern = '/' . $expr . '(?![^<>]*>)/u';
                    $replacement = '&nbsp;\1';
                    $text = preg_replace($pattern, $replacement, $text);
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
     * @return string|array|null
     * @throws dml_exception
     */
    protected function get_global_config($name = null) {
        $this->load_global_config();
        if (is_null($name)) {
            return self::$globalconfig;

        } else if (array_key_exists($name, self::$globalconfig)) {
            return self::$globalconfig->{$name};

        } else {
            return null;
        }
    }

    /**
     * Makes sure that the global config is loaded in $this->globalconfig
     *
     * @throws dml_exception
     */
    protected function load_global_config() {
        if (is_null(self::$globalconfig)) {
            self::$globalconfig = get_config('filter_vowels');
        }
    }
}