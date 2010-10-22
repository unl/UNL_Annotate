<?php /* Concept: if a failed auth returned a '1000' exception, prompt user with login button

<?php if ($context->getCode() == 1000) : ?>
<style type="text/css">
#wdnLoginButton {
-moz-border-radius:5px 5px 5px 5px;
background:url("http://go.unl.edu/sharedcode/css/images/identity/lock.png") no-repeat scroll 10px 5px #ECECEC;
border:1px solid #D5D4D4;
color:#494949;
cursor:pointer;
display:block;
font-size:0.9em;
margin-bottom:15px;
min-height:40px;
padding:7px 5px 5px 55px;
}
#wdnLoginButton span {
display:block;
font-size:1.5em;
}
</style>
<a href="?login" id="wdnLoginButton">Log in with your <span>My.UNL Account</span></a>

<?php endif; ?>
