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

namespace mod_jokeofday\output;
use cm_info;
use dml_exception;
use mod_jokeofday\models\jokeofday;
use mod_jokeofday\requests\api;
use renderable;
use templatable;
use renderer_base;
use stdClass;

/**
 * Class view_page
 *
 * @package    mod_jokeofday
 * @copyright  Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class view_page implements renderable, templatable {

    /** @var cm_info Course Module */
    protected $cm;

    /**
     * view_page constructor.
     *
     * @param cm_info $cm
     */
    public function __construct(cm_info $cm) {
        $this->cm = $cm;
    }

    /**
     * Export for Template.
     *
     * @param renderer_base $output
     * @return stdClass
     * @throws dml_exception
     */
    public function export_for_template(renderer_base $output): stdClass {
        $data = new stdClass();
        $jokeofday = jokeofday::get($this->cm->instance);
        $api = new api();
        $data->jokes = $api->get_jokes($jokeofday->numjokes);
        return $data;
    }



}
