<?php


class Genre
{
    public const ROCK       = 0;
    public const ELECTRONIC = 1;
    public const BLUES      = 2;
    public const RAP        = 3;

    public const GENRES_MAX = 3;

    public static function GetRandom() : int
    {
        $random = rand(0, self::GENRES_MAX);

        switch($random) {
            case 0:
                return Genre::ROCK;

            case 1:
                return Genre::ELECTRONIC;

            case 2:
                return Genre::BLUES;

            case 3:
                return Genre::RAP;
        }
    }

    public static function GetNamesFromArray(array $input) : string
    {
        $output = '';

        foreach ($input as &$value)
        {
            //if ($value != $input[count($input)]) {
            //    $output = $output . ", ";
            //}

            switch ($value) {
                case Genre::ROCK:
                    $output = $output . "rock" . " ";

                case Genre::ELECTRONIC:
                    $output = $output . "electronic" . " ";

                case Genre::BLUES:
                    $output = $output . "blues" . " ";

                case Genre::RAP:
                    $output = $output . "rap" . " ";
            }
        }

        return $output;
    }

    public static function GetNameFromInt(int $value) {
        switch ($value) {
            case Genre::ROCK:
                return "rock";

            case Genre::ELECTRONIC:
                return "electronic";

            case Genre::BLUES:
                return "blues";

            case Genre::RAP:
                return "rap";
        }
    }
}