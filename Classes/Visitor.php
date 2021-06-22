<?php

require_once 'Classes/Genre.php';
require_once 'Classes/Action.php';

class Visitor
{
    public int $id;
    public int $age;

    public int $dislikeCount;

    private array $_favoriteGenres;
    private int $_currentAction;
    private int $_prevAction;

    public function __construct(int $createId)
    {
        $this->id = $createId;
        $this->age = rand(18, 35);

        $this->dislikeCount = 0;

        $this->_currentAction = Action::DRINKING;

        $genresMax = rand(0, Genre::GENRES_MAX);
        $i = 0;

        $prevGenre = 0;

        while ($i <= $genresMax) {
            $currentGenre = 0;

            //if ($prevGenre != $currentGenre)
            //{
            //  $this->_favoriteGenres[$i] = Genre::GetRandom();
            //}

            while ($prevGenre == $currentGenre) {
                $currentGenre = Genre::GetRandom();

                if ($prevGenre != $currentGenre) {
                    $this->_favoriteGenres[$i] = $currentGenre;
                    $prevGenre = $currentGenre;
                    break;
                }
            }

            $i++;
        }
    }

    public function Tick(int $currentGenre)
    {
        $this->_prevAction = $this->_currentAction;

        $goodGenre = false;
        $badGenre = false;

        foreach ($this->_favoriteGenres as &$value){
            if ($value == $currentGenre) {
                $goodGenre = true;
            }
            else {
                $badGenre = true;
            }
        }

        if ($goodGenre) {
            $this->_currentAction = Action::DANCING;
        }
        else {
            $this->_currentAction = Action::DRINKING;
        }

        if ($badGenre) {
            $this->dislikeCount++;
        }

        if ($this->_currentAction != $this->_prevAction) {
            echo ' visitor #' . $this->id .
                ' goes ' . Action::GetNameFromInt($this->_currentAction) . '!' . PHP_EOL;
        }

        $goodGenre = false;
        $badGenre = false;
        //echo 'visitor #' . $this->id . ' ticked' . PHP_EOL;
    }

    public function GetFavoriteGenres() : array
    {
        return $this->_favoriteGenres;
    }

    public function GetCurrentAction() : int
    {
        return $this->_currentAction;
    }

    public function Dispose() {
        $this->id = 0;
        $this->age = 0;

        $this->dislikeCount = 0;

        $this->_currentAction = 0;
    }
}