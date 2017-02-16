</body>
<?php
$js = $this->getJS();

if (!empty($js)) {
    foreach ($js as $js) {
        echo '<script type="text/javascript" src="' . $js . '"></script>';
    }
}
?>
</html>
