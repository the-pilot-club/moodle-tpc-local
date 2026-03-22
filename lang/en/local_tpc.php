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
 * Languages configuration for the local_tpc plugin.
 *
 * @package   local_tpc
 * @copyright The Pilot Club Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'TPC Moodle Integrations';

// Settings Pages Names
$string['generalsettings'] = 'General Settings';
$string['fecsettings'] = 'Flying Essentials Course Settings';

// General Settings

$string['webhookid'] = 'Discord Webhook ID';
$string['webhookid_desc'] = 'This sets the Discord Webhook ID where updates will be sent.';

$string['webhooktoken'] = 'Discord Webhook Token';
$string['webhooktoken_desc'] = 'This sets the Discord Webhook Token where updates will be sent.';

$string['pramsapiurl'] = 'PRAMS API URL';
$string['pramsapiurl_desc'] = 'This sets the URL of the PRAMS API.';

$string['pramsapikey'] = 'PRAMS API Key';
$string['pramsapikey_desc'] = 'This sets the API key to use when accessing the PRAMS API.';


// FEC Settings

$string['quizid_fec'] = 'Quiz ID for Flying Essentials Course';
$string['quizid_fec_desc'] = 'This specifies the quiz ID for the Flying Essentials course.';

$string['badgeid_fec'] = 'Badge ID for Flying Essentials Course';
$string['badgeid_fec_desc'] = 'This specifies the Badge ID for the Flying Essentials course.';