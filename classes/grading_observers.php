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
 * Grading observers.
 *
 * @package   local_tpc
 * @category  event
 * @copyright The Pilot Club Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_tpc;

use GuzzleHttp\Client;

defined('MOODLE_INTERNAL') || die();

class grading_observers {
    /**
     * A quiz attempt has been submitted.
     *
     * @param \mod_quiz\event\attempt_submitted $event The event.
     * @return bool
     */
    public static function processFECAttempt($event) {
        $attempt = $event->get_record_snapshot('quiz_attempts', $event->objectid);
        $quiz = $event->get_record_snapshot('quiz', $attempt->quiz);
        $student = \core_user::get_user($event->relateduserid);
        $webhookid = get_config('local_tpc', 'webhookid');
        $webhooktoken = get_config('local_tpc', 'webhooktoken');
        $pramsurl = get_config('local_tpc', 'pramsapiurl');
        $pramskey = get_config('local_tpc', 'pramsapikey');
        $badge_id = get_config('local_tpc', 'badgeid_fec');

        $maxgrade = (float) $quiz->sumgrades;
        $grade = $attempt->sumgrades / $maxgrade * 100;

        if ($grade >= 80) {
            if (!empty($webhookid) && !empty($webhooktoken)) {
                $discord = new Client([
                    'base_uri' => 'https://discord.com',
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'User-Agent' => 'TPCFlightSchool',
                        'Accept' => 'application/json',
                    ],
                ]);

                $response = $discord->post("/api/webhooks/$webhookid/$webhooktoken", [
                    'json' => [
                        'embeds' => [
                            [
                                'title' => 'Flying Essentials Course Completion Notification!',
                                'thumbnail' => [
                                    'url' => 'https://static1.squarespace.com/static/614689d3918044012d2ac1b4/t/616ff36761fabc72642806e3/1634726781251/TPC_FullColor_TransparentBg_1280x1024_72dpi.png',
                                ],
                                'fields' => [
                                    [
                                        'name' => 'CID', 'value' =>  $student->username,
                                    ],
                                ],
                                'color' => 3651327,
                                'footer' => [
                                    'text' => 'Made by TPC Dev Team | TPC Flight School',
                                ],
                            ],
                        ],
                    ]
                ]);
                if ($response->getStatusCode() != 204) {
                    return false;
                }
            }

            if (!empty($pramsurl) && !empty($pramskey)) {
                $prams = new Client([
                    'base_uri' => 'https://prams.vatsim.net',
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'User-Agent' => 'TPCFlightSchool',
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $pramskey,
                    ],
                ]);

                $response = $prams->post($pramsurl, [
                    'json' => [
                        'user_cid' => $student->username,
                        'badge_id' => $badge_id,
                    ]
                ]);

                if ($response->getStatusCode() != 201) {
                    return false;
                }
            }

        }
        return true;
    }

    public static function attempt_submitted($event) {
        $attempt = $event->get_record_snapshot('quiz_attempts', $event->objectid);
        $quiz = $event->get_record_snapshot('quiz', $attempt->quiz);

        $configquizidFEC = get_config('local_tpc', 'quizid_fec');

        match ($quiz->id) {
            $configquizidFEC => self::processFECAttempt($event),
            default => true,
        };

        return true;
    }
}
