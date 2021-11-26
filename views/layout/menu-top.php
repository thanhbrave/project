<a href="?option=home">Home</a>
<a href="?option=news">News</a>
<a href="?option=feedback">Feedback</a>
<a href="?option=cart">Cart</a>
<?php if(empty($_SESSION['member'])):?>
    <a href="?option=signin">Sign in</a>
    <a href="?option=register">Register</a>
<?php else:?>
    <section>
        Hello: <span style="color: red"><?=$_SESSION['member']?></span> [<a href="?option=logout">Log out</a>]
    </section>
<?php endif;?>
