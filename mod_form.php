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
 * Add jokeofday form
 *
 * @package    mod_jokeofday
 * @copyright  2024 Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

global $CFG;
require_once($CFG->dirroot.'/course/moodleform_mod.php');

/**
 * Class mod_jokeofday_mod_form
 *
 * @package    mod_jokeofday
 * @copyright  2024 Tresipunt {@link http://www.tresipunt.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_jokeofday_mod_form extends moodleform_mod {

    /**
     * Definition.
     *
     */
    public function definition() {
        global $PAGE;

        $PAGE->force_settings_menu();

        $mform = $this->_form;

        $mform->addElement('header', 'generalhdr', get_string('general'));

        // Add element for name.
        $mform->addElement(
                'text',
                'name',
                get_string('name', 'jokeofday'),
                ['size' => '64']);

        $this->standard_intro_elements('Descripción');

        $mform->addElement('text', 'numjokes',
                get_string('numjokes', 'jokeofday'), ['size' => '10']);

        // Label does not add "Show description" checkbox meaning that 'intro' is always shown on the course page.
        $mform->addElement('hidden', 'showdescription', 1);
        $mform->setType('showdescription', PARAM_INT);

        $this->standard_coursemodule_elements();

        $this->add_action_buttons(true, false, null);

    }

}
