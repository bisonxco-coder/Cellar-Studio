<?php
$navActive = '';
if (!function_exists('cellar_studio_terms_content')) {
	require_once dirname(__DIR__) . '/inc/legal-pages.php';
}
$legalEyebrow = 'LEGAL';
$legalTitle = 'Terms & Conditions';
$legalSubtitle = 'How you may use cellar-studio.com and what an online enquiry does — and does not — confirm.';
$legalBody = cellar_studio_terms_content();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Terms &amp; Conditions | Cellar Studio</title>
  <link rel="icon" type="image/png" href="img/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<body class="legal-page-body-wrap">
<?php include __DIR__ . '/includes/legal-document.php'; ?>
</body>
</html>
