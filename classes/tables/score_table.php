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

namespace mod_jokeofday\tables;

use core_user;
use dml_exception;
use stdClass;
use table_sql;

require_once('../../lib/tablelib.php');

/**
 * Class score_table
 *
 * @package    mod_jokeofday
 * @copyright  Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class score_table extends table_sql {

    /**
     * Constructor.
     *
     * @param string $uniqueid
     */
    public function __construct(string $uniqueid) {
        parent::__construct($uniqueid);

        $this->define_columns([
                'id',
                'joke_id',
                'userid',
                'cmid',
                'course',
                'value',
                'timecreated'
        ]);

        $this->define_headers([
                'ID',
                'Joke ID',
                'User ID',
                'CM ID',
                'Course',
                'Value',
                'Time created'
        ]);

        $this->sortable(true);
    }

    /**
     * Col User ID.
     *
     * @param stdClass $row
     * @return string
     * @throws dml_exception
     */
    public function col_userid(stdClass $row) {
        $user = core_user::get_user($row->userid);
        return fullname($user);
    }

}