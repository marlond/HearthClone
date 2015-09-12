<?php namespace App\Game\Cards\Heroes;

use App\Exceptions\InvalidTargetException;
use App\Game\Cards\Minion;
use App\Game\Player;

/**
 * Created by PhpStorm.
 * User: Kegimaro
 * Date: 8/30/15
 * Time: 3:36 PM
 */
class Mage extends AbstractHero
{
    protected $hero_damage = 1;
    protected $name        = "Jaina Proudmoore";

    public function __construct(Player $player) {
        parent::__construct($player);
        $this->hero_class = HeroClass::$MAGE;
        $this->hero_power = HeroPower::$MAGE;
    }

    /**
     * Use the heroes ability
     *
     * @param Player $active_player
     * @param Player $defending_player
     * @param Minion[] $targets
     * @throws InvalidTargetException
     */
    function useAbility(Player $active_player, Player $defending_player, array $targets) {
        if (count($targets) != 1) {
            throw new InvalidTargetException('Must select one target');
        }

        /** @var Minion $target */
        $target = current($targets);
        $target->takeDamage($this->hero_damage);
    }
}