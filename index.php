<?php
require __DIR__ . '/bootstrap.php';

$title = 'Космическая битва';

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

$shipObjects = $shipYard->getShips();
$errorType = $_GET[Errors::ERROR_KEY] ?? null;
$errorMessage = null;

if ($errorType) {
    $errors = new Errors();
    $errorMessage = $errors->getError($errorType);
}

if ($errorMessage) { ?>
    <div>
        <?= $errorMessage; ?>
    </div>
<?php } ?>

<body>
<div class="container">
    <div class="page-header">
        <h1>Star War</h1>
    </div>
    <table class="table table-hover">
        <caption><i class="fa fa-rocket"></i> Ships are ready for a next mission</caption>
        <thead>
        <tr>
            <th>Identifier</th>
            <th>Ship</th>
            <th>Weapon Power</th>
            <th>Jedi Power</th>
            <th>Strength</th>
        </tr>
        </thead>
        <tbody>
        <?php
        /** @var Ship[] $shipObjects */
        foreach ($shipObjects as $ship): ?>
            <tr>
                <td><?= $ship->getIdentifier(); ?></td>
                <td><?php echo $ship->getName(); ?></td>
                <td><?php echo $ship->getWeaponPower(); ?></td>
                <td><?php echo $ship->getJediFactor(); ?></td>
                <td><?php echo $ship->getStrength(); ?></td>
            </tr>
        <?php endforeach;
         ?>
        </tbody>
    </table>

    <div class="battle-box center-block border">
        <div>
            <form method="POST" action="shipBattle.php">
                <h2 class="text-center">Mission</h2>
                <input class="center-block form-control text-field" type="text" name="ship1_quantity" placeholder="Enter Number of Ships" />
                <select class="center-block form-control btn drp-dwn-width btn-default dropdown-toggle" name="ship1_<?= Ship::IDENTIFIER ?>">
                    <option value="">Choose a ship</option>
                    <?php foreach ($shipObjects as $ship1): ?>
                        <option value="<?php echo $ship1->getIdentifier(); ?>"><?php echo $ship1->getName(); ?></option>
                    <?php
                    endforeach; ?>
                </select>
                <br>
                <p class="text-center">Enemy</p>
                <br>
                <input class="center-block form-control text-field" type="text" name="ship2_quantity" placeholder="Enter Number of Ships" />
                <select class="center-block form-control btn drp-dwn-width btn-default dropdown-toggle" name="ship2_<?= Ship::IDENTIFIER ?>">
                    <option value="">Choose a ship</option>
                    <?php foreach ($shipObjects as $ship2): ?>
                        <option value="<?php echo $ship2->getIdentifier(); ?>"><?php echo $ship2->getName(); ?></option>
                    <?php endforeach;

                    ?>
                </select>
                <br>
                <button class="btn btn-md btn-danger center-block" type="submit">Go attack!</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>