<?php

function anagram($word) {
    $dictionnary = get_dictionnary();

    for ($i = 0; $i < count($dictionnary); $i++) {
        if (strlen($word) == strlen($dictionnary[$i])) {
            if (is_anagram($word, $dictionnary[$i])) {
                echo $dictionnary[$i] . "\n";
            }
        }
    }
}

function get_dictionnary() {
    $i = 0;
    $file = fopen("anagram-master-dictionnaire.txt", "r");
    $line = fgets($file);

    while ($line != false) {
        $line = trim($line);
        $dictionnary[$i] = $line;
        $line = fgets($file);
        $i++;
    }

    fclose($file);
    return $dictionnary;
}

function is_anagram($word, $compare) {
    if ($word == $compare) {
        return false;
    }
    
    if (sort_word($word) == sort_word($compare)) {
        return true;
    }
}

function sort_word($word) {
    for ($i = 0; $i < strlen($word); $i++) {
        for ($j = 0; $j < strlen($word)-1; $j++) {
            if ($word[$j] > $word[$j+1]) {
                $temp = $word[$j+1];
                $word[$j+1] = $word[$j];
                $word[$j] = $temp;
            }
        }
    }

    return $word;
}

if (isset($argv[1])) {
    anagram($argv[1]);
}

?>