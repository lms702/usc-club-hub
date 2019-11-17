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
            let theImage = '../' + club.image_path;
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
                bigdiv.append('<table><tr><td rowspan="1">&nbsp'+'<img src = "' + '../' + theImage + '"/>'
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
funcReq();
