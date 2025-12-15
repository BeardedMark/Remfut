<?php

namespace App\Domains\Battles\Services;

use App\Domains\Enemies\Instances\EnemyInstance;
use App\Domains\Characters\Models\Character;

class TurnCombatService
{
    public static function stepFightVsBot(Character $character, EnemyInstance $enemy, array $state, string $action, string $stance, string $target): array
    {
        $charHealth = $state['char_health'] ?? $character->getCurrentHealth();
        $enemyHealth = $state['enemy_health'] ?? $enemy->getHealth();

        $enemyStance = rand(0, 1) ? 'attack' : 'defence';

        if ($action === 'escape') {
            $chance = 50;
            $chance += $enemyStance === 'defence' ? 20 : -20;
            return [
                'char_health' => $charHealth,
                'enemy_health' => $enemyHealth,
                'enemy_stance' => $enemyStance,
                'escaped' => rand(1, 100) <= $chance,
            ];
        }

        $damageMultiplier = match ($target) {
            'head' => 1.5,
            'legs' => 0.75,
            default => 1.0,
        };

        $charAttack = $character->getDamage() * $damageMultiplier;
        $enemyAttack = $enemy->getDamage();

        if ($stance === 'attack') {
            $charAttack *= 1.1;
        } else {
            $enemyAttack *= 0.9;
        }

        if ($enemyStance === 'defence') {
            $charAttack *= 0.9;
        }

        $enemyHealth -= round($charAttack);

        if ($enemyHealth > 0 && $enemyStance === 'attack') {
            $charHealth -= round($enemyAttack);
        }

        return [
            'char_health' => max($charHealth, 0),
            'enemy_health' => max($enemyHealth, 0),
            'enemy_stance' => $enemyStance,
            'escaped' => false,
        ];
    }
}
