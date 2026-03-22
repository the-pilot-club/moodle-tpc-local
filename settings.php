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
 * Plugin admin settings.
 *
 * @package   local_tpc
 * @copyright The Pilot Club Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new theme_boost_admin_settingspage_tabs('tpc', new lang_string('pluginname', 'local_tpc'));
    if ($ADMIN->fulltree) {
    $general = new admin_settingpage('tpc_general', new lang_string('generalsettings', 'local_tpc'));
    $fec = new admin_settingpage('tpc_fec', new lang_string('fecsettings', 'local_tpc'));

        $general->add(new admin_setting_configtext(
            'local_tpc/webhookid',
            new lang_string('webhookid', 'local_tpc'),
            new lang_string('webhookid_desc', 'local_tpc'),
            '',
            PARAM_TEXT
        ));

        $general->add(new admin_setting_configtext(
            'local_tpc/webhooktoken',
            new lang_string('webhooktoken', 'local_tpc'),
            new lang_string('webhooktoken_desc', 'local_tpc'),
            '',
            PARAM_TEXT
        ));

        $general->add(new admin_setting_configtext(
            'local_tpc/pramsapiurl',
            new lang_string('pramsapiurl', 'local_tpc'),
            new lang_string('pramsapiurl_desc', 'local_tpc'),
            '',
            PARAM_TEXT
        ));

        $general->add(new admin_setting_configtext(
            'local_tpc/pramsapikey',
            new lang_string('pramsapikey', 'local_tpc'),
            new lang_string('pramsapikey_desc', 'local_tpc'),
            '',
            PARAM_TEXT
        ));


        $fec->add(new admin_setting_configtext(
            'local_tpc/quizid_fec',
            new lang_string('quizid_fec', 'local_tpc'),
            new lang_string('quizid_fec_desc', 'local_tpc'),
            '',
            PARAM_INT
        ));
        $fec->add(new admin_setting_configtext(
            'local_tpc/badgeid_fec',
            new lang_string('badgeid_fec', 'local_tpc'),
            new lang_string('badgeid_fec_desc', 'local_tpc'),
            '',
            PARAM_INT
        ));


        $settings->add($general);
        $settings->add($fec);


    $ADMIN->add('localplugins', $settings);
}
}
