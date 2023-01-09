<?php

/**
 * OfferController's class
 */
class OfferController {
    /**
     * returns array of all offers
     *
     * @return array
     */
    public function getAllOffers(): array
    {
        // requires dbconnection.php
        require('dbconnection.php');
        // creates a db query
        $query = mysqli_query(
            $db_conn,
            "SELECT o.*, u.nickname FROM offers AS o JOIN offer_user_pivot AS of ON o.id=of.offer_id JOIN users AS u ON of.user_id=u.id"
        );
        // an array for offer5s
        $offers = [];

        if (mysqli_num_rows($query) > 0) {
            $records = mysqli_fetch_all($query, MYSQLI_ASSOC);

            foreach ($records as $record) {
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

    /**
     * creates an offer
     *
     * @return void
     */
    public function createOffer()
    {
        // requires dbconnection.php
        require('dbconnection.php');

        /**
         * Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
         */
        $offerName = mysqli_real_escape_string($db_conn, $_POST["name"]);
        $offerPrice = mysqli_real_escape_string($db_conn, $_POST["price"]);
        $offerDescription = mysqli_real_escape_string($db_conn, $_POST["description"]);
        $offerUser = mysqli_real_escape_string($db_conn, $_POST["userId"]);

        if (mysqli_query(
            $db_conn,
            "INSERT INTO offers (name, price, description) VALUES ('$offerName', '$offerPrice', '$offerDescription')"
        )) {
            $queryOffer = mysqli_query(
                $db_conn,
                "SELECT id FROM offers WHERE name ='$offerName' order by id desc limit 1"
            );

            $record = mysqli_fetch_assoc($queryOffer);
            $queryOfferId = $record['id'];

            // also creates a record in pivot table
            mysqli_query(
                $db_conn,
                "INSERT INTO offer_user_pivot (user_id, offer_id) VALUES ('$offerUser', '$queryOfferId')"
            );

            // redirect to main.php
            header('Location: main.php');
        } else {
            echo "Unexpected error";
        }
    }

    /**
     * deletes an offer
     *
     * @param int $offerId
     * @return void
     */
    public function deleteOffer(int $offerId)
    {
        // requires dbconnection.php
        require('dbconnection.php');

        // deletes the offer from offers table and pivot table
        mysqli_query($db_conn, "DELETE FROM offer_user_pivot WHERE offer_id = '$offerId'");
        mysqli_query($db_conn, "DELETE FROM offers WHERE id = '$offerId'");

        // redirect
        header('Location: main.php');
    }
}
