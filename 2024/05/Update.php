<?php

namespace Year2024\Day05;

class Update
{
    private array $pageNumbers;
    private array $rules;
    
    public function __construct(
            array $pageNumbers,
            array $rules
    ) {
        $this->pageNumbers = $pageNumbers;
        $this->setRules($rules);
    }
    
    private function setRules(array $rules): void
    {
        foreach ($rules as $rule) {
            if (in_array($rule[0], $this->pageNumbers) 
                    && in_array($rule[1], $this->pageNumbers)) {
                $this->rules[] = $rule;
            }
        }
    }
    
    public function isCorrect(): bool
    {
        foreach ($this->rules as $rule) {
            if (
                    !(array_search($rule[0], $this->pageNumbers) < 
                    array_search($rule[1], $this->pageNumbers))
            ) {
                return false;
            }
        }
        
        return true;
    }
    
    public function asString(): string
    {
        return implode(",", $this->pageNumbers);
    }

    public function middlePage(): int
    {
        return $this->pageNumbers[floor(count($this->pageNumbers)/2)];
    }
    
    public function sort(): void
    {
        usort($this->pageNumbers, function($a, $b){
            foreach ($this->rules as $rule) {
                if (($a == $rule[0]) && ($b == $rule[1])) {
                    return -1;
                }
                if (($b == $rule[0]) && ($a == $rule[1])) {
                    return 1;
                }
            }
            return 0;
        });
    }
}