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
 * Library of functions and constants for module jokeofday
 *
 * @package    mod_jokeofday
 * @copyright  2024 Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("../../config.php");
global $PAGE, $OUTPUT;


$cmid = required_param('id', PARAM_INT);

list($course, $cm) = get_course_and_cm_from_cmid($cmid);

/** @var cm_info $cminfo */
$cminfo = $cm;

require_login($course);
$contextmodule = context_module::instance($cminfo->id);

$PAGE->set_url(new moodle_url('/mod/jokeofday/view.php'));
$PAGE->set_context($contextmodule);
$PAGE->set_title($cminfo->get_name());
$PAGE->set_heading($cminfo->get_name());
$PAGE->set_pagelayout('incourse');

echo $OUTPUT->header();

$renderer = $PAGE->get_renderer('mod_jokeofday');
$page = new \mod_jokeofday\output\index_page($cminfo);
echo $renderer->render($page);

echo $OUTPUT->footer();


//$PAGE->set_url('/mod/label/index.php', ['id' => $id]);

///redirect("$CFG->wwwroot/course/view.php?id=$id");


