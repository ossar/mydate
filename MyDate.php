<?php
namespace  MyDate;

use Iterator;
use DateTime;
use DateInterval;

class MyDate implements Iterator
{
    protected $sdate;
    protected $edate;
    protected $current;
    protected $dv;
    protected $key;

    public function __construct(DateTime $sdate, DateTime $edate, DateInterval $dv)
    {
        $this->dv = $dv;
        $this->setPeriod($sdate, $edate);
    }

    public function setPeriod(DateTime $sdate, DateTime $edate)
    {
        $this->sdate = $sdate;
        $this->edate = $edate;
        $this->current = clone $sdate;
        $this->key = 0;
    }

    public function getList()
    {
        $buf = clone $this->sdate;
        $list = [];
        while ($buf <= $this->edate) {
            $list[] = $buf->format('Y-m-d');
            $buf->add($this->dv);
        }
        return $list;
    }

    public function getList2()
    {
        $list = [];
        foreach ($this as $key => $val) {
            $list[] = $val;
        }
        return $list;
    }

    public function current()
    {
        return $this->current->format('Y-m-d');
    }

    public function key()
    {
        return $this->key;
    }

    public function next()
    {
        $this->current->add($this->dv);
        $this->key++;
    }

    public function rewind()
    {
        $this->current = clone $this->sdate;
        $this->key = 0;
    }

    public function valid()
    {
        return $this->current <= $this->edate;
    }
}
