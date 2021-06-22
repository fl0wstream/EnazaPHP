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

        echo 'current genre is ' . Genre::GetNameFromInt($this->_currentGenre) . PHP_EOL . PHP_EOL;

        // debug printing
        echo ' VISITORS LIST:' . PHP_EOL .
            'ID | ' .
            'age | ' .
            'genre/s | ' .
            'action | ' .
            'misses ' .
            PHP_EOL;

        foreach ($this->_visitorPool as &$item) {
            echo $item->id .
                ' | ' . $item->age .
                ' | ' . Genre::GetNamesFromArray($item->GetFavoriteGenres()) .
                ' | ' . Action::GetNameFromInt($item->GetCurrentAction()) .
                ' | ' . $item->dislikeCount .
                PHP_EOL;
        }

        // ticking every visitor thru that array
        foreach ($this->_visitorPool as $key => &$value){
            $value->tick($this->_currentGenre);

            if ($value->dislikeCount > 5) {
                // finish him
                echo '#' . $value->id . ' is gone!'. PHP_EOL;

                $value->dispose();
                unset($this->_visitorPool[$key]);

                // creating new people
                $visitor = new Visitor($key);
                $this->_visitorPool[$visitor->id] = $visitor;
            }
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

            //echo 'visitor ' . $visitor->id .
            //    ' created | age : ' . $visitor->age .
            //    ' | genres: ' . Genre::GetNamesFromArray($visitor->GetFavoriteGenres()) .
            //    '| action: ' . Action::GetNameFromInt($visitor->GetCurrentAction())
            //    . PHP_EOL;

            $i++;
        }

        echo PHP_EOL;

        return $visitorPool;
    }
}