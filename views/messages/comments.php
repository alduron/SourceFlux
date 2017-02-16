
<?php

function formatArray($array, $type = 0) {
    foreach ($array as $parent) {
        if ($parent['CHILDREN'] == NULL) {
            $type = 1;
            $typeString = 'child';
        } else {
            $typeString = 'parent';
        }

        $return .= '<p>';
        $return .= '<div class="comment-container comment-' . $typeString . '">';
        $return .= '<div class="comment-author" id="' . $parent['DATA']->getAuthorID() . '">' . $parent['DATA']->getAuthorID() . '</div>';
        $return .= '<div class = "comment-content">' . $parent['DATA']->getContent() . '</div>';
        $return .= '<div class="comment-controller">';
        $return .= '<i class="icon-user"></i> ' . $parent['DATA']->getUsername() . ' | <i class="icon-time"></i> ' . $parent['DATA']->getDate() . ' | <a class="comment-reply" article_id="' . $parent['DATA']->getArticleID() . '" parent="' . $parent['DATA']->getParent() . '" comment_id="' . $parent['DATA']->getCommentMessageID() . '" action="' . URL . 'comment/xhrGetReplyForm" href="#">Reply</a>';
        $return .= '</div>';
        $return .= '<div class="comment-results" id="comment-results-' . $parent['DATA']->getCommentMessageID() . '"></div>';
        $return .= '<div class="comment-children">';


        if ($parent['CHILDREN'] != NULL) {
            foreach ($parent['CHILDREN'] as $childArray) {
                formatArray($childArray, $type);
            }
        }

        $return .='</div>';
        $return .='</div>';
        $return .= '</p>';
    }
    return $return;
}

$html = '';

if (!empty($this->commentObjectArray)) {
    foreach ($this->commentObjectArray as $comment) {
        $html = formatArray($comment);
    }
} else {
    echo 'There are no comments!';
}
?>