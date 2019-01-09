<?php

class QueryDb extends Dbh{

    protected function getTheQuery($sql) {
        $sql = $sql;
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }
}