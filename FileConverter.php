<?php

require 'vendor/autoload.php';

if ($argc != 4) {
    echo "Usage: php FileConverter.php markdown inputfile outputfile\n";
    exit(1);
}

$command = $argv[1];
$inputFile = $argv[2];
$outputFile = $argv[3];

if ($command !== 'markdown') {
    echo "不明なコマンド: $command\n";
    exit(1);
}

if (!file_exists($inputFile)) {
    echo "入力ファイルが存在しません: $inputFile\n";
    exit(1);
}

$markdownContent = file_get_contents($inputFile);
$parsedown = new Parsedown();
$htmlContent = $parsedown->text($markdownContent);

file_put_contents($outputFile, $htmlContent);

echo "変換完了！HTMLファイルが作成されました。: $outputFile\n";