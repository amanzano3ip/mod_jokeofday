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

use moodle_exception;
use plugin_renderer_base;

/**
 * Renderer for JokeOfDay
 *
 * @package    mod_jokeofday
 * @copyright  2024 Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends plugin_renderer_base {

    /**
     * Render view_page
     *
     * @param view_page $page
     * @return bool|string
     * @throws moodle_exception
     */
    public function render_view_page(view_page $page): bool|string {
        $data = $page->export_for_template($this);
        return parent::render_from_template("mod_jokeofday/view_page", $data);
    }

    /**
     * Render index_page
     *
     * @param index_page $page
     * @return bool|string
     * @throws moodle_exception
     */
    public function render_index_page(index_page $page): bool|string {
        $data = $page->export_for_template($this);
        return parent::render_from_template("mod_jokeofday/index_page", $data);
    }

}
