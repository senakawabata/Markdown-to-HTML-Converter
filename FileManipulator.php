<?php

function reverse($inputPath, $outputPath) {
    $contents = file_get_contents($inputPath);
    $reversedContents = strrev($contents);
    file_put_contents($outputPath, $reversedContents);
}

function copyFile($inputPath, $outputPath) {
    if(!copy($inputPath, $outputPath)) {
        echo "コピーに失敗しました\n";
    }
}

function duplicateContents($inputPath, $n) {
    $contents = file_get_contents($inputPath);
    $duplicateContents = str_repeat($contents, $n);
    file_put_contents($inputPath, $duplicateContents);
}

function replaceString($inputPath, $needle, $newString) {
    $contents = file_get_contents($inputPath);
    $replaceString = str_replace($needle, $newString, $contents);
    file_put_contents($inputPath, $replaceString);
}

if ($argc < 2) {
    echo "使い方：php FileManipulator.php <command> [args...]\n";
    exit(1);
}

$command = $argv[1];

switch ($command) {
    case 'reverse':
        if ($argc != 4) {
            echo "使い方：php FileManipulator.php reverse <inputpath> <outputpath>\n";
            exit(1);
        }
        reverse($argv[2], $argv[3]);
        break;
    
    case 'copy':
        if ($argc != 4) {
            echo "使い方：php FileManipulator.php copy <inputpath> <outputpath>\n";
            exit(1);
        }
        copy ($argv[2], $argv[3]);
        break;
        
    case 'duplicate-contents':
        if ($argc != 4 || !is_numeric(($argv[3]))) {
            echo "使い方：php FileManipulator.php duplicate-contents <inputpath> <n>\n";
            exit(1);
        }
        duplicateContents($argv[2], (int)$argv[3]);
        break;
        
    case 'replace-string':
        if ($argc != 5) {
            echo "使い方：php FileManipulator.php replace-string <inputpath> <needle> <newstring>\n";
            exit(1);
        }
        replaceString($argv[2], $argv[3], $argv[4]);
        break;
        
    default;
        echo "$command のようなコマンドはありません\n";
        echo "利用可能コマンド： reverse, copy, duplicate-contents, replace-string\n";
        exit(1);    
}

echo "コマンド '$command' が正常に実行されました\n";

?>