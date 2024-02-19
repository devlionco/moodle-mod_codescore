<?php

defined('MOODLE_INTERNAL') || die;

require_once("$CFG->libdir/externallib.php");
require_once("$CFG->dirroot/user/lib.php");
require_once("$CFG->dirroot/course/lib.php");


class mod_codescore_external extends external_api {
    public static function delete_attempts_parameters(): external_function_parameters
        {
            return new external_function_parameters(
                [
                    'ids' => new external_value(PARAM_RAW, ''),
                    'cmid' => new external_value(PARAM_RAW, '')
                ]
            );
        }

        /**
         * Set the questions slot parameters to display the question template.
         *
         * @param int $slotid Slot id to display.
         * @param int $newversion the version to set. 0 means 'always latest'.
         * @return array
         */
        public static function delete_attempts($ids, $cmid)
        {
            require_once(__DIR__ . '/../../config.php');
            require_once(__DIR__ . '/lib.php');

            global $USER, $DB, $PAGE, $COURSE;

            $ids = explode(",", $ids);

            foreach ($ids as &$id) {
                $DB->delete_records_select('codescore_attempts', "id=" . $id);
            }



            $params = [
                'relateduserid' => $USER->id,
                'objectid' => context_module::instance($cmid)->id,
                'context' => $modulecontext,
            ];

            $event = \mod_codescore\event\attempt_delete::create($params);
            $event->trigger();

            return ['result' => 'event dispatched'];
        }

        /**
         * Define the webservice response.
         *
         * @return external_description
         */
        public static function delete_attempts_returns()
        {
            return new external_single_structure(
                [
                    'result' => new external_value(PARAM_RAW, '')
                ]
            );
        }
}