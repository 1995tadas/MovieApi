<?php

namespace App\Services;

class PaginationService
{
    public function paginationForSearch($page, $total_pages): array
    {
        $pageList = [];
        $pageList['currentPage'] = $page;
        $pageList['pages'] = [];
        if ($page - 3 > 1) {
            $pageList['pages'][] = 1;
            $pageList['pages'][] = '...';
        }
        if ($total_pages > 1) {
            for ($i = $page > 4 ? $page - 2 : 1; $i <= ($total_pages > $i ? $page + 2 : $total_pages); $i++) {
                $pageList['pages'][] = $i;
            }
        }
        if ($page + 3 < $total_pages) {
            $pageList['pages'][] = '...';
            $pageList['pages'][] = $total_pages;
        }

        return $pageList;
    }
}
