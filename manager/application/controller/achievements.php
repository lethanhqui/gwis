<?php


Class Achievements extends Controller
{

    public function index()
    {
		if(!$this->login->is_logged_in()){ header('Location: '.URL.'login/'); } 
		
        $achievements = $this->achievements->getAllAchievements();
        $count_achievements = $this->achievements->getCountAchievements();
		
		$staff = $this->staffs->getStaff($_SESSION['staff_id']);

        require APP . 'view/_templates/header.php';
        require APP . 'view/achievements/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function add_achievement()
    {

        if (isset($_POST["submit_add_achievement"])) {
            $this->achievements->addAchievement($_POST["name"], $_POST["sale_fee"]);
        }

        header('location: ' . URL . 'achievements/index');
    }

    public function delete_achievement($achievement_id)
    {
        if (isset($achievement_id)) {
            $this->achievements->deleteAchievement($achievement_id);
        }

        header('location: ' . URL . 'achievements/index');
    }

    public function edit_achievement($achievement_id)
    {
        if (isset($achievement_id)) {
            $achievement = $this->achievements->getAchievement($achievement_id);

            require APP . 'view/_templates/header.php';
            require APP . 'view/achievements/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {

            header('location: ' . URL . 'achievements/index');
        }
    }

    public function update_achievement()
    {

        if (isset($_POST["submit_update_achievement"])) {
            $this->achievements->updateAchievement($_POST["name"],$_POST["sale_fee"], $_POST['achievement_id']);
        }

        header('location: ' . URL . 'achievements/index');
    }

}
