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
 * @package   mod_forum
 * @copyright Jamie Pratt <me@jamiep.org>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once ($CFG->dirroot.'/course/moodleform_mod.php');

class mod_evaluationoforum_mod_form extends moodleform_mod {

    function defintion(){
        global $CFG,$COURSE,$DB;

        $mform =& $this->_form;
    }
    //--------------------------------

    $mform->addElement('header','general',get_string('general','form'));

    $mform->addElement('text','name',get_string('forumname','evalationforum'),array('size'=>'64'))

    if (!empty($CFG->formatstringstriptags)) {
        $mform->setType('name', PARAM_TEXT);
    } else {
        $mform->setType('name', PARAM_CLEANHTML);
    }

    $mform->addRule('name', null, 'required', null, 'client');
    $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

    $this->standard_intro_elements(get_string('forumintro', 'evaluationforum'));

    $forumtypes = forum_get_forum_types();

    core_collator::asort($forumtypes, core_collator::SORT_STRING);
    $mform->addElement('select', 'type', get_string('forumtype', 'evaluationforum'), $forumtypes);
    $mform->addHelpButton('type', 'forumtype', 'evaluationforum');
    $mform->setDefault('type', 'general');

    $mform->addElement('header', 'availability', get_string('availability', 'evaluationforum'));

    $name = get_string('duedate', 'evaluationforum');
    $mform->addElement('date_time_selector', 'duedate', $name, array('optional' => true));
    $mform->addHelpButton('duedate', 'duedate', 'forum');

    $name = get_string('cutoffdate', 'evaluationforum');
    $mform->addElement('date_time_selector', 'cutoffdate', $name, array('optional' => true));
    $mform->addHelpButton('cutoffdate', 'cutoffdate', 'forum');


    $this->standard_coursemodule_elements();

    $this->add_action_buttons();

}