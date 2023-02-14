<?php


class Deck
{
    public string $deck_id;
    public int $remaining;

    public function __construct()
    {
        $result = self::GetDeck();
        $this->deck_id=$result['deck_id'];
        $this->remaining=$result['remaining'];
    }

    public static function ShowCard(array $card)
    {
        $image = $card['image'];
        $alt = $card['value']." of ".$card['suit'];
        echo ("<image src='$image' alt ='$alt'>");
    }

    public static function DrawCard(Deck $deck)
    {
        $data['count'] = 1;
        $deck_id = $deck->deck_id;
        $result = self::curl_get("https://deckofcardsapi.com/api/deck/".$deck_id."/draw/",$data);
        $result = json_decode($result,true);
        return $result;
    }

    static function GetDeck()
    {
        $data['deck_count']=1;
        $result = self::curl_get("https://deckofcardsapi.com/api/deck/new/shuffle/",$data);
        $result=json_decode($result,true);
        return $result;
    }

    static function curl_get($url, array $get = NULL, array $options = array())
    {

        $defaults = array(

            CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($get),

            CURLOPT_HEADER => 0,

            CURLOPT_RETURNTRANSFER => TRUE,

            CURLOPT_TIMEOUT => 4

        );



        $ch = curl_init();

        curl_setopt_array($ch, ($options + $defaults));

        if( ! $result = curl_exec($ch))

        {

            trigger_error(curl_error($ch));

        }

        curl_close($ch);

        return $result;
    }
}