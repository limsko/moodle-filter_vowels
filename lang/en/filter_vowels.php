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
 * Strings for filter_vowels, language en.
 *
 * @package    filter_vowels
 * @copyright  2015 onwards Kamil Łuczak <kamil@limsko.pl>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['filtername'] = 'Auto non-breaking space filter';
$string['letters'] = 'Apply to this single characters';
$string['letters_desc'] = 'The filter will be applied only to letters specified in this field. Filter is case sensitive.';
$string['words'] = 'Additional filtering after words';
$string['words_desc'] = 'Put here comma separated words after which spaces will be changed into &amp;nbsp;<br />This function requires enabling words filtering. Filter is case sensitive.';
$string['wordsbefore'] = 'Additional filtering before words';
$string['wordsbeforedesc'] = 'Put here comma separated words before which spaces will be changed into &amp;nbsp;<br />This function requires enabling words filtering. Filter is case sensitive.';
$string['wordsenable'] = 'Enable words filtering';
$string['wordsenable_desc'] = 'Enables filtering also for words';