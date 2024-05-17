<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=getEnv('APP_NAME')?> Subscription Handler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script>
        function success() {
            setTimeout(function () {
                history.go(-3)
            },2000)
        }
        function err() {
            setTimeout(function () {
                history.go(-3)
            },2000)
        }
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-0 col-sm-0 col-md-3 col-lg-3 col-xl-4"></div>
        <div class="col">
            <div class="col text-center">
                <h1 class="<?=(!isset($error))?'text-success':'text-danger'?>">
                    <?php
                    if (!isset($error)){
                        ?>
                        Action performed successfuly.
                        <script>
                            success();
                        </script>
                        <?php
                    } else{
                        ?>
                        <script>
                            err();
                        </script>
                        Unable to perform this action.
                        <?php
                    }
                    ?>
                </h1>
                <div id="animation-container"></div>
            </div>
        </div>
        <div class="col-xs-0 col-sm-0 col-md-3 col-lg-3 col-xl-4"></div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js" integrity="sha512-jEnuDt6jfecCjthQAJ+ed0MTVA++5ZKmlUcmDGBv2vUI/REn6FuIdixLNnQT+vKusE2hhTk2is3cFvv5wA+Sgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Replace 'animation.json' with the path to your animation JSON file.
    lottie.loadAnimation({
        container: document.getElementById('animation-container'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        height:100,
        width:100,
        path: '/public/khalid/json/<?=(!$status)?'err_1':'check_1'?>.json'
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>