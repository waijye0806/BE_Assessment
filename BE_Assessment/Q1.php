<?php

class ImagesDownloadManager {
    private $lastDownloadTime = [];  // last download time of user
    private $downloadCount = []; // how many times user has downloaded the images

    public function checkDownload($memberType) {
        $currentTime = time();
        $user = session_id(); 

        if (!isset($this->lastDownloadTime[$user])) { // if not set for last download time, set both to 0
            $this->lastDownloadTime[$user] = 0;
            $this->downloadCount[$user] = 0;
        }

        $lastTime = $this->lastDownloadTime[$user]; // retrieve the last download time
        $count = $this->downloadCount[$user]; // retrieve the total download count

        if ($memberType === 'nonmember') {
            if ($currentTime - $lastTime < 5) { // current timestamp - last download time < 5 seconds
                echo "Too many downloads";
                exit;
            }
        } elseif ($memberType === 'member') {
            if ($count >= 2 && $currentTime - $lastTime < 5) { // if total download count equal or greater than 2 and current timestamp - last download time < 5 seconds
                echo "Too many downloads";
                exit;
            }
        }

        $this->lastDownloadTime[$user] = $currentTime; // update last download time with current timestamp
        $this->downloadCount[$user] = ($count + 1) % 3; 

        return "Your download is starting...\nDownload completed.";
    }
}

session_start();
$downloadManager = new ImagesDownloadManager(); // instance of ImagesDownloadManager class

echo "Enter your role (member/nonmember): ";
$handle = fopen ("php://stdin","r"); // read user input
$role =strtolower(trim(fgets($handle))); // convert to lowercase and trim space

if ($role === 'member' || $role === 'nonmember') {
    echo $downloadManager->checkDownload($role) . "\n";
    sleep(3); // wait 3 sec between everytime download
    echo $downloadManager->checkDownload($role) . "\n";
    sleep(3);
    echo $downloadManager->checkDownload($role) . "\n";
} else {
    echo "Invalid role entered.";
}
