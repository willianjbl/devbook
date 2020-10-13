<?php

namespace src\helpers;

class PageHelper
{
    public static function pagination(string $link, int $totalPages, int $currentPage): void
    {
        echo '<div class="feed-pagination">';
        for($i = 1; $i < $totalPages + 1; $i++) {
           echo "<a class='" . (($i == $currentPage)? 'active' : '') . "' href='$link?page=$i'>$i</a>";
        }
        echo '</div>';
    }
}
