<?php

class OfferController {
    public function getAllOffers()
    {
        require('dbconnection.php');
        $query = mysqli_query($db_conn, "SELECT o.*, u.nickname FROM offers AS o JOIN offer_user_pivot AS of ON o.id=of.offer_id JOIN users AS u ON of.user_id=u.id");
        $offers = [];
        
        if (mysqli_num_rows($query) > 0) {
            $records = mysqli_fetch_all($query, MYSQLI_ASSOC);

            foreach($records as $record) {
                $offers[] = [
                    'id' => $record['id'],
                    'name' => $record['name'],
                    'price' => $record['price'],
                    'description' => $record['description'],
                    'creator' => $record['nickname']
                ];
            }
        }

        return $offers;
    }

    public function createOffer()
    {
        require('dbconnection.php');

        $offerName = mysqli_real_escape_string($db_conn, $_POST["name"]);
        $offerPrice = mysqli_real_escape_string($db_conn, $_POST["price"]);
        $offerDescription = mysqli_real_escape_string($db_conn, $_POST["description"]);
        $offerUser = mysqli_real_escape_string($db_conn, $_POST["userId"]);

        if (mysqli_query($db_conn, "INSERT INTO offers (name, price, description) VALUES ('$offerName', '$offerPrice', '$offerDescription')")) {
            $queryOffer = mysqli_query($db_conn, "SELECT id FROM offers WHERE name ='$offerName' order by id desc limit 1");

            $record = mysqli_fetch_assoc($queryOffer);
            $queryOfferId = $record['id'];

            mysqli_query($db_conn, "INSERT INTO offer_user_pivot (user_id, offer_id) VALUES ('$offerUser', '$queryOfferId')");

            header('Location: main.php');
        } else {
            echo "Nieoczekiwany błąd";
        }
    }

    public function deleteOffer(int $offerId) 
    {
        require('dbconnection.php');
        
        mysqli_query($db_conn, "DELETE FROM offer_user_pivot WHERE offer_id = '$offerId'");
        mysqli_query($db_conn, "DELETE FROM offers WHERE id = '$offerId'");
        
        header('Location: main.php');
    }
}