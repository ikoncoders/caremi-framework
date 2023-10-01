<?php declare(strict_types=1);

namespace Caremi\Numbers;

interface NumberInterface
{

    public function addNumber(mixed $num);
    public function number();
    public function addition(mixed $num = null);
    public function subtraction(mixed $num = null);
    public function division(mixed $num = null);
    public function multiplication(mixed $num = null);
    public function percentage(mixed $percentage);
    public function fraction();
}
