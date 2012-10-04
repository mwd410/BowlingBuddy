$(document).ready(function() {
  
    var editBowlerNameActive = 0;
    var activeEditBowlerNameId = -1;
  
    $("body").click(function() {
    
        if (editBowlerNameActive == 1) {
            $("#edit_name_"+activeEditBowlerNameId).hide();
            $("#edit_"+activeEditBowlerNameId).show();
            editBowlerNameActive = 0;
            activeEditBowlerNameId = -1;
        }
    
    });
  
    $(document).keypress(function(e) {
        if (e.which == 13) { //enter key is pressed.
            if (editBowlerNameActive) {

                var newBowlerName = $("#name_input_"+activeEditBowlerNameId).val();
                var post_url = $("#edit_"+activeEditBowlerNameId).attr("href"); 
        
                $.ajax({
                    type: "POST",
                    url: post_url,
                    data: {
                        "bowlerId": activeEditBowlerNameId,
                        "bowlerName": newBowlerName
                    },
                     
                    beforeSend:function() {
                        $("#bowler_"+activeEditBowlerNameId+" .bowler-name a").html(newBowlerName);
                        $("#edit_name_"+activeEditBowlerNameId).hide();
                        $("#edit_"+activeEditBowlerNameId).show();
                    },
                    
                    success:function(response) {
                        console.log(response);
                    },
                
                    error:function() {
                        alert("Bowler name change failed.");
                    }
          
                });
            }
        }
    });
  
    $("#content").on("click", "#create-bowler", function(event) {
        event.preventDefault();
        var bowlerName = $("#create_bowler_name").val();
        var post_url = $(this).attr("href");
    
        $.ajax({
            type: "POST",
            url: post_url,
            data: {
                "name" : bowlerName
            },
            
            success:function(response) {
                $("#bowlers").prepend($(response).fadeIn());
            },
            
            error:function() {
                alert("Error creating bowler. Make sure you've specified a name.");
            }
      
        });
    });
  
    $("#content").on("click", ".bowler-delete a", function(event) {
        var bowlerId = $(this).attr('bowler');
        var post_url = $(this).attr('href');
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: post_url,
            data: {
                'bowlerId' : bowlerId
            },
            
            beforeSend:function() {
                $("#bowler_"+bowlerId).effect('blind');
            },
            
            error:function() {
                alert("Could not delete bowler.");
            }
      
        });
    });
  
    $("#content").on("click",".edit-bowler", function(event) {
        event.preventDefault();
        var bowlerId = $(this).attr('bowler');
        $("#bowler_details_"+bowlerId).slideToggle();
    });
    
    $("#content").on("click", ".edit-main-bowler", function(event) {
        event.preventDefault();
        var bowlerId = $(this).attr('bowler');
        var post_url = $(this).attr('href');
        console.log(bowlerId);
        $.ajax({
            type: "POST",
            url: post_url,
            data: {
                "mainBowler": bowlerId
            },
            
            beforeSend:function() {
                $(".main-bowler-indicator").hide(0, function() {
                    $("#bowler_"+bowlerId+" .main-bowler-indicator").show();
                });
            },
            
            error: function() {
                alert('Could not set main bowler.');
            }
        })
        
    });
  
    $("#content").on("click",".edit-name", function(event) {
        if (editBowlerNameActive == 0) {
            
            event.preventDefault();
            var bowlerId = $(this).attr("bowler");
            activeEditBowlerNameId = bowlerId;
            $(this).hide()
            $("#edit_name_"+bowlerId).show();
            $("#name_input_"+bowlerId).focus();
            editBowlerNameActive = 1;
        }
        event.stopPropagation();
    });
  
    $("#content").on("click", ".edit-name-form", function(event) {
        event.stopPropagation();
    });
  
});