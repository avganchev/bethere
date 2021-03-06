<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Bethere - {{ trans('adminlte_lang::message.landingdescription') }} ">

        <title>{{ trans('adminlte_lang::message.landingdescriptionpratt') }}</title>

        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" id="rangecalendar-style-css" href="https://rawgit.com/webangelo/jQuery-Range-Calendar/master/css/rangecalendar.css" type="text/css" media="all">
        <link rel="stylesheet" id="rangecalendar-style-css" href="https://rawgit.com/webangelo/jQuery-Range-Calendar/master/css/style.css" type="text/css" media="all">
        <link type="text/css" rel="stylesheet" href="{{ asset('/css/materialize.css') }}" media="screen,projection"/>
    </head>

    <body>
        <div class="wrapper">
            <header>
                <div class="navbar-fixed">
                    <!-- Dropdown Structure -->
                    <ul id="dropdown1" class="dropdown-content">
                        <li><a href="#">one</a></li>
                        <li><a href="#">two</a></li>
                        <li class="divider"></li>
                        <li><a href="#">three</a></li>
                    </ul>
                    <nav>
                        <div class="nav-wrapper white">
                            <a href="#" class="brand-logo  #6a1b9a purple-text darken-3"> <!--<img src="{{ asset('/img/bethere_logo.png') }}">-->BeThere
                                <span class="cyan-text accent-3">лучше там, где ты есть!</span> </a>
                            <ul class="right hide-on-med-and-down">
                                <li><a class="pink-text accent-3" href="#">Куда пойти</a></li>
                                <li><a class="indigo-text darken-3" href="#">Куда поехать</a></li>
                                <li><a class="dropdown-button green-text accent-3" href="#" data-activates="dropdown1">Мой аккаунт<i class="material-icons right">arrow_drop_down</i></a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
            <section>
                <div id="cal1"></div>
            </section>
            <section>
                <div class="row">
                    <div class="card col s4 medium">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="http://materializecss.com/images/office.jpg">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
                            <p><a href="#">This is a link</a></p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                        <div class="card-action">
                            <a href="#">This is a link</a>
                            <a href="#">This is a link</a>
                        </div>
                    </div>
                    <div class="card col s4 medium">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="http://materializecss.com/images/office.jpg">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
                            <p><a href="#">This is a link</a></p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                        <div class="card-action">
                            <a href="#">This is a link</a>
                            <a href="#">This is a link</a>
                        </div>
                    </div>
                    <div class="card col s4 medium">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="http://materializecss.com/images/office.jpg">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Card Title<i class="material-icons right">more_vert</i></span>
                            <p><a href="#">This is a link</a></p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                        <div class="card-action">
                            <a href="#">This is a link</a>
                            <a href="#">This is a link</a>
                        </div>
                    </div>
                </div>
            </section>
            <footer>

            </footer>
        </div>

        <!-- Javascript Files-->
        <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <script type="text/javascript" src="https://rawgit.com/webangelo/jQuery-Range-Calendar/master/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://rawgit.com/webangelo/jQuery-Range-Calendar/master/js/jquery.ui.touch-punch.min.js"></script>
        <script type="text/javascript" src="https://rawgit.com/webangelo/jQuery-Range-Calendar/master/js/moment+langs.min.js"></script>
        <script src="{{ asset('/plugins/rangecalendar/jquery.rangecalendar.js') }}"></script>
        <script src="{{ asset('/js/smoothscroll.js') }}"></script>
        <script src="{{ asset('/js/materialize.js') }}"></script>
        <script>
            $(document).ready(function () {
                $(".dropdown-button").dropdown();
            });
        </script>

        <script>
            $(document).ready(function () {

                var defaultCalendar = $("#cal1").rangeCalendar();


                $("#setDateBt").click(function () {
                    var newDate = new Date(2014, 4, 24);
                    rangeCalendar.setStartDate(newDate);

                    rangeCalendar.update();
                });

                $("#addMonthBt").click(function () {

                    var newDate = moment().add('months', 1);
                    rangeCalendar.setStartDate(newDate);
                });


                var customizedRangeCalendar = $("#cal2").rangeCalendar({theme: "full-green-theme"});
                var languageCalendar = $("#cal3").rangeCalendar({lang: "it"});
                var rangeCalendar = $("#cal4").rangeCalendar({weekends: false});
                var callbackRangeCalendar = $("#cal5").rangeCalendar({changeRangeCallback: rangeChanged, weekends: false});

                function rangeChanged(target, range) {


                    console.log(range);
                    var startDay = moment(range.start).format('DD');
                    var startMonth = moment(range.start).format('MMM');
                    var startYear = moment(range.start).format('YY');
                    var endDay = moment(range.end).format('DD');
                    var endMonth = moment(range.end).format('MMM');
                    var endYear = moment(range.end).format('YY');


                    $(".calendar-values .start-date .value").html(startDay);
                    $(".calendar-values .start-date .label").html("");
                    $(".calendar-values .start-date .label").append(startMonth);
                    $(".calendar-values .start-date .label").append("<small>" + startYear + "</small>");
                    $(".calendar-values .end-date .value").html(endDay);
                    $(".calendar-values .end-date .label").html("");
                    $(".calendar-values .end-date .label").append(endMonth);
                    $(".calendar-values .end-date .label").append("<small>" + endYear + "</small>");
                    $(".calendar-values .days-width .value").html(range.width);
                    $(".calendar-values .from-now .label").html(range.fromNow);

                }

                function ragneChanged(target, range) {

                    console.log(range);
                }

            });
        </script>

    </body>
</html>