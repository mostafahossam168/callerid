<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    // backupDatabase and download sql file from database that can be exported later on

    public function backupDatabase()
    {
        $tables = DB::select('SHOW TABLES');
        $return = '';
        $name='Tables_in_'.env('DB_DATABASE');
        foreach ($tables as $table) {
            $table_name = $table->$name;
            $result = DB::select('SELECT * FROM ' . $table_name);
            $return .= 'DROP TABLE ' . $table_name . ';';
            $row2 = DB::select('SHOW CREATE TABLE ' . $table_name);
            $return .= "\n\n" . $row2[0]->{'Create Table'} . ";\n\n";
            foreach ($result as $row) {
                $return .= 'INSERT INTO ' . $table_name . ' VALUES(';
                $return .= '"' . implode('","', (array)$row) . '"' . ");\n";
            }
            $return .= "\n\n\n";
        }
        $file_name = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $path = public_path() . '/backup/' . $file_name;
        $handle = fopen($path, 'w+');
        fwrite($handle, $return);
        fclose($handle);
        return response()->download($path);
    }
}
