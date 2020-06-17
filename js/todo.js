function cleanup() {

    $(".panel li")
        .wrapInner("<p>")
        .prepend("<div class=\"btn-group\"><button type=\"button\" class=\"btn btn-primary check\"><span class=\"glyphicon glyphicon-ok\"></span> </button> <button type=\"button\" class=\"btn btn-primary del\"> <span class=\"glyphicon glyphicon-remove\"></span></button></div>");

        //check if ListItemID and strike through when needed 
    $.ajax({
        type: "POST",
        url: "inc/renderStrike.php",
        async: true,
        dataType: "json",
        success: function( msg ) {
            strikeArrLength = msg.length;
            for (i =0; i < strikeArrLength; i++) {
                    console.log(msg[i]);
                if(msg[i] > 0){
                    $(".panel li:eq(" + i + ")").find("p").css("text-decoration","line-through");
                }else{
                    $(".panel li:eq(" + i + ")").find("p").css("text-decoration","none");
                }
            }
        }//success function
    });
};//cleanup function

//check status of ListItemID and strike through if needed 
$("li").on("click", "check", function() {
    var checkNum = $(this).parent().parent().index();

    $.ajax({
        type: "POST",
        url: "inc/done.php",
        data: "val=" + checkNum,
        async: true,
        dataType: "text",
        success: function( data ) {
            if(data > 0){
                $(".panel li:eq(" + checkNum + ")").find("p").css("text-decoration","line-through");
            }else{
                $(".panel li:eq(" + checkNum + ")").find("p").css("text-decoration","none");
            }
        }
    });//ajax call
});

//delete list item
$("li").on("click", ".del", function() {
    //remove entry
    $(this).parent().parent().fadeOut("fast");
    var checkNum = $(this).parent().parent().index();
    $.post('inc/delete.php', 'val=' + checkNum);
});