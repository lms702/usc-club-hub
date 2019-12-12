$('.tile').on("click", function () {

    let bigdiv = document.createElement('div');
    bigdiv.style.backgroundColor = "black";
    bigdiv.style.color = "white";
    bigdiv.style.height = "500 px";
    bigdiv.style.width = "100%";
    let rowws = this.parentNode.parentNode;
    bigdiv.appendTo($('#' + rowws));
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
        let roww = $('<div class = "roww">');
        roww.appendTo($('#contain'));

        let inner_roww = $('<div class = "roww__inner">');
        inner_roww.appendTo(roww);
        for(let club of category.clubs){
            let name = club.name;
            let theImage = club.image_path;
            let shortDesc = club.short_desc;
            let longDesc = club.long_desc;
            let tile = $('<div class = "tile">');
            tile.appendTo(inner_roww);

            let tile_media = $('<div class = "tile__media">');
            tile_media.appendTo(tile);

            let image = $('<img class = "tile__img" src = "' + theImage  + '" alt = ""/>')  //check the slash
            image.appendTo(tile_media);

            let tex = $('<div class = "tile-text">');
            tex.text(name);
            tex.appendTo(tile_media);

            let details = $('<div class = "tile__details">');
            details.appendTo(tile);

            $(tile).on('click',function(){
                if(loggedIn) {
                    $.ajax({
                        type: 'GET',
                        url: 'add_favorite.php',
                        data: {'club_id': club.id},
                        success: function () {
                            alert("Club successfully added to your favorites!");
                        }
                    });
                }
                else{
                    alert("You must be logged in to add a favorite!");
                }
            });

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