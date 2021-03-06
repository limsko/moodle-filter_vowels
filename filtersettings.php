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
 * Filter vowels settings.
 *
 * @package    filter_vowels
 * @copyright  2015 onwards Kamil Łuczak <kamil@limsko.pl>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $defaultsetting = 'aiouwzAIOUWZ';
    $settings->add(new admin_setting_configtext('filter_vowels/letters',
            get_string('letters', 'filter_vowels'),
            get_string('letters_desc', 'filter_vowels'), $defaultsetting));

    $defaultsetting = 'on,in,is,at,up,to';
    $settings->add(new admin_setting_configtextarea('filter_vowels/words',
            get_string('words', 'filter_vowels'),
            get_string('words_desc', 'filter_vowels'), $defaultsetting));

    $defaultsetting = '';
    $settings->add(new admin_setting_configtextarea('filter_vowels/words_before',
            get_string('wordsbefore', 'filter_vowels'),
            get_string('wordsbeforedesc', 'filter_vowels'), $defaultsetting));

    $settings->add(new admin_setting_configcheckbox('filter_vowels/wordsenable',
            get_string('wordsenable', 'filter_vowels'),
            get_string('wordsenable_desc', 'filter_vowels'), 0));
}