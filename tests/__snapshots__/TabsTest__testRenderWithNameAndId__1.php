<?php return '
<!DOCTYPE html>
<html>
<head>
    <link href="/1/css/bootstrap.css" rel="stylesheet"></head>
<body>
<ul id="w2" class="nav nav-tabs wt-tabs"><li class="active"><a href="#foo" data-toggle="tab">Foo</a></li>
<li><a href="#bar" data-toggle="tab">Bar</a></li>
<li><a href="#w2-tab0" data-toggle="tab">Baz</a></li></ul>
<div class="tab-content"><div id="foo" class="tab-pane active">Foo Content</div>
<div id="bar" class="tab-pane">Bar Content</div>
<div id="w2-tab0" class="tab-pane">Baz Content</div></div><script src="/2/jquery.js"></script>
<script src="/1/js/bootstrap.js"></script>
<script src="/0/js/linkable-tabs.js"></script>
<script>jQuery(function ($) {
jQuery(\'#w2\').tab();
});</script></body>
</html>
';
