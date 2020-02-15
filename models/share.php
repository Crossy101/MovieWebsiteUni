<?php
class ShareModel extends Model {
    public function Index()
    {
        $this->CreateQuery('SELECT * FROM shares');
        $rows = $this->ResultSet();
        return $rows;
    }
}