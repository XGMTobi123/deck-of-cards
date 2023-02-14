<?php
require "..\core\Deck.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Random Deck</title>
</head>
<body>
<?php
$deck = new Deck();
for ($i=$deck->remaining;$i>0;$i--){
    Deck::ShowCard(Deck::DrawCard($deck)['cards'][0]);
}
?>
</body>
</html>