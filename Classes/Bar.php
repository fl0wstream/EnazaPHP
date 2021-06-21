<?php

require_once "Classes/Genre.php";
require_once "Classes/Visitor.php";

class Bar
{
    public string $name;
    public string $maxVisitors;

    private int $_currentGenre;
    private array $_visitorPool;

    public function __construct($inputName, $maxVisitors)
    {
        $this->name = $inputName;
        $this->maxVisitors = $maxVisitors;

        $this->_currentGenre = Genre::GetRandom();

        $this->_visitorPool = $this->makeVisitorPool($maxVisitors);
    }

    public function tick()
    {
        // new genre every tick
        $this->_currentGenre = Genre::GetRandom();

        echo 'current genre is ' . Genre::GetNameFromInt($this->_currentGenre) . PHP_EOL;

        // ticking every visitor thru that array
        foreach ($this->_visitorPool as &$value){
            $value->tick($this->_currentGenre);
        }
    }

    public function dispose()
    {
        // TODO: Implement dispose() method.
    }

    private function makeVisitorPool($visitorsCount)
    {
        $i = 0;

        while ($i <= $visitorsCount)
        {
            $visitor = new Visitor($i);
            $visitorPool[$visitor->id] = $visitor;

            echo 'visitor ' . $visitor->id .
                ' created | age : ' . $visitor->age .
                ' | genres: ' . Genre::GetNamesFromArray($visitor->GetFavoriteGenres()) .
                '| action: ' . Action::GetNameFromInt($visitor->GetCurrentAction())
                . PHP_EOL;

            $i++;
        }

        echo PHP_EOL;

        return $visitorPool;
    }
}