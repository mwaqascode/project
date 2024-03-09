<?php

// print_r($_FILES);
// die;

$action = $_REQUEST['action'];
if (!empty($action)) {
    require_once 'partials/user.php';
    $obj = new User();
}

// adding user action

if ($action == 'adduser' && !empty($_POST)) {
    $pname = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $photo = $_FILES['photo'];

    // echo json_encode($photo);
    // exit;

    // pagination ka logic kaha

    $playerid = (!empty($_POST['userid']) ? $_POST['userid'] : '');
    // file (photo) upload
    $imagename = '';
    if (!empty($photo['name'])) {
        $imagename = $obj->uploadphoto($photo);
        $playerData = [
            'name' => $pname,
            'email' => $email,
            'mobile' => $mobile,
            'photo' => $imagename,
        ];
    } else {
        $playerData = [
            'name' => $pname,
            'email' => $email,
            'mobile' => $mobile,
        ];
    }
    // update 
    if ($playerid) {
        $obj->update($playerData, $playerid);
    } else {

        $playerid = $obj->add($playerData);
    }

    if (!empty($playerid)) {
        $player = $obj->getRow('id', $playerid);
        echo json_encode($player);
        exit();
    }
}

// getcountof function and getallusers action

if ($action == 'getallusers') {
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $limit = 4;
    //page=2
    //limit=4
    //start=1*4=4....4,5,6,7
    $start = ($page - 1) * $limit;
    $users = $obj->getRows($start, $limit);
    if (!empty($users)) {
        $userslist = $users;
    } else {
        $userslist = [];
    }
    $total = $obj->getcount();
    $useArr = ['count' => $total, 'users' => $userslist];

    echo json_encode($useArr);
    exit();
}

// action to perform editing

if ($action == "editusersdata") {
    $playerid = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($playerid)) {
        $user = $obj->getRow('id', $playerid);
        echo json_encode($user);
        exit();
    }
}

// perform deleting 
if ($action == 'deleteuser') {
    $userid = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($userid)) {
        $isdeleted = $obj->deleteRow($userid);
        if ($isdeleted) {
            $displaymessage = ['delete' => 1];
        } else {
            $displaymessage = ['delete' => 0];
        }
        echo json_encode($displaymessage);
        exit();
    }
}

//search data 

if ($action == 'searchuser') {
    $queryString = (!empty($_GET['searchQuery'])) ? trim($_GET['searchQuery']):'';

    $results=$obj->searchuser($queryString);
    echo json_encode($results);
    exit();
}
