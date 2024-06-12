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
use mod_jokeofday\tables\score_table;
use renderable;
use templatable;
use renderer_base;
use stdClass;

/**
 * Class index_page
 *
 * @package    mod_jokeofday
 * @copyright  Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class index_page implements renderable, templatable {

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
     */
    public function export_for_template(renderer_base $output): stdClass {
        $data = new stdClass();
        $data->scoretable = $this->get_score_table();
        return $data;
    }

    /**
     * Get Score Table.
     *
     * @return string
     */
    protected function get_score_table() {
        $uniqid = uniqid('', true);
        $table = new score_table($uniqid);
        $table->is_downloadable(false);
        $select = 'js.id, js.joke_id, js.userid, js.cmid, js.course, js.value, js.timecreated';
        $from = '{jokeofday_score} js';
        $where = '1=1';
        $params = [];
        $table->set_sql($select, $from, $where, $params);
        $table->sortable(true, 'id', SORT_DESC);
        $table->pageable(true);
        $table->collapsible(false);
        $table->define_baseurl('mod/jokeofday/index.php');
        ob_start();
        $table->out(10, true, false);
        $tablecontent = ob_get_contents();
        ob_end_clean();
        return $tablecontent;
    }

}
