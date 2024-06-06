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
 * Resource module admin settings and defaults
 *
 * @package    mod_jokeofday
 * @copyright  2024 Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    $settings->add(new admin_setting_configtext('jokeofday/url',
        get_string('url', 'mod_jokeofday'),
            get_string('url_desc', 'mod_jokeofday'),
            'https://v2.jokeapi.dev/joke', PARAM_URL));

    $settings->add(new admin_setting_configduration('jokeofday/timeout',
        get_string('timeout', 'mod_jokeofday'),
            get_string('timeout_desc', 'mod_jokeofday'),
            10));

}
