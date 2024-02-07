<?php
/**
 * Structure step to restore one codescore activity
 */
class restore_codescore_activity_structure_step extends restore_activity_structure_step {

    protected function define_structure() {

        $paths = array();
        $userinfo = $this->get_setting_value('userinfo');

        $paths[] = new restore_path_element('codescore', '/activity/codescore');
        if ($userinfo) {
            $paths[] = new restore_path_element('codescore_attempt', '/activity/codescore/attempts/attempt');
        }

        // Return the paths wrapped into standard activity structure
        return $this->prepare_activity_structure($paths);
    }

    protected function process_codescore($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();

        // insert the codescore record
        $newitemid = $DB->insert_record('codescore', $data);
        // immediately after inserting "activity" record, call this
        $this->apply_activity_instance($newitemid);
    }

    protected function process_codescore_attempt($data) {
        global $DB;

        $data = (object)$data;

        $data->codescoreid = $this->get_new_parentid('codescore');
        $data->userid = $this->get_mappingid('user', $data->userid);

        $newitemid = $DB->insert_record('codescore_attempts', $data);
        // No need to save this mapping as far as nothing depend on it
        // (child paths, file areas nor links decoder)
    }

    protected function after_execute() {
        // Add codescore related files, no need to match by itemname (just internally handled context)
        $this->add_related_files('mod_codescore', 'intro', null);
    }
}