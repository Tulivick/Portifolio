var imagens = [];
var imagens2Remove = [];

function deleteRowUser(r, id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            if (xmlhttp.responseText === "ok") {
                var i = r.parentNode.parentNode.rowIndex;
                document.getElementById("userTable").deleteRow(i);
            }
        }
    };
    xmlhttp.open("GET", "/ajax/removeUser.php?id=" + id, true);
    xmlhttp.send();
}

function deactivateUser(r, id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            if (xmlhttp.responseText === "ok") {
                var row = $(r.parentNode.parentNode);
                if(row.hasClass('success')){
                    var span = row.find('.glyphicon-remove').first();
                    row.removeClass('success');
                    row.addClass('danger');
                    span.removeClass('glyphicon-remove');
                    span.addClass('glyphicon-ok');
                }else{
                    var span = row.find('.glyphicon-ok').first();
                    row.removeClass('danger');
                    row.addClass('success');
                    span.removeClass('glyphicon-ok');
                    span.addClass('glyphicon-remove');
                }
            }
        }
    };
    xmlhttp.open("GET", "/ajax/deactivateUser.php?id=" + id, true);
    xmlhttp.send();
}

function deleteRowCategory(r, id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText === "ok") {
                var i = r.parentNode.parentNode.rowIndex;
                document.getElementById("categoryTable").deleteRow(i);
            }
        }
    };
    xmlhttp.open("GET", "/ajax/removeCategory.php?id=" + id, true);
    xmlhttp.send();
}

function deleteRowGalery(r, id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText === "ok") {
                var i = r.parentNode.parentNode.rowIndex;
                document.getElementById("galeryTable").deleteRow(i);
            }
        }
    };
    xmlhttp.open("GET", "/ajax/removeGalery.php?id=" + id, true);
    xmlhttp.send();
}

function deleteImage(image) {
    var srcAttr = image.attr('src');
    var altAttr = image.attr('alt');
    if(srcAttr.startsWith("data:")){
        var i = 0;
        while(i<imagens.length && imagens[i].name!==altAttr){
            i++;
        }
        imagens.splice(i,1);
        alert(imagens);
    }else{
        imagens2Remove.push(srcAttr);
    }
    enableModificationButtons();
    return true;
}

function addImage() {
    var jqFile = $('#imagem');
    var file = jqFile[0].files[0];
    jqFile.val("");
    if (!file) {
        return false;
    }
    imagens.push(file);
    var reader = new FileReader();
    reader.onload = function (e) {
        var newDiv = $("<div class='alert alert-info'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><div class= 'row'><div class='col-sm-12 text-center'><img class='img-responsive center-block galery-img' src='#' alt='#'></div></div></div>");
        newDiv.find('img').attr('src', e.target.result).attr('alt',file.name);
        newDiv.on('close.bs.alert', function (event) {
            return deleteImage($(event.currentTarget).find('img'));
        });
        $('.container').eq($('.container').length-2).append(newDiv);
    };
    reader.readAsDataURL(file);
    enableModificationButtons();
}

function saveChanges(id){
    var formdata = new FormData();
    formdata.append('galery',id);
    var len = imagens.length;
    for(i=0;i<len;i++){
        formdata.append('add[]',imagens[i]);
    }
    len = imagens2Remove.length;
    for(i=0;i<len;i++){
        formdata.append('remove[]',imagens2Remove[i]);
    }
    $.ajax({
        url: "/ajax/saveChanges.php",
        data: formdata,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function (data) {
            location.assign(location.pathname+location.search+"&ok=true");
        }
    });
}

function enableModificationButtons(){
    $('.ena-dis').each(function(){
        $(this).removeProp('disabled');
    });
}

function disableModificationButtons(){
    $('.ena-dis').each(function(){
        $(this).prop('disabled');
    });
}