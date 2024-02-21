<!-- Style dan Script Website -->
<?php
$current_page = basename($_SERVER['PHP_SELF']);
if ($current_page === 'index.php' || $current_page === 'register.php') {
    $css_path = './assets/css/output.css';
    $fontawesome_css_path = './assets/fontawesome/css/all.min.css';
    $js_path = './assets/js/function.js';
} else {
    $css_path = '../../assets/css/output.css';
    $fontawesome_css_path = '../../assets/fontawesome/css/all.min.css';
    $js_path = '../../assets/js/function.js';
}
?>

<link rel="stylesheet" href="<?php echo $css_path; ?>">
<link rel="stylesheet" href="<?php echo $fontawesome_css_path; ?>">
<script src="<?php echo $js_path; ?>"></script>