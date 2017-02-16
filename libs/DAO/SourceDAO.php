<?php

namespace Daos;

use PDO;

class SourceDAO {

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

    public function checkForSources($article_id) {
        $sourceCheckH = $this->db->prepare("
            SELECT article_sources_id
            FROM article_sources
            WHERE article_id = :article_id");
        $sourceCheckH->execute(array(':article_id' => $article_id));
        $count = $sourceCheckH->rowCount();
        if ($count > 0)
            return TRUE;
        else
            return FALSE;
    }

    //GETTERS

    public function getSources($article_id) {
        $sourceCheckH = $this->db->prepare("
            SELECT article_sources_id, article_id, display_name, link
            FROM article_sources
            WHERE article_id = :article_id");
        $sourceCheckH->execute(array(':article_id' => $article_id));
        $sourceCheckH->setFetchMode(PDO::FETCH_ASSOC);
        $data = $sourceCheckH->fetchAll();
        return $data;
    }

    //SETTERS

    public function setSource($article_id, $display_name, $link) {
        $sourceAddH = $this->db->prepare("
            INSERT INTO article_sources (article_id, display_name,link)
            VALUES (:article_id,:display_name,:link)");
        $sourceAddH->execute(array(':display_name' => $display_name, ':article_id' => $article_id, ':link' => $link));
        return $this->checkForSources($article_id);
    }

    public function removeSource($article_id, $source_id) {
        $sourceAddH = $this->db->prepare("
            DELETE FROM article_sources 
            WHERE article_id = :article_id AND articles_sources_id = :article_sources_id");
        $sourceAddH->execute(array(':article_id' => $article_id, ':article_sources_id' => $source_id));
        return $this->checkForSources($article_id);
    }

}

?>
