<?php
include_once("../../resources/html/header.php");
?>
<form class="home_search" target="_blank" action="https://www.startpage.com/do/dsearch?" method="get">
    <input class="home_search_box" type="text" name="query" placeholder="Startpage" />

</form>
<div class="index_chat">
    <?php# include_once("$docroot/public/view/index_chat.php"); ?>
</div>
<?php
if(isset($_SESSION['username']))
{
    include_once("../../resources/html/footer.php");
}
