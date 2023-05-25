
<?php include('footer.php');?>
<script>
    function logout(){$('#logoutForm').submit()}
</script>
<?php echo (isset($stack_js) && $stack_js?  $stack_js:''); ?>
</body>
</html>