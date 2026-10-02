<?php

namespace App\Enums;

enum TrainingSessionCategory: string
{
    case TACTIC = 'tactic';
    case OPENING = 'opening';
    case MIDDLEGAME = 'middlegame';
    case ENDGAME = 'endgame';
    case GAMES = 'games';
    case ANALYSIS = 'analysis';


    public function label(): string
    {
        return match ($this) {
            self::TACTIC => 'Táctica',
            self::OPENING => 'Apertura',
            self::MIDDLEGAME => 'Medio juego',
            self::ENDGAME => 'Finales',
            self::GAMES => 'Partidas',
            self::ANALYSIS => 'Análisis',
        };
    }

}
