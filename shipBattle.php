<?php
$title = 'Космическая битва2';

require __DIR__ . '/bootstrap.php';

$shipYard = new Shipyard([
    'starfighter' => [
        'name' => 'Jedi Starfighter',
        'weapon_power' => 5,
        'jedi_factor' => 15,
        'strength' => 30,
    ],
    'cloakshape_fighter' => [
        'name' => 'CloakShape Fighter',
        'weapon_power' => 2,
        'jedi_factor' => 2,
        'strength' => 70,
    ],
    'super_star_destroyer' => [
        'name' => 'Super Star Destroyer',
        'weapon_power' => 70,
        'jedi_factor' => 0,
        'strength' => 500,
    ],
    'rz1_a_wing_interceptor' => [
        'name' => 'RZ-1 A-wing interceptor',
        'weapon_power' => 4,
        'jedi_factor' => 4,
        'strength' => 50,
    ],
]);
$ships = $shipYard->getShips();
$ship1Identifier = $_POST['ship1_' . Ship::IDENTIFIER] ?? null;
$ship1Quantity = $_POST['ship1_quantity'] ?? 1;
$ship2Identifier = $_POST['ship2_' . Ship::IDENTIFIER] ?? null;
$ship2Quantity = $_POST['ship2_quantity'] ?? 1;

if (!$ship1Identifier || !$ship2Identifier) {
    header('Location: /Projects/Hillel/Lesson1/index.php?' . Errors::ERROR_KEY . '=' . Errors::MISSING_DATA_TYPE);
    die;
}

if (!isset($ships[$ship1Identifier], $ships[$ship2Identifier])) {
    header('Location: /Projects/Hillel/Lesson1/index.php?' . Errors::ERROR_KEY . '=' . Errors::BAD_SHIPS_TYPE);
    die;
}

if ($ship1Quantity <= 0 || $ship2Quantity <= 0) {
    header('Location: /Projects/Hillel/Lesson1/index.php?' . Errors::ERROR_KEY . '=' . Errors::BAD_QUANTITIES_TYPE);
    die;
}

$ship1 = $ships[$ship1Identifier];
$ship2 = $ships[$ship2Identifier];
$battleManager = new BattleManager();
$battleResult = $battleManager->battle($ship1, $ship1Quantity, $ship2, $ship2Quantity);
$statCenter = new StatCenter(new SessionManager());
$statCenter->addFightStats($battleResult);
?>

<body>
<div class="container">
    <div class="page-header">
        <h1>Star war</h1>
    </div>
    <div>
        <h2 class="text-center">Collision:</h2>
        <p class="text-center">
            <br>
            <?php
                echo $ship1Quantity;
                echo $ship1->getName();
                echo $ship1Quantity > 1 ? 's' : '';
            ?>
            VS.
            <?php
                echo $ship2Quantity;
                echo $ship2->getName();
                echo $ship2Quantity > 1 ? 's' : '';
            ?>
        </p>
    </div>
    <div class="result-box center-block">
        <h3 class="text-center audiowide">
            Winner:
            <?php
            if ($battleResult->isHereAWinner()): ?>
                <?php
                echo $battleResult->getBattleShip()->getName(); ?>
            <?php
            else: ?>
                Equal
            <?php
            endif; ?>
        </h3>
        <p class="text-center">
            <?php
            if (!$battleResult->isHereAWinner()): ?>
                The Ships destroyed each other in the epic battle!
            <?php
            else: ?>

                The <?php
                echo $battleResult->getBattleShip()->getName(); ?>
                <?php
                if ($battleResult->isUsedJediPower()): ?>
                    used Jedi Power for the stunning win!
                <?php
                else: ?>
                    won and destroyed  <?php
                    echo $battleResult->getBattleShip(false)->getName() ?>
                <?php
                endif; ?>
            <?php
            endif;?>
            <br>
        </p>
        <?php if($static = $statCenter->getFightStats()): ?>
         <div class="statistic">
            <h3 class="text-center audiowide">Fight statistics</h3>
            <h2 style="text-align: center">All battles: <?= $statCenter->countBattles() ?></h2>
            <table>
                <tr>
                    <th>Battle #</th>
                    <th>Winner</th>
                    <th>Looser</th>
                    <th>Jedi Power</th>
                </tr>
                <?php /** @var BattleResult $statItem */ ?>
                <?php foreach ($static as $key => $statItem): ?>
                <?php if ($statItem): ?>
                <?php
                    $statItemJedi = $statItem->isUsedJediPower();
                    $statItemData = $statItem->getStatistic();
                ?>
                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $statItem->getBattleShip()->getName() ?>
                        (qty:<?= $statItemData[\BattleResult::WINNER_KEY][\BattleResult::QTY_KEY] ?? null ?>,
                        health: <?= $statItemData[\BattleResult::WINNER_KEY][\BattleResult::START_HEALTH_KEY] ?? null?>,
                        remain health: <?= $statItemData[\BattleResult::WINNER_KEY][\BattleResult::REMAIN_HEALTH_KEY] ?? null ?>)
                    </td>
                    <td><?= $statItem->getBattleShip(false)->getName() ?>
                        (qty:<?= $statItemData[\BattleResult::LOOSER_KEY][\BattleResult::QTY_KEY] ?? null ?>,
                        health: <?= $statItemData[\BattleResult::LOOSER_KEY][\BattleResult::START_HEALTH_KEY] ?? null ?>,
                        remain health: <?= $statItemData[\BattleResult::LOOSER_KEY][\BattleResult::REMAIN_HEALTH_KEY] ?? null  ?>)
                    </td>
                    <td><?php if ($statItem->isUsedJediPower()): ?> <p>&#10004</p> <?php endif; ?></td>
                </tr>
                <?php endIf; ?>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <a href="index.php"><p class="text-center"><i class="fa fa-undo"></i> New battle</p></a>
<!--     jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--     Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</div>

<style>
    .container, table, th, td {
        border: 1px solid black;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }

    .statistic {
        border-top: 1px solid blue; /* Линия сверху текста */
        border-bottom: 1px solid blue; /* Линия снизу текста */
        padding: 5px; /* Поля вокруг текста */
    }
</style>

</body>
</html>
