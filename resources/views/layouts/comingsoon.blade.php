<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous"
    />

    <link rel="stylesheet" href="{{asset('/web/coming/assets/style.css')}}" />
    <link rel="icon" type="image/png" href="{{asset('/web/coming/assets/images/favicon.png')}}">

    <title>eWayGo</title>
</head>
<body>
    <div id="preloader">
        <div id="loop" class="center"></div>
        <div id="bike-wrapper" class="center">
            <div id="bike" class="centerBike"></div>
        </div>
    </div>
    <!-- MAIN BANNER START  -->
    <section id="loaded" class="main-banner" style="display: none;">
        <figure class="main-banner__bg-img">
            <img src="{{asset('/web/coming/assets/images/bg_img.jpg')}}" alt="bg-img" />
        </figure>
        <div class="container">
            <div class="main-banner__content">
                <figure class="logo">
                    <img src="{{asset('/web/coming/assets/images/logo.svg')}}" alt="logo" />
                </figure>
                {{ $slot }}
            </div>
        </div>
    </section>
    <!-- MAIN BANNER END  -->

    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"
    ></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"
    ></script>
    <script src="{{asset('/web/coming/assets/script.js')}}"></script>
</body>
</html>
