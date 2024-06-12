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
use moodle_exception;
use stdClass;

/**
 * joke
 *
 * @package    mod_jokeofday
 * @copyright  Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class joke {

    /** @var string Table Jokeofday Jokes */
    const TABLE = 'jokeofday_jokes';

    /** @var int ID */
    public $id;

    /** @var string Category */
    public $category;

    /** @var string Lang ISO */
    public $lang;

    /** @var int Joke ID */
    public $joke_id;

    /** @var string Type */
    public $type;

    /** @var string Joke */
    public $joke;

    /** @var stdClass Flags */
    public $flags;

    /** @var bool Safe */
    public $safe;

    /**
     * joke constructor.
     *
     * @param stdClass $object
     * @throws moodle_exception
     */
    public function __construct(stdClass $object) {
        $this->validate($object);
    }

    /**
     * Validate.
     *
     * @param $object
     * @throws moodle_exception
     */
    private function validate($object) {
        if (isset($object->category)) {
            $this->category = $object->category;
        } else {
            throw new moodle_exception('Category not found');
        }
        if (isset($object->lang)) {
            $this->lang = $object->lang;
        } else {
            throw new moodle_exception('Lang not found');
        }
        if (isset($object->id)) {
            $this->joke_id = $object->id;
        } else {
            throw new moodle_exception('Joke id not found');
        }
        if (isset($object->type)) {
            $this->type = $object->type;
        } else {
            throw new moodle_exception('Type not found');
        }
        if (isset($object->joke)) {
            $this->joke = $object->joke;
        } else {
            throw new moodle_exception('Joke not found');
        }
        if (isset($object->flags)) {
            $this->flags = $object->flags;
        } else {
            throw new moodle_exception('Flags not found');
        }
        if (isset($object->safe)) {
            $this->safe = $object->safe;
        } else {
            throw new moodle_exception('Safe not found');
        }
    }

    /**
     * Get by Joke ID.
     *
     * @param int $id
     * @return false|mixed|stdClass
     * @throws dml_exception
     */
    public static function get(int $id) {
        global $DB;
        return $DB->get_record(self::TABLE, ['id' => $id]);
    }

    /**
     * Save.
     *
     * @return joke
     * @throws dml_exception
     */
    public function save(): joke {
        global $DB;

        $record = $DB->get_record(self::TABLE, ['joke_id' => $this->joke_id]);

        $object = new stdClass();
        $object->category = $this->category;
        $object->lang = $this->lang;
        $object->joke_id = $this->joke_id;
        $object->type = $this->type;
        $object->joke = $this->joke;
        $object->flags = json_encode($this->flags);
        $object->safe = $this->safe;

        if ($record) {
            $this->id = $record->id;
            $object->id = $record->id;
            $DB->update_record(self::TABLE, $object);
        } else {
            $this->id = $DB->insert_record(self::TABLE, $object);
        }

        return $this;
    }


}