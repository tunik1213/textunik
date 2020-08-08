<?php
namespace App\Interfaces;

interface Votable
{
    public const DEFAULT_VALUE = 1;

    public function getVotesUp() : int;
    public function getVotesDown() : int;
    public function getUserVote() : ?int;

    public function voteUp() : void;
    public function voteDown() : void;

}
