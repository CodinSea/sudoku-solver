<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SudokuController extends Controller
{
    public function display() {
        for ($row = 0; $row < 9; $row++) {           
            for ($col = 0; $col < 9; $col++) {
                $board[$row][$col] = null;
            }
        }

        return view('sudoku')->with('board', $board);
    }

    public function submit(Request $request) {
        $val = $request->validate([
            'num.*.*' => 'numeric|integer|between:1,9|nullable'
        ]);

        $board = $request->num;
        $solution = $board;
        $error = "";
        $valid = true;

        for ($row = 0; $row < sizeof($board); $row++) {           
            for ($col = 0; $col < sizeof($board[0]); $col++) {
                if ($board[$row][$col] != null) {
                    $position =  array('row' => $row, 'col' => $col);
                    $valid = $this->valid($board, $board[$row][$col], $position);
                    if (!$valid) {
                        $error = "Invalid entry!";
                        break 2;
                    }         
                }
            }
        }              

        if ($valid) {
            while ($this->findEmptyCell($solution)) {
                $solution = $this->solve($solution);
                if (!$solution) {
                    $error = "Invalid board!";
                    break;
                }
            }

            return view('sudoku')->with('board', $board)->with('solution', $solution)->with('error', $error);            
        } else {
            return view('sudoku')->with('board', $board)->with('error', $error);
        }

    }

    public function solve($board) {
        $find = $this->findEmptyCell($board);

        if (!$find) {
            return $board;
        } 

        for ($i = 1; $i < 10; $i++) {                       
            if ($this->valid($board, $i, $find)) {
                $board[$find['row']][$find['col']] = strval($i);
                if ($this->solve($board)) {
                    return $board;
                }
                $board[$find['row']][$find['col']] = null;                
            } 
        }
        return false;
        
    } 

    private function findEmptyCell($array) {
        for ($row = 0; $row < sizeof($array); $row++) {           
            for ($col = 0; $col < sizeof($array[0]); $col++) {
                if ($array[$row][$col] == null) {
                    $position =  array('row' => $row, 'col' => $col);
                    return $position;         
                }
            }
        }       
    }

    private function valid($array, $num, $pos) {
        // Check row
        for ($col = 0; $col < sizeof($array[0]); $col++) {
            if ($array[$pos['row']][$col] == $num && $col != $pos['col']) {
                return false;
            }
        }

        // Check column
        for ($row = 0; $row < sizeof($array); $row++) {
            if ($array[$row][$pos['col']] == $num && $row != $pos['row']) {
                return false;
            }
        }

        // Check box
        // Box coordinates
        $box_x = intdiv($pos['col'], 3);
        $box_y = intdiv($pos['row'], 3);

        for ($i = $box_y * 3; $i < $box_y * 3 + 3; $i++) {
            for ($j = $box_x * 3; $j < $box_x * 3 + 3; $j++) {
                if ($array[$i][$j] == $num && ($i != $pos['row'] || $j != $pos['col'])) {
                return false;
                }
            }        
        }

        return true;
    }    
}