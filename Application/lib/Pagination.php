<?php

namespace Application\lib;

class Pagination
{
    private $max = 10;  //кол-во кнопок
    private $total;  // общее число записей
    private $index = '';
    private $limit = 10;
    private $route;
    private $current_page;
    private $amount;

    public function __construct($route, $total, $limit = 10) {
        $this->route = $route;
        $this->total = $total;
        $this->limit = $limit;

        $this->amount = $this->setAmount();
        $this->setCurrentPage();
    }

    public function getPagination() {
        $links = null;
        $limits = $this->setLimits();

        $html = '<nav><ul class="pagination">';

        for ($page=$limits[0]; $page<=$limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item active"><span class="page-link">'.$page.'</span></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }

        if (!is_null($links)) {
            if ($this->current_page > 1) {
                $links = $this->generateHtml(1, 'Вперед').$links;
            }
            if ($this->current_page < $this->amount) {
                $links .= $this->generateHtml($this->amount, 'Назад');
            }
        }
        $html .= $links.' </ul></nav>';
        return $html;
    }

    public function generateHtml($page, $text = null) {
        if (!$text) {
            $text = $page;
        }
        return '<li class="page-item"><a class="page-link" href="/'.strtolower($this->route['controller']).'/'.$this->route['action'].'/'.$page.'/#post-list">'.$text.'</a></li>';
    }

    public function setLimits() {
        $left = $this->current_page - round($this->max / 2);
        $start = $left > 0 ? $left : 1;

        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        return array($start, $end);
    }

    public function setCurrentPage() {
        if (isset($this->route['page'])) {
            $current_page = $this->route['page'];
        } else {
            $current_page = 1;
        }
        $this->current_page = $current_page;
        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount) {
                $this->current_page = $this->amount;
            }
        } else {
            $this->current_page = 1;
        }
    }

    public function setAmount() {
        return round($this->total / $this->limit);
    }
}