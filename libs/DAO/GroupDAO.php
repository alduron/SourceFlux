<?php

namespace Daos;

use PDO;

class GroupDAO {

    //REQUIRED
    public function __construct($data) {
        if (is_array($data)) {
            $this->db = $data['db'];
        } else {
            $this->db = $data;
        }
    }

    //FUNCTIONAL
    //CHECKS
    //GETTERS

    public function getGroupList() {
        $groupListH = $this->db->prepare("
            SELECT feed_group_id,name
            FROM feed_groups 
            ORDER BY name");
        $groupListH->execute();
        $groupListH->setFetchMode(PDO::FETCH_ASSOC);
        $groupListArray = $groupListH->fetchAll();
        return $groupListArray;
    }

    public function getGroupTagsByID($group_id) {
        $groupTagsH = $this->db->prepare("
            SELECT feed_group_tags.tag_id
            FROM feed_group_tags RIGHT JOIN feed_groups ON feed_groups.feed_group_id = feed_group_tags.feed_group_id
            WHERE feed_groups.feed_group_id = :feed_group_id");
        $groupTagsH->execute(array(':feed_group_id'=>$group_id));
        $groupTagsH->setFetchMode(PDO::FETCH_ASSOC);
        $groupTagArray = $groupTagsH->fetchAll();
        return $groupTagArray;
    }

    //SETTERS
}

?>
