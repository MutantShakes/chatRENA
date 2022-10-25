$(document).ready(function(){
    function loadGroup(groupId){
        $.ajax({
            url : "messages.php",
            type : "POST",
            data : {id : groupId},
            success : function(data){
                $("#msgFrame").html(data);
                $(document).scrollTop($(document).height());
            }
        })
    }
    loadGroup("");
    $("#load").on("click",function(e){
        var group = $("#groupId").val();
        loadGroup(group);
    });

    $("#button-addon2").on("click",function(e){
        e.preventDefault();
        var msg = $("#msg").val();
        $.ajax({
            url : "sendMsg.php",
            type : "POST",
            data : {msg : msg},
            success : function(data){
                $("msgFrame").html(data);
                $("#msg").val('');
                loadGroup("");
                $(document).scrollTop($(document).height());
            }
        })
    });
  
    
});
  
  