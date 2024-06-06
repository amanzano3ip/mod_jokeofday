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

namespace mod_jokeofday\requests;

use curl;
use dml_exception;

/**
 * Class api
 *
 * @package    mod_jokeofday
 * @copyright  Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class api {

    /** @var string URL API */
    protected $url;

    /** @var int Timeout in seconds */
    protected $timeout;

    /**
     * Constructor.
     *
     * @throws dml_exception
     */
    public function __construct() {
        $this->url = get_config('jokeofday', 'url');
        $this->timeout = empty(get_config('jokeofday', 'timeout')) ? 15 :
                get_config('jokeofday', 'timeout');
    }

    /**
     * Get Jokes.
     *
     * @return array
     */
    public function get_jokes(): array {
        $jokes = [];
        $curl = new curl();
        try {
            $res = $curl->get($this->url . '/Any?amount=10&type=single');
            $res = json_decode($res);
            if ($res->error === false) {
                if (isset($res->jokes)) {
                    $jokes = $res->jokes;
                }
            } else {
                if (isset($res->message)) {
                    var_dump($res->message);
                } else {
                    var_dump('Error no controlado');
                }
            }
        } catch (\Exception $e) {
            debugging($e->getMessage());
            var_dump($e->getMessage());
        }
        return $jokes;
    }


}