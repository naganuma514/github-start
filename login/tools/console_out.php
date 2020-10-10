<?php
function console_log($v): void
{
    $json = json_encode($v);
    echo '<script>console.log(' . $json . ')</script>';
}
