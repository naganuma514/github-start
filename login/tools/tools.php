<?php

function h($s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}
