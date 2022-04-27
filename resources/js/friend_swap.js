$.ajax({
    type: "POST",
    url: "chat.php",
    data: $("#form-search").serialize();
    dataType: "json",
    success: function(result){
    }
    });
