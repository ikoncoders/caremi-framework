<?php declare(strict_types=1);

namespace Caremi\StringCollection;

interface StringCollectionInterface
{
    
    public function raw(): string;
    public function replace();
    public function trim();
    public function upper();
    public function lower();
    public function capitalize();
    public function wrap();
    public function position();
    public function length();
    public function compare();
    public function contains();
    public function specialChars();
    public function chunk();
    public function join();
    public function flower();
    public function parse();
    public function sprint();
    public function print();

}
