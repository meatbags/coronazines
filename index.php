<?php include_once('inc/module-zine-handler.php'); ?>
<?php $zines = ZineHandler::listPublicZines(); ?>
<?php include('header.php'); ?>
<?php include('nav.php'); ?>

<div class='loading-screen'></div>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <!-- HOME -->
    <div id='view-home' class='view'>
      <div class='zine-list'>
        <?php foreach ($zines as $zine):
          // first page
          $ref = strip_tags($zine['zine_ref']);
          $title = htmlspecialchars($zine['zine_title']);
          $pages = explode(';', $zine['zine_content']);
          $p1 = strip_tags($pages[0]);
          $p2 = count($pages) > 0 ? strip_tags($pages[1]) : NULL;
          ?>
          <div class='item' data-zine='<?php echo $ref; ?>'>
            <div class='item__inner'>
              <div class='item__background'>
                <?php echo !empty($p1) ? "<img src='" . $p1 . "'>" : "<div class='placeholder'></div>"; ?>
                <?php echo !empty($p2) ? "<img src='" . $p2 . "'>" : "<div class='placeholder'></div>"; ?>
              </div>
              <div class='item__title'>
                <div class='text'>
                  <?php echo $title; ?>
                  <div class='underline'></div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- VIEWER -->
    <div id='view-viewer' class='view'>
      <div id='zine-target' class='viewer'></div>
    </div>

    <!-- ZINE CREATOR -->
    <div id='view-create' class='view active'>
      <div class='view__side-bar'>
        <div class='row'>
          <label>Zine Title</label>
          <input name='title'>
        </div>
        <div class='row'>
          <label>Author</label>
        </div>
        <div class='row'>
          <label></label>
        </div>
        <div class='pages'>

        </div>
        <div class=''></div>
      </div>
      <div class='view__workspace'>
        <div class='viewer'></div>
      </div>
    </div>

    <!-- LOG IN -->
    <div id='view-login' class='view'>
      <div class='view__login'>
        <div class='view__login-pane'>
          LOG IN
          <form action='inc/action-login.php' method='POST'>
            <div class='row'><label>Username</label><input type='text' name='name'></div>
            <div class='row'><label>Password</label><input type='password' name='password'></div>
            <input type='submit' value='LOG IN'>
          </form>
        </div>
        <div class='view__login-pane'>
          REGISTER
          <form action='inc/action-register.php' method='POST'>
            <div class='row'><label>Username</label><input type='text' name='name'></div>
            <div class='row'><label>Password</label><input type='password' name='password'></div>
            <div class='row'><label>Confirm</label><input type='password' name='confirm'></div>
            <input type='submit' value='REGISTER'>
          </form>
        </div>
      </div>
    </div>

    <!-- LOG OUT -->
    <div id='view-logout' class='view'>
      You are logged out.
    </div>

    <!-- ABOUT -->
    <div id='view-about' class='view'>
      Virulent Zines is a...
    </div>
  </div>
</div>

<?php include('footer.php'); ?>
