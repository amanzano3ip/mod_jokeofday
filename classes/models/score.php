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

namespace mod_jokeofday\models;


use cm_info;
use dml_exception;
use moodle_exception;
use stdClass;

/**
 * score
 *
 * @package    mod_jokeofday
 * @copyright  Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class score {

    /** @var string Table Jokeofday Score */
    const TABLE = 'jokeofday_score';

    /** @var int ID */
    public $id;

    /** @var int Joke ID */
    public $joke_id;

    /** @var int User ID */
    public $userid;

    /** @var int Course Module ID */
    public $cmid;

    /** @var int Course ID */
    public $course;

    /** @var int Value */
    public $value;

    /** @var int TimeCreated UnixTime */
    public $timecreated;

    /**
     * joke constructor.
     *
     * @param int $jokeid
     * @param int $userid
     * @param cm_info $cm
     * @param int $value
     */
    public function __construct(int $jokeid, int $userid, cm_info $cm, int $value) {
        $this->joke_id = $jokeid;
        $this->userid = $userid;
        $this->cmid = $cm->id;
        $this->course = $cm->course;
        $this->value = $value;
    }

    /**
     * Save.
     *
     * @throws dml_exception
     */
    public function save() {
        global $DB;

        $record = $DB->get_record(self::TABLE, ['joke_id' => $this->joke_id, 'userid' => $this->userid]);

        $object = new stdClass();
        $object->joke_id = $this->joke_id;
        $object->userid = $this->userid;
        $object->cmid = $this->cmid;
        $object->course = $this->course;
        $object->value = $this->value;
        $object->timecreated = time();

        if ($record) {
            $this->id = $record->id;
            $object->id = $record->id;
            $DB->update_record(self::TABLE, $object);
        } else {
            $this->id = $DB->insert_record(self::TABLE, $object);
        }
    }


}