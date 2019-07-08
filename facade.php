<?php

include_once '../developments/database.php';

class DataProcessor
{
    public function arraytotable(array $array): string
    {
        $col_names = array_keys($array[0]);
        $t = '<table border="1px">';
        $t .= '<tr>';
        foreach ($col_names as $c) {
            $t .= '<th>'.$c.'</th>';
        }
        $t .= '</tr>';
        foreach ($array as $dt) {
            $t .= '<tr>';
            foreach ($dt as $d) {
                $t .= '<td>'.$d.'</td>';
            }
            $t .= '</tr>';
        }
        $t .= '</table>';
        return $t;
    }
}

class Painter
{
   
    public static function getTable($table)
    {
        $db = Database::db();
        $data = $db
                ->table($table)
                ->select()
                ->fetch()
                ;
        $temp = new DataProcessor;
        return $temp->arraytotable($data);
    }
}

echo Painter::getTable('objects');