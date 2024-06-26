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
 * Joke External.
 *
 * @package    mod_jokeofday
 * @copyright  2024 Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_jokeofday\external;

use dml_exception;
use external_api;
use external_function_parameters;
use external_multiple_structure;
use external_single_structure;
use external_value;
use invalid_parameter_exception;
use mod_jokeofday\models\joke;
use mod_jokeofday\models\score;
use moodle_exception;
use stdClass;

global $CFG;
require_once($CFG->libdir . '/externallib.php');

class joke_external extends external_api {

    /**
     * Joke Parameters.
     *
     * @return external_function_parameters
     */
    public static function score_parameters(): external_function_parameters {
        return new external_function_parameters(
                [
                        'jokeid' => new external_value(PARAM_INT, 'Joke ID'),
                        'score' => new external_value(PARAM_INT, 'Score'),
                        'cmid' => new external_value(PARAM_INT, 'Course Module ID'),
                ]
        );
    }

    /**
     * Score
     *
     * @param int $jokeid
     * @param int $score
     * @param int $cmid
     * @return array
     * @throws dml_exception
     * @throws invalid_parameter_exception
     * @throws \moodle_exception
     */
    public static function score(int $jokeid, int $score, int $cmid): array {
        global $USER;
        $params = self::validate_parameters(
                self::score_parameters(), [
                        'jokeid' => $jokeid,
                        'score' => $score,
                        'cmid' => $cmid,
                ]
        );

        $error = '';

        $data = new stdClass();
        $data->jokeid = $params['jokeid'];
        $data->score = $params['score'];

        list($course, $cm) = get_course_and_cm_from_cmid($params['cmid']);

        $joke = joke::get($params['jokeid']);

        if ($joke) {
            try {
                $score = new score($joke->id, $USER->id, $cm, $params['score']);
                $score->save();
                $success = true;
            } catch (moodle_exception $e) {
                $error = $e->getMessage();
                $success = false;
            }
        } else {
            $success = false;
            $error = 'El chiste no se ha encontrado en DB';
        }

        return [
                'success' => $success,
                'error' => $error,
                'data' => $data
        ];

    }

    /**
     * Score Returns.
     *
     * @return external_single_structure
     */
    public static function score_returns(): external_single_structure {
        return new external_single_structure(
               [
                       'success' =>  new external_value(PARAM_BOOL, 'Was it a success?'),
                       'error' =>  new external_value(PARAM_TEXT, 'Error message'),
                       'data' =>  new external_single_structure(
                               [
                                       'jokeid' => new external_value(PARAM_INT, 'Joke ID'),
                                       'score' => new external_value(PARAM_INT, 'Score'),
                               ]
                       ),
               ]
        );
    }



}

