<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/home.css">
    <title>Home Page</title>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
    <script src = "js/jquery-3.4.1.js"> </script>
</head>
<body>
<script>

   $('.tile').on("click", function () {

        let bigdiv = document.createElement('div');
        bigdiv.style.backgroundColor = "black";
        bigdiv.style.color = "white";
        bigdiv.style.height = "500 px";
        bigdiv.style.width = "100%";
        let rows = this.parentNode.parentNode;
        bigdiv.appendTo($('#' + rows));
    });

 // have to create the carousel
    //then create the the large div
    function funcReq(){ //generates carousel
        //let divs = document.createElement("div");
        $.ajax({
            type: 'GET',
            url: 'get_clubs.php',
            dataType: 'json',
            success: funcGen
        });
    }
    function funcGen(data){
        // console.log(results);
        // data = JSON.parse(results);
        console.log(data);
        for(let category of data){
            let der = $("<p class = \"der\">");
            der.text(category.category);
            der.appendTo($('#contain'));
            let row = $('<div class = "row">');
            row.appendTo($('#contain'));

            let inner_row = $('<div class = "row__inner">');
            inner_row.appendTo(row);
            for(let club of category.clubs){
                let name = club.name;
                let theImage = club.image_path;
                let shortDesc = club.short_desc;
                let longDesc = club.long_desc;
                let tile = $('<div class = "tile">');
                tile.onclick = function(){
                    let bigdiv = document.createElement('div');
                    bigdiv.class = "bigdiv";
                    bigdiv.style.backgroundColor = "black";
                    bigdiv.style.color = "white";
                    bigdiv.style.height = "500 px";
                    bigdiv.style.width = "100%";
                    let rows = this.parentNode.parentNode;
                    bigdiv.append('<table><tr><td rowspan="1">&nbsp'+'<img src = "' + theImage + '"/>'
                        + '</td><td>&nbsp <h1>'+ name +'</h1> <h5>'+ longDesc +'</h5></td></tr>');
                    bigdiv.appendTo($('#' + rows));
                    bigdiv.onclick = function(){
                        bigdiv.remove();
                    };
                };
                tile.appendTo(inner_row);

                let tile_media = $('<div class = "tile__media">');
                tile_media.appendTo(tile);

                let image = $('<img class = "tile__img" src = "' + theImage  + '" alt = ""/>')  //check the slash
                image.appendTo(tile_media);

                let tex = $('<div class = "tile-text">');
                tex.text(name);
                tex.appendTo(tile_media);

                let details = $('<div class = "tile__details">');
                details.appendTo(tile);

                let tile_title = $('<div class="tile__title">');
                tile_title.text(name);
                details.append(tile_title);

                let title1 = $('<div class = "title2">');
                title1.text(shortDesc);
                title1.appendTo(details);

                let title2 = $('<div class = "tile-title">' + name)
                title2.appendTo(details);


            }
        }
    }

    function close_it(){
        bigdiv.visibility = "hidden";
    }

</script>

<?php
if(!isset($_COOKIE['user_id'])){
    $btn1tag = 'Login';
    $btn1link = 'login.php';
    $btn2tag = 'Register';
    $btn2link = 'register.php';
    $midbtnlink = 'please_login.php';
}
else{
    $btn1tag = 'Profile';
    $btn1link = 'profile.php';
    $btn2tag = 'Sign out';
    $btn2link = 'signout.php';
    $midbtnlink = 'add_club.php';
}?>

<div id="contain">
    <p>
        <a href="<?php echo $btn1link; ?>"><input class="btn btn-light" type = "button" value = "<?php echo $btn1tag ?>" id = "login"></a> <br>
        <a href="<?php echo $btn2link; ?>"><input class="btn btn-light" type = "button" value = "<?php echo $btn2tag; ?>" id = "register"></a>
    </p>
    <h1 style="font-size: 50px" class = center>Welcome To Club Hub</h1>
    <h1 id="header2" class = center2>Find The Right Club For You!</h1>
    <br>
    <div class="center">
        <a href="<?php echo $midbtnlink; ?>">
<!--            <label for="add" class="col col-2 control-label">Have a club to add?</label>-->
            <button type="button" id="add" class="btn btn-warning">Add your club here!</button>
        </a>
    </div>
    <script>funcReq(); </script>
</div>
</body>