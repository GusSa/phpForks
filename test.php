<?php
/**
 * Created by PhpStorm.
 * User: gussa
 * Date: 5/20/16
 * Time: 10:56 AM
 */

require "Graph.php";

//Creation of a graph analysis program

$graph = array(
    'A' => array('B', 'F'),
    'B' => array('A', 'D', 'E'),
    'C' => array('F'),
    'D' => array('B', 'E'),
    'E' => array('B', 'D', 'F'),
    'F' => array('A', 'E', 'C'),
);

$inputPath = array();

echo "Name 5 paths you want to discover!" . PHP_EOL;
for($i = 0; $i < 10; $i++) {
    $inputPath[$i] = fgetc(STDIN);
    $dummy = fgetc(STDIN);
}

// inputPath[0] = 'SOURCE' -> inputPath[1] = 'DESTINATION'
$g = new Graph($graph);
$i = 0;
while($i < 10){
    $pid = pcntl_fork();
    if($pid == -1) {
        die('could not fork');
    } else if ($pid) {
        pcntl_wait($status);
    } else {
        $ppid = posix_getpid();
        $j = $i + 1;
        echo "I am child {$ppid} ran" ,
            $g->breadthFirstSearch($inputPath[$i],$inputPath[$j]) . PHP_EOL;
        exit;
    }
    $i = $i + 2;
}

?>