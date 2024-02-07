<?php 

require_once($CFG->dirroot . '/mod/codescore/backup/moodle2/backup_codescore_stepslib.php');
class backup_codescore_activity_task extends backup_activity_task {
     /**
     * No specific settings for this activity
     */
    protected function define_my_settings() {
    }

    /**
     * Defines backup steps to store the instance data and required questions
     */
    protected function define_my_steps() {
        $this->add_step(new backup_codescore_activity_structure_step('codescore_structure', 'codescore.xml'));  
    }

    /**
     * Encodes URLs to the index.php and view.php scripts
     *
     * @param string $content some HTML text that eventually contains URLs to the activity instance scripts
     * @return string the content with the URLs encoded
     */
    public static function encode_content_links($content) {
        return $content;
    }

}