<?php


class Action
{
    public const DRINKING   = 0;
    public const DANCING    = 1;

    public static function GetRandom() : int
    {
        $random = rand(0, 2);

        switch($random) {
            case 0:
                return Action::DRINKING;

            case 1:
                return Action::DANCING;
        }
    }

    public static function GetNameFromInt(int $input) : string
    {
        switch($input) {
            case Action::DANCING:
                return "dancing";

            case Action::DRINKING:
                return "drinking";
        }
    }
}