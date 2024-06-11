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
 * Services
 *
 * @package    mod_jokeofday
 * @copyright  2024 Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_jokeofday\external\joke_external;

defined('MOODLE_INTERNAL') || die();

$functions = [

        'mod_jokeofday_joke_score' => [
                'classname' => joke_external::class,
                'methodname' => 'score',
                'description' => 'User score a joke',
                'type' => 'write',
                'ajax' => true,
                'loginrequired' => true,
        ],

];

$services = [
        'mod_jokeofday' => [
                'functions' => [
                        'mod_jokeofday_joke_score',
                ],
                'downloadfiles' => 1,
                'restrictedusers' => 1,
                'enabled' => 1
        ]
];
