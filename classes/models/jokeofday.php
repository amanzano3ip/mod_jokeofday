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


use dml_exception;
use stdClass;

/**
 * jokeofday
 *
 * @package    mod_jokeofday
 * @copyright  Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class jokeofday {

    /** @var string Table Jokeofday */
    const TABLE = 'jokeofday';

    /**
     * Insert.
     *
     * @param stdClass $jokeofday
     * @return bool|int
     * @throws dml_exception
     */
    public static function insert(stdClass $jokeofday): bool|int {
        global $DB;
        $jokeofday->timemodified = time();
        return $DB->insert_record(self::TABLE, $jokeofday);
    }

    /**
     * Update.
     *
     * @param stdClass $jokeofday
     * @return bool|int
     * @throws dml_exception
     */
    public static function update(stdClass $jokeofday): bool|int {
        global $DB;
        $jokeofday->timemodified = time();
        $jokeofday->id = $jokeofday->instance;
        return $DB->update_record(self::TABLE, $jokeofday);
    }

    /**
     * Delete.
     *
     * @param int $id
     * @return bool|int
     * @throws dml_exception
     */
    public static function delete(int $id): bool|int {
        global $DB;

        if (! $jokeofday = $DB->get_record(self::TABLE,
                ['id' => $id])) {
            return false;
        }

        $result = true;

        if (! $DB->delete_records(self::TABLE,
                ['id' => $jokeofday->id])) {
            $result = false;
        }

        return $result;
    }

}

