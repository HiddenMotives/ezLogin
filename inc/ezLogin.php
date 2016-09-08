<?php
require_once('config.php');
require_once('db/MysqliDb.php');

$db = new MysqliDb (Array(
    'host' => MYSQL_HOST,
    'username' => MYSQL_USER,
    'password' => MYSQL_PASS,
    'db' => MYSQL_DB,
    'port' => MYSQL_PORT));


function isRegisteredUsername($user) {
    global $db;

    $db->where ("user", strtolower($user));
    if($db->getOne ("users")) {
        return true;
    } else {
        return false;
    }

}

function isRegisteredEmail($email) {
    global $db;

    $db->where("email", strtolower($email));
    if($db->getOne ("users")) {
        return true;
    } else {
        return false;
    }
}

function getRecoveryCodeUID($code) {
    global $db;

    $recovery = $db->rawQueryOne('select * from recovery where token=? and `timestamp` >= DATE_SUB(NOW(), INTERVAL 1 DAY)', Array(strtolower($code)));
    if($recovery['token'] === $code) {
        $db->where('uid', $recovery['uid']);
        $db->delete('recovery');
        return $recovery['uid'];
    } else {
        return false;
    }
}

function generateRecoveryCode($email) {
    global $db;

    $email = strtolower($email);
    $db->where("email", $email);
    $users = $db->getOne ("users");
    if($users) {
        if($users['account_activated']) {
            $uid = $users['id'];
            $db->where("uid", $uid);
            $recovery = $db->getOne ("recovery");

            $recoveryCode = bin2hex(openssl_random_pseudo_bytes(20));
            if($recovery) {
                $data = Array(
                    'token' => $recoveryCode,
                    'timestamp' => $db->now()
                );
                $db->where('uid', $uid);
                if($db->update('recovery', $data)) {
                    return $recoveryCode;
                } else {
                    return false;
                }
            } else {
                $data = Array(
                    'uid' => $uid,
                    'token' => $recoveryCode
                );

                if($db->insert ('recovery', $data)) {
                    return $recoveryCode;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function updatePassword($uid, $newPassword) {
    global $db;

    $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT,  array('cost' => PASSWORD_COST));

    $db->where("id", $uid);
    $data = Array (
        "password" => $passwordHash
    );

    if($db->update('users', $data)) {
        return true;
    } else {
        return false;
    }

}

function doLogin($user, $password) {
    global $db;

    if(isRegisteredUsername($user)) {
        $db->where('user', strtolower($user));
        $passwordHash = $db->getOne('users', 'password');

        if (password_verify($password, $passwordHash['password'])) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function doRegister($user, $email, $password) {
    global $db;

    $username = strtolower($user);
    $emailAddress = strtolower($email);
    $passwordHash = password_hash($password, PASSWORD_BCRYPT,  array('cost' => PASSWORD_COST));
    $activation_code = bin2hex(openssl_random_pseudo_bytes(10));

    $data = Array (
        "user" => $username,
        "email" => $emailAddress,
        "password" => $passwordHash,
        "account_enabled" => USER_ENABLED,
        "account_activated" => 0,
        "activation_code" => $activation_code,
        "rank" => USER_RANK
    );

    if($db->insert ('users', $data)) {
        return true;
    } else {
        return false;
    }
}

function doActivate($code) {
    global $db;

    if((strlen($code) == 20) && ctype_alnum($code)) {
        $db->where ('activation_code', $code);
        if($db->getOne ("users")) {
            $data = Array (
                'account_activated' => 1,
                'activation_code' => NULL
            );
            $db->where ('activation_code', $code);
            if ($db->update ('users', $data)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function getUserData($user) {
    global $db;

    $db->where ("user", strtolower($user));
    return $db->getOne ("users");
}



