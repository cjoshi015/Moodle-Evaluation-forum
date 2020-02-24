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

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}
 
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/evaluationforum/lib.php');
 
class mod_evaluationforum_mod_form extends moodleform_mod {
 
    function definition() {
        global $CFG, $DB, $OUTPUT;
 
        $mform =& $this->_form;
 
        $mform->addElement('text', 'name', get_string('activityname', 'certificate'), array('size'=>'64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
 
        $ynoptions = array(0 => get_string('no'),
                           1 => get_string('yes'));
        $mform->addElement('select', 'usecode', get_string('usecode', 'certificate'), $ynoptions);
        $mform->setDefault('usecode', 0);
        $mform->addHelpButton('usecode', 'usecode', 'certificate');
 
        $this->standard_coursemodule_elements();
 
        $this->add_action_buttons();
    }
}
