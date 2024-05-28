<?php
function viewMessages($result)
{
    $crudUser = new CRUD_USER();
    $list = "";

    if (!empty($result)) {

        foreach ($result as $message) {

            $msgid = $message['id'];
            $senderId = $message['fk_sender_id'];
            $selectUser = $crudUser->selectUsers("id = $senderId");
            $user = $selectUser[0];

            if (isset($_SESSION['Agency'])) {
                $url = "../messages/markread_agency.php?id={$msgid}";
                $sender = $user['firstName'] . ' ' . $user["lastName"];
                $readstatus = ($message['readmsg_agency'] == 1) ? 'unread' : 'read';
            } else {
                $url = "../messages/markread_user.php?id={$msgid}";
                $sender = $user['agency'];
                $readstatus = ($message['readmsg_user'] == 1) ? 'unread' : 'read';
            }

            $msg = $message['message'];
            $date = $message['date'];

            $list .= <<<HTML
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Sent by</h5>
                                    <p class="card-text">$sender</p>
                                    <h5 class="card-title">Message</h5>
                                    <p class="card-text">$msg</p>
                                    <div class="gap-2 d-md-flex justify-content-center">
                                        <a class="btn btn-primary" href="../messages/reply.php?id={$senderId}&msgid={$msgid}">Reply</a>
                                        <a class="btn btn-primary" href="{$url}" >Mark as $readstatus</a>
                                    </div>
                                </div>
                            </div>
                        HTML;
        }
    } else {
        $list .= "No records found";
    }
    return $list;
}
