<?php

namespace Utils;

/**
 * Class Pagination
 * @package Utils
 */
class Pagination
{
    private $max = 10;
    private $index = 'page';
    private $current_page;
    private $total;
    private $limit;
    private $amount;
    private $filter;

    public function __construct($total, $currentPage, $limit, $filter)
    {
        $this->total = $total;
        $this->limit = $limit;
        $this->amount = $this->amount();
        $this->setCurrentPage($currentPage);
        $this->filter = $filter;
    }

    public function get()
    {
        $links = null;
        $limits = $this->limits();
        $html = '<ul class="pagination">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item active"><a class="page-link">' . $page . '</a></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        if (!is_null($links)) {
            if ($this->current_page > 1)
                $links = $this->generateHtml(1, '&lt;') . $links;
            if ($this->current_page < $this->amount)
                $links .= $this->generateHtml($this->amount, '&gt;');
        }
        $html .= $links . '</ul>';
        return $html;
    }

    private function generateHtml($page, $text = null)
    {
        if (!$text) {
            $text = $page;
        }
        $pos = strpos($_SERVER['REQUEST_URI'], '?');
        $currentURI = substr($_SERVER['REQUEST_URI'], 0, $pos);
        $currentURI .= "?" . $this->index . "=" . $page . $this->filter;
        return '<li class="page-item"><a class="page-link" href="' . $currentURI . '">' . $text . '</a></li>';
    }

    private function limits()
    {
        $left = $this->current_page - round($this->max / 2);
        $start = $left > 0 ? $left : 1;
        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        return
            array($start, $end);
    }

    private function setCurrentPage($currentPage)
    {
        $this->current_page = $currentPage;
        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount)
                $this->current_page = $this->amount;
        } else {
            $this->current_page = 1;
        }
    }

    private function amount()
    {
        return ceil($this->total / $this->limit);
    }
}