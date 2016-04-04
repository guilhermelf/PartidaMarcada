<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/partidamarcada/components/metro-ui-css/build/css/metro.css" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-icons.css" rel="stylesheet" />
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-schemes.css" rel="stylesheet">
        <link href="/partidamarcada/components/metro-ui-css/build/css/metro-responsive.css" rel="stylesheet">
        <link href="/partidamarcada/components/css/style.css" rel="stylesheet">
        <script src="/partidamarcada/components/jquery/jquery.min.js"></script>
        <script src="/partidamarcada/components/js/scripts.js"></script>
        <script src="/partidamarcada/components/metro-ui-css/build/js/metro.js"></script>
    </head>
    <body>
        <div class="bg-lightBlue">
            <?php include 'app/views/header/header.php'; ?>

            <form>
                <fieldset>
                    <legend>Legend</legend>
                    <label>Label name</label>
                    <div class="input-control text" data-role="input-control">
                        <input type="text" placeholder="type text">
                        <button class="btn-clear" tabindex="-1" type="button"></button>
                    </div>
                    <label>Label name</label>
                    <div class="input-control password" data-role="input-control">
                        <input type="password" placeholder="type password" autofocus="">
                        <button class="btn-reveal" tabindex="-1" type="button"></button>
                    </div>
                    <div class="input-control checkbox" data-role="input-control">
                        <label>
                            <input type="checkbox" checked="">
                            <span class="check"></span>
                            Check me out
                        </label>
                    </div>

                    <div>
                        <div class="input-control radio default-style" data-role="input-control">
                            <label>
                                <input type="radio" name="r1" checked="">
                                <span class="check"></span>
                                R1
                            </label>
                        </div>
                        <div class="input-control radio  default-style" data-role="input-control">
                            <label>
                                <input type="radio" name="r1">
                                <span class="check"></span>
                                R2
                            </label>
                        </div>
                    </div>

                    <input type="submit" value="Submit">
                </fieldset>
            </form>
        </div>


    </div>
</body>
</html>