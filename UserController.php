<?php

/**
 * UserController class
 */
class UserController
{
    /**
     * returns an user
     *
     * @param int $userId
     * @return array|void
     */
    public function getUser(int $userId)
    {
        // requires dbconnection.php
        require('dbconnection.php');

        if (isset($userId)) {
            $query = mysqli_query($db_conn, "SELECT * FROM users WHERE id ='$userId'");

            if (mysqli_num_rows($query) > 0) {
                $record = mysqli_fetch_assoc($query);

                return [
                    'nickname' => $record['nickname'],
                    'mail' => $record['mail'],
                    'name' => $record['name'],
                    'surname' => $record['surname']
                ];
            } else {
                echo "Wrong id";
            }
        }
    }

    /**
     * Changes user's data
     *
     * @param array $data
     * @param int $userId
     * @return void
     */
    public function changeUserData(array $data, int $userId)
    {
        // requires dbconnection
        require('dbconnection.php');

        // get actual user's data
        $actualData = $this->getUser($userId);

        $newData = [
            'name' => empty($data['name']) ? $actualData['name'] : $data['name'],
            'surname' => empty($data['surname']) ? $actualData['surname'] : $data['surname'],
            'nickname' => empty($data['nickname']) ? $actualData['nickname'] : $data['nickname'],
            'mail' => empty($data['mail']) ? $actualData['mail'] : $data['mail'],
        ];

        $newPassword = empty($data['password']) ? null : password_hash($data['password'], PASSWORD_DEFAULT);

        if ( ! mysqli_query(
            $db_conn,
            "UPDATE users 
            SET nickname = '" . $newData['nickname'] . "', 
                mail = '" . $newData['mail'] . "',
                name = '" . $newData['name'] . "',
                surname = '" . $newData['surname'] . "' 
                WHERE id = $userId"
        )
        ) {
            echo "Error updating record: " . mysqli_error($db_conn);
        }

        if ( ! is_null($newPassword)) {
            mysqli_query(
                $db_conn,
                "UPDATE users 
                SET password = '$newPassword'
                    WHERE id ='$userId'"
            );
        }

        // redirect
        header('Location: user.php');
    }
}
