<?php
/**
 * Created by PhpStorm.
 * User: Kegimaro
 * Date: 9/19/15
 * Time: 11:50 AM
 */

namespace tests;


use App\Models\HearthCloneTest;

class BasicMiscMinionTest extends HearthCloneTest
{
    /* Gurubashi Berserker */
    public function test_gurubashi_berserker_gains_3_attack_when_damaged() {
        $gurubashi_berserker = $this->playCard('Gurubashi Berserker', 1);
        $gurubashi_berserker->takeDamage(1);
        $this->assertEquals(5, $gurubashi_berserker->getAttack());
        $gurubashi_berserker->takeDamage(1);
        $this->assertEquals(8, $gurubashi_berserker->getAttack());
    }

    /* Healing Totem */
    public function test_healing_totem_heals_damaged_minion_when_pass_turn() {
        $chillwind_yet = $this->playCard('Chillwind Yeti', 1);
        $this->playCard('Healing Totem', 1, [], true);
        $chillwind_yet->takeDamage(2);
        $this->assertEquals(3, $chillwind_yet->getHealth());
        $chillwind_yet->getOwner()->passTurn();
        $this->assertEquals(4, $chillwind_yet->getHealth());
    }

    /* Northshire Cleric */
    public function test_northshire_cleric_will_draw_card_when_damaged_minion_is_healed() {
        $this->playCard('Northshire Cleric', 1);
        $chillwind_yeti = $this->playCard('Chillwind Yeti', 1);
        $chillwind_yeti->takeDamage(3);
        $this->assertEquals(0, $this->game->getPlayer1()->getHandSize());
        $chillwind_yeti->heal(2);
        $this->assertEquals(1, $this->game->getPlayer1()->getHandSize());
    }

    public function test_northshire_cleric_will_not_draw_card_when_minion_healed_is_at_full_health() {
        $this->playCard('Northshire Cleric', 1);
        $chillwind_yeti = $this->playCard('Chillwind Yeti', 1);
        $this->assertEquals(0, $this->game->getPlayer1()->getHandSize());
        $chillwind_yeti->heal(2);
        $this->assertEquals(0, $this->game->getPlayer1()->getHandSize());
    }

    /* Starving Buzzard */
    public function test_starving_buzzard_draws_card_when_beast_is_played() {
        $this->playCard('Starving Buzzard', 1);
        $this->assertEquals(0, $this->game->getPlayer1()->getHandSize());
        $this->playCard('Timber Wolf', 1);
        $this->assertEquals(1, $this->game->getPlayer1()->getHandSize());
    }

    public function test_starving_buzzard_does_not_draw_card_when_non_beast_is_played() {
        $this->playCard('Starving Buzzard', 1);
        $this->assertEquals(0, $this->game->getPlayer1()->getHandSize());
        $this->playCard('Wisp', 1);
        $this->assertEquals(0, $this->game->getPlayer1()->getHandSize());
    }
}